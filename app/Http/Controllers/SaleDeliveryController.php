<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDelivery;
use App\Models\Manpower;
use App\Models\Dealer;
use App\Models\Log;
use Carbon\Carbon;
use Auth;

class SaleDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $time = Carbon::now('GMT+8')->format('h:i:s');

        if ($dc == 'group') {
            $data = SaleDelivery::orderBy('sale_delivery_date','desc')->get();
            $manpower = Manpower::where('position','Driver')->get();
            $sale = Sale::all();
            return view('page', compact('data','manpower','today','sale','time'));
        }else{
            $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
            ->join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id',$did)
            ->orderBy('sale_delivery_date','desc')
            ->select('stocks.*','sale_deliveries.*')->get();
            $manpower = Manpower::where('position','Driver')
            ->where('dealer_id',$did)->get();
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id',$did)
            ->select('sales.*','stocks.unit_id')->get();
            return view('page', compact('data','manpower','today','sale','time'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $data = new SaleDelivery;
        $data->sale_delivery_date = $req->sale_delivery_date;
        $data->sale_id = $req->sale_id;
        $data->delivery_time = $req->delivery_time;
        $data->arrival_time = $req->arrival_time;
        $data->main_driver = $req->main_driver;
        $data->backup_driver = $req->backup_driver;
        $data->note = $req->note;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'creates sale deliveries data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data sale delivery berhasil disimpan','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SaleDelivery $saleDelivery)
    {
        return view('page', compact('saleDelivery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleDelivery $saleDelivery)
    {
        $manpower = Manpower::where('position','Driver')->get();
        return view('page', compact('saleDelivery','manpower'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, SaleDelivery $saleDelivery)
    {
        $data = SaleDelivery::find($saleDelivery->id);
        $data->delivery_time = $req->delivery_time;
        $data->arrival_time = $req->arrival_time;
        $data->main_driver = $req->main_driver;
        $data->backup_driver = $req->backup_driver;
        $data->note = $req->note;
        $data->updated_by = Auth::user()->id;
        $data->save();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'updates sale deliveries data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data sale delivery berhasil diubah','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id){
        SaleDelivery::find($id)->delete();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'deletes sale deliveries data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data sale delivery berhasil dihapus','success');
        return redirect()->back();
    }

    public function history(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = SaleDelivery::orderBy('sale_delivery_date','desc')->get();
            }else{
                $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('sale_delivery_date','desc')
                ->select('stocks.*','sale_deliveries.*')->get();
            }
        } else {
            if ($dc == 'group') {
                $data = SaleDelivery::whereBetween('sale_delivery_date',[$req->start, $req->end])->get();
            }else{
                $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('sale_delivery_date',[$req->start, $req->end])
                ->orderBy('sale_delivery_date','desc')
                ->select('stocks.*','sale_deliveries.*')->get();
            }
            
        }
        return view('page', compact('data','start','end'));
    }
}

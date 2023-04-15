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

        $year = Carbon::now('GMT+8')->format('Y');

        if ($dc == 'group') {
            $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
            ->join('stocks','sales.stock_id','stocks.id')
            ->whereYear('sales.sale_date',$year)
            ->orderBy('sale_delivery_date','desc')
            ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();
            $manpower = Manpower::where('position','Driver')->get();
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->whereYear('sales.sale_date',$year)
            ->where([
                ['sales.status','pending'],
                ['sales.frame_no','!=',null],
            ])
            ->orderBy('sales.sale_date','desc')
            ->select('sales.*','stocks.unit_id')->get();
            return view('page', compact('data','manpower','today','sale','time'));
        }else{
            $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
            ->join('stocks','sales.stock_id','stocks.id')
            ->whereYear('sales.sale_date',$year)
            ->where('stocks.dealer_id',$did)
            ->orderBy('sale_delivery_date','desc')
            ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();

            $manpower = Manpower::where('position','Driver')
            ->where('dealer_id',$did)->get();
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->whereYear('sales.sale_date',$year)
            ->where([
                ['stocks.dealer_id',$did],
                ['sales.status','pending'],
                ['sales.frame_no','!=',null],
            ])
            ->orderBy('sales.sale_date','desc')
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
        $data->note = $req->note;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        if ($req->has('selfpickup')) {
            $data->status = 'self pick up';
            $data->main_driver = 38;
            $data->backup_driver = 38;
            $data->save();
        } else {
            $data->main_driver = $req->main_driver;
            $data->backup_driver = $req->backup_driver;
            $data->save();
        }
        

        // Update Sale Status
        $sale = Sale::find($req->sale_id);
        $sale->status = 'delivered';
        $sale->update();

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
        $sale_id = SaleDelivery::where('id',$id)
        ->pluck('sale_id');
        $sale_id = $sale_id[0];
        
        SaleDelivery::find($id)->delete();

        // Update Sale Status
        $sale = Sale::find($sale_id);
        $sale->status = 'pending';
        $sale->update();

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

        $year = Carbon::now('GMT+8')->format('Y');

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->whereYear('sales.sale_date',$year)
                ->orderBy('sale_delivery_date','desc')
                ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();
            }else{
                $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->whereYear('sales.sale_date',$year)
                ->where('stocks.dealer_id',$did)
                ->orderBy('sale_delivery_date','desc')
                ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();
            }
        } else {
            if ($dc == 'group') {
                $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->whereBetween('sale_delivery_date',[$req->start, $req->end])
                ->orderBy('sale_delivery_date','desc')
                ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();
            }else{
                $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('sale_delivery_date',[$req->start, $req->end])
                ->orderBy('sale_delivery_date','desc')
                ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();
            }
            
        }
        return view('page', compact('data','start','end'));
    }
}

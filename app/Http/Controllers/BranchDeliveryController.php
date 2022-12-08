<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Out;
use App\Models\BranchDelivery;
use App\Models\Manpower;
use App\Models\Log;
use App\Models\Dealer;
use Carbon\Carbon;
use Auth;

class BranchDeliveryController extends Controller
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
            $data = BranchDelivery::orderBy('branch_delivery_date','desc')->get();
            $manpower = Manpower::where('position','Driver')->get();
            $out = Out::all();
            return view('page', compact('data','manpower','today','out','time'));
        }else{
            $data = BranchDelivery::join('outs','branch_deliveries.out_id','outs.id')
            ->join('stocks','outs.stock_id','stocks.id')
            ->where('stocks.dealer_id',$did)
            ->orderBy('branch_delivery_date','desc')
            ->select('stocks.*','branch_deliveries.*')->get();
            $manpower = Manpower::where('position','Driver')
            ->where('dealer_id',$did)->get();
            $out = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('stocks.dealer_id',$did)
            ->select('outs.*','stocks.unit_id')->get();
            return view('page', compact('data','manpower','today','out','time'));
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
        $data = new BranchDelivery();
        $data->branch_delivery_date = $req->branch_delivery_date;
        $data->out_id = $req->out_id;
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
        $log->activity = 'creates branch deliveries data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data branch delivery berhasil disimpan','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BranchDelivery $branchDelivery)
    {
        return view('page', compact('branchDelivery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BranchDelivery $branchDelivery)
    {
        $manpower = Manpower::where('position','Driver')->get();
        return view('page', compact('branchDelivery','manpower'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, BranchDelivery $branchDelivery)
    {
        $data = BranchDelivery::find($branchDelivery->id);
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
        $log->activity = 'updates branch deliveries data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data branch delivery berhasil diubah','success');
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
        BranchDelivery::find($id)->delete();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'deletes branch deliveries data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data branch delivery berhasil dihapus','success');
        return redirect()->back();
    }

    public function history(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = BranchDelivery::orderBy('branch_delivery_date','desc')->get();
            }else{
                $data = BranchDelivery::join('outs','branch_deliveries.out_id','outs.id')
                ->join('stocks','outs.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('branch_delivery_date','desc')
                ->select('stocks.*','branch_deliveries.*')->get();
            }
        } else {
            if ($dc == 'group') {
                $data = BranchDelivery::whereBetween('branch_delivery_date',[$req->start, $req->end])->get();
            }else{
                $data = BranchDelivery::join('outs','branch_deliveries.out_id','outs.id')
                ->join('stocks','outs.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('branch_delivery_date',[$req->start, $req->end])
                ->orderBy('branch_delivery_date','desc')
                ->select('stocks.*','branch_deliveries.*')->get();
            }
        
        }
        return view('page', compact('data','start','end'));
    }
}

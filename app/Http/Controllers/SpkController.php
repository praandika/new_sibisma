<?php

namespace App\Http\Controllers;

use App\Models\Spk;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Leasing;
use App\Models\Manpower;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = SPK::count();
        $random = Carbon::now('GMT+8')->format('HmsYmd');
        
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $spk_no = 'SPK'.$count.$random.$dc;

        $leasing = Leasing::all();
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        if ($dc == 'group') {
            $stock = Stock::orderBy('qty','desc')->get();
            $manpower = Manpower::join('dealers','manpowers.dealer_id','=','dealers.id')
            ->where('position','Branch Head')
            ->orWhere('position','Supervisor')
            ->orWhere('position','Sales Counter')
            ->orWhere('position','Salesman')
            ->get();
            $data = Spk::where('spk_date',$today)->orderBy('id','desc')->get();
            return view('page', compact('stock','leasing','today','data','manpower','spk_no'));
        }else{
            $stock = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get('stocks.*');
            $manpower = Manpower::join('dealers','manpowers.dealer_id','=','dealers.id')
            ->where('dealer_id',$did)
            ->where('position','Branch Head')
            ->orWhere('position','Supervisor')
            ->orWhere('position','Sales Counter')
            ->orWhere('position','Salesman')
            ->get();
            $dealerCode = $dc;
            $data = Spk::join('stocks','spks.stock_id','stocks.id')
            ->where('spk_date',$today)->where('stocks.dealer_id',$did)->orderBy('spks.id','desc')
            ->select('*','spks.id as id_spk')->get();
            return view('page', compact('stock','leasing','today','data','manpower','dealerCode','spk_no'));
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
    public function store(Request $request)
    {
        if ($request->discount == '') {
            $discount = 0;
        } else {
            $discount = $request->discount;
        }
        
        $data = new Spk;
        $data->spk_no = $request->spk_no;
        $data->spk_date = $request->spk_date;
        $data->order_name = $request->order_name;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->stnk_name = $request->stnk_name;
        $data->stock_id = $request->stock_id;
        $data->downpayment = $request->downpayment;
        $data->discount = $discount;
        $data->payment = $request->payment;
        $data->leasing_id = $request->leasing_id;
        $data->manpower_id = $request->manpower_id;
        $data->description = $request->description;
        $data->payment_method = $request->payment_method;
        $data->credit_status = $request->credit_status;
        $data->order_status = $request->order_status;
        $data->created_by = Auth::user()->id;
        $data->save();
        toast('SPK berhasil dibuat','success');
        return redirect()->route('spk.get',$request->spk_no);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function show(Spk $spk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function edit(Spk $spk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spk $spk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spk $spk)
    {
        //
    }

    public function get($spk_no){
        $data = Spk::join('stocks','spks.stock_id','=','stocks.id')
        ->join('leasings','spks.leasing_id','=','leasings.id')
        ->join('manpowers','spks.manpower_id','=','manpowers.id')
        ->where('spks.spk_no',$spk_no)
        ->get();

        return view('page', compact('data'));
    }
}

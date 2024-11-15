<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Stock;
use Auth;
use Illuminate\Http\Request;

class AllocationController extends Controller
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
        $dealer = Dealer::where('dealer_code','!=','YIMM')->get();

        if ($dc == 'group') {
            $data = Allocation::selectRaw('allocation_date, COUNT(frame_no) as total_unit, dealer_code')
            ->groupBy('allocation_date')
            ->get();
            $stock = Stock::orderBy('qty','desc')->get();
            return view('page', compact('data','dealer', 'stock'));

        } else {
            $data = Allocation::selectRaw('allocation_date, COUNT(frame_no) as total_unit, dealer_code')
            ->where('dealer_code',$dc)
            ->groupBy('allocation_date')
            ->get();
            $stock = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get('stocks.*');
            
            $dealerName = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
            $dealerName = $dealerName[0];
            $dealerCode = $dc;

            return view('page', compact('data','dealerName', 'dealerCode', 'stock'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function show(Allocation $allocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Allocation $allocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allocation $allocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allocation $allocation)
    {
        //
    }
}

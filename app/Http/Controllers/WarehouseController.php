<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\WarehouseName;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $start = $req->start;
        $end = $req->end;
        return view('page', compact('start','end'));
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

    public function entry($code, $wId){
        $gudang = WarehouseName::where('id', $wId)->pluck('name');
        $gudang = $gudang[0];
        $dc = Auth::user()->dealer_code;
        $firstName = Auth::user()->first_name;
        $dealerName = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
        $dealerName = $dealerName[0];
        $thisYear = Carbon::now('GMT+8')->format('Y');
        $lastYear = $thisYear - 1;
        $unit = Unit::where([
            ['year_mc', $thisYear],
            ['year_mc', $lastYear]
        ])
        ->orderBy('model_name', 'asc')
        ->orderBy('year_mc','desc')
        ->get();
        return view('page', compact('code','dealerName','firstName','wId','gudang','unit'));
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
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}

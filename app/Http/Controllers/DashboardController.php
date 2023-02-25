<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Dealer;
use App\Models\Leasing;
use App\Models\Manpower;
use App\Models\Spk;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if (Auth::user()->access == 'salesman') {
            $count = SPK::count();
            $random = Carbon::now('GMT+8')->format('HmsYmd');
            
            $dc = Auth::user()->dealer_code;
            $did = Dealer::where('dealer_code',$dc)->sum('id');

            $leasing = Leasing::all();
            $today = Carbon::now('GMT+8')->format('Y-m-d');

            $yearNow = Carbon::now('GMT+8')->format('Y');
            $yearBefore = $yearNow - 1;

            $unitData = Unit::where('year_mc',$yearNow)
            ->orWhere('year_mc',$yearBefore)
            ->groupBy('model_name')
            ->get();

            $colorData = Color::all();

            $stock = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get('stocks.*');
            $manpower = Manpower::join('dealers','manpowers.dealer_id','=','dealers.id')
            ->where([
                ['manpowers.dealer_id',$did],
                ['manpowers.category','SAL']
            ])
            ->select('manpowers.id as id_manpower','manpowers.name','manpowers.position','manpowers.gender','dealers.dealer_code')
            ->get();

            $dealerCode = $dc;
            $data = Spk::join('stocks','spks.stock_id','stocks.id')
            ->join('manpowers','spks.manpower_id','manpowers.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->where('dealers.dealer_code',$dc)
            ->where(function($query){
                $query->where('credit_status','survey')
                      ->orWhere('order_status','indent');
            })
            ->orderBy('spks.id','desc')
            ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.phone as customer_phone')->get();

            $spk_no = 'SPK'.$count.$random.$dc;
            return view('page', compact('stock','leasing','today','data','manpower','dealerCode','spk_no','unitData','colorData'));
        } else {
            return view('page');
        }
    }

    public function simulasi(){
        $year = Carbon::now()->format('Y');
        $lastYear = $year - 1;
        $data = Unit::join('colors','colors.id','=','units.color_id')
        ->where('units.year_mc',$year)
        ->groupBy('units.model_name')
        ->orderBy('units.model_name', 'asc')
        ->get();

        return view('simulasi', compact('data'));
    }
}

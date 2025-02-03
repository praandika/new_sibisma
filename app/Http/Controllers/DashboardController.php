<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        return view('page');
    }

    public function simulasi(){
        $year = Carbon::now()->format('Y');
        $lastYear = $year - 1;
        $data = Unit::join('colors','colors.id','=','units.color_id')
        ->where('units.year_mc',$year)
        ->orWhere('units.model_name','Fazzio Neo Hybrid')
        ->orWhere('Fazzio Hybrid Lux')
        ->groupBy('units.model_name')
        ->orderBy('units.model_name', 'asc')
        ->get();

        return view('simulasi', compact('data'));
    }
}

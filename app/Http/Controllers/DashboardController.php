<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;

class DashboardController extends Controller
{
    public function index(){
        return view('page');
    }

    public function simulasi(){
        $data = Unit::join('colors','colors.id','=','units.color_id')
        ->where('units.year_mc','2022')
        ->orWhere('units.year_mc','2023')
        ->groupBy('units.model_name')
        ->orderBy('units.model_name', 'asc')
        ->get();

        return view('simulasi', compact('data'));
    }
}

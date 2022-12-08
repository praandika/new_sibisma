<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Unit;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{
    public function search(Request $req){
        $search = $req->search;
        $data = Stock::join('units','stocks.unit_id','units.id')
        ->join('colors','units.color_id','colors.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->where('units.model_name','like','%'.$search.'%')
        ->where('stocks.qty','>',0)
        ->select('units.model_name','colors.color_name','colors.color_code','units.year_mc','dealers.dealer_name','stocks.qty','stocks.id','dealers.phone2','units.image')
        ->get();

        return view('page', compact('data','search'));
    }

    public function searchImage($image){
        $data = Unit::join('colors','units.color_id','colors.id')
        ->where('image',$image)->get();
        
        return view('component.image', compact('data'));
    }
}

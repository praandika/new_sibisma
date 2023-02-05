<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KwitansiController extends Controller
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

        if ($dc == 'group') {
            $data = Sale::orderBy('id','desc')->get();
        } else {
            $data = Sale::join('stocks','sales.stock_id','stocks.id')
            ->join('users','sales.created_by','users.id')
            ->where('stocks.dealer_id',$did)->orderBy('sales.id','desc')
            ->select('*','sales.id as id_sale','users.first_name')->get();
        }
        return view('page', compact('data'));
    }
}

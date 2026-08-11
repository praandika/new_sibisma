<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Sale;
use App\Models\SaleDelivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DeliveryOrderController extends Controller
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
            $data = Sale::join('stocks','sales.stock_id','stocks.id')
            ->join('users','sales.created_by','users.id')
            ->orderBy('sales.id','desc')
            ->select('*','sales.id as id_sale','users.first_name')->limit(400)->get();
        } else {
            $data = Sale::join('stocks','sales.stock_id','stocks.id')
            ->join('users','sales.created_by','users.id')
            ->where('stocks.dealer_id',$did)->orderBy('sales.id','desc')
            ->select('*','sales.id as id_sale','users.first_name')->limit(400)->get();
        }
        return view('page', compact('data'));
    }

    public function history(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('users','sales.created_by','users.id')
                ->orderBy('sales.id','desc')
                ->select('*','sales.id as id_sale','users.first_name')->limit(50)->get();
            }else{
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('users','sales.created_by','users.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('sales.id','desc')
                ->select('*','sales.id as id_sale','users.first_name')
                ->limit(50)->get();
            }
            
        } else {
            if ($dc == 'group') {
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('users','sales.created_by','users.id')
                ->whereBetween('sale_date',[$req->start, $req->end])
                ->orderBy('sales.id','desc')
                ->get();
            }else{
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('users','sales.created_by','users.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('sale_date',[$req->start, $req->end])
                ->orderBy('sales.id','desc')
                ->get();
            }
        }
        return view('page', compact('data','start','end'));
    }

    public function printPDF($spk_no){
        $dc = Auth::user()->dealer_code;
        $dealer = Dealer::where('dealer_code',$dc)->firstOrFail();

        $data = SaleDelivery::where('spk_no', $spk_no)->firstOrFail();

        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        $pdf = PDF::loadView('export.pdf-do',compact('data','printDate','dealer'));
        $pdf->setPaper('A5', 'potrait');
        return $pdf->stream('DO_'.$data->sale->customer_name.'-'.$data->sale->model_name.'.pdf');
    }

    public function downloadPDF($spk_no){
        $dc = Auth::user()->dealer_code;
        $dealer = Dealer::where('dealer_code',$dc)->firstOrFail();

        $data = SaleDelivery::where('spk_no', $spk_no)->firstOrFail();

        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        $pdf = PDF::loadView('export.pdf-do',compact('data','printDate','dealer'));
        $pdf->setPaper('A5', 'potrait');
        
        return $pdf->download('DO_'.$data->sale->customer_name.'-'.$data->sale->model_name.'.pdf');
    }
}

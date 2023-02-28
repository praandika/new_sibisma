<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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
            $data = Sale::join('stocks','sales.stock_id','stocks.id')
            ->join('users','sales.created_by','users.id')
            ->orderBy('sales.id','desc')
            ->select('*','sales.id as id_sale','users.first_name')->limit(400)->get();
        } else {
            $data = Sale::join('stocks','sales.stock_id','stocks.id')
            ->join('users','sales.created_by','users.id')
            ->where('stocks.dealer_id',$did)
            ->orderBy('sales.id','desc')
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
                ->select('*','sales.id as id_sale','users.first_name')
                ->limit(50)->get();
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

    public function printPDF($id){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        if ($dc == 'group') {
            $dealerId = Sale::join('stocks','sales.stock_id','=','stocks.id')
            ->join('dealers','stocks.dealer_id','=','dealers.id')
            ->where('sales.id',$id)
            ->pluck('dealers.id');
            $dealerId = $dealerId[0];

            $dealerCode = Sale::join('stocks','sales.stock_id','=','stocks.id')
            ->join('dealers','stocks.dealer_id','=','dealers.id')
            ->where('stocks.dealer_id',$dealerId)
            ->pluck('dealer_code');
            $dealerCode = $dealerCode[0];

            $count = Sale::join('stocks','sales.stock_id','=','stocks.id')
            ->where('stocks.dealer_id',$dealerId)
            ->count();
            $noKw = $dealerCode.'-'.$id;

            $dealer = Dealer::where('dealer_code',$dealerCode)->get();
        } else {
            $dealerCode = Sale::join('stocks','sales.stock_id','=','stocks.id')
            ->join('dealers','stocks.dealer_id','=','dealers.id')
            ->where('stocks.dealer_id',$did)
            ->pluck('dealer_code');
            $dealerCode = $dealerCode[0];

            $count = Sale::join('stocks','sales.stock_id','=','stocks.id')
            ->where('stocks.dealer_id',$did)
            ->count();
            $noKw = $dealerCode.'-'.$id;

            $dealer = Dealer::where('dealer_code',$dc)->get();
        }

        $name = Sale::where('id',$id)->pluck('customer_name');
        $name = $name[0];

        $unit = Sale::join('stocks','sales.stock_id','=','stocks.id')
        ->join('units','stocks.unit_id','=','units.id')
        ->where('sales.id',$id)
        ->pluck('model_name');
        $unit = $unit[0];

        $data = Sale::join('stocks','sales.stock_id','=','stocks.id')
        ->join('spks','sales.spk','=','spks.spk_no')
        ->join('manpowers','spks.manpower_id','=','manpowers.id')
        ->where('sales.id',$id)
        ->select('*','manpowers.name as manpower')
        ->get();

        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        // $customPaper = array(0,0,850,320);

        $pdf = PDF::loadView('export.pdf-kwitansi',compact('data','printDate','dealer','noKw'));
        $pdf->setPaper('A5','landscape');
        return $pdf->stream('Kwitansi_'.$name.'-'.$unit.'.pdf');
    }

    public function downloadPDF($id){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $dealer = Dealer::where('dealer_code',$dc)->get();

        if ($dc == 'group') {
            $dealerId = Sale::join('stocks','sales.stock_id','=','stocks.id')
            ->join('dealers','stocks.dealer_id','=','dealers.id')
            ->where('sales.id',$id)
            ->pluck('dealers.id');
            $dealerId = $dealerId[0];

            $dealerCode = Sale::join('stocks','sales.stock_id','=','stocks.id')
            ->join('dealers','stocks.dealer_id','=','dealers.id')
            ->where('stocks.dealer_id',$dealerId)
            ->pluck('dealer_code');
            $dealerCode = $dealerCode[0];

            $count = Sale::join('stocks','sales.stock_id','=','stocks.id')
            ->where('stocks.dealer_id',$dealerId)
            ->count();
            $noKw = $dealerCode.'-'.$id;

            $dealer = Dealer::where('dealer_code',$dealerCode)->get();
        } else {
            $dealerCode = Sale::join('stocks','sales.stock_id','=','stocks.id')
            ->join('dealers','stocks.dealer_id','=','dealers.id')
            ->where('stocks.dealer_id',$did)
            ->pluck('dealer_code');
            $dealerCode = $dealerCode[0];

            $count = Sale::join('stocks','sales.stock_id','=','stocks.id')
            ->where('stocks.dealer_id',$did)
            ->count();
            $noKw = $dealerCode.'-'.$id;

            $dealer = Dealer::where('dealer_code',$dc)->get();
        }

        $name = Sale::where('id',$id)->pluck('customer_name');
        $name = $name[0];

        $unit = Sale::join('stocks','sales.stock_id','=','stocks.id')
        ->join('units','stocks.unit_id','=','units.id')
        ->where('sales.id',$id)
        ->pluck('model_name');
        $unit = $unit[0];

        $data = Sale::join('stocks','sales.stock_id','=','stocks.id')
        ->join('spks','sales.spk','=','spks.spk_no')
        ->join('manpowers','spks.manpower_id','=','manpowers.id')
        ->where('sales.id',$id)
        ->select('*','manpowers.name as manpower')
        ->get();

        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        // $customPaper = array(0,0,850,320);

        $pdf = PDF::loadView('export.pdf-kwitansi',compact('data','printDate','dealer','noKw'));
        $pdf->setPaper('A5','landscape');
        return $pdf->download('Kwitansi_'.$name.'-'.$unit.'.pdf');
    }
}

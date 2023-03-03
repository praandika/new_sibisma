<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Models\Leasing;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class LeasingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Leasing::all();
        return view('page', compact('data'));
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
    public function store(Request $req)
    {
        for ($i=0; $i < count($req->leasing_code); $i++) { 
            Leasing::insert([
                'leasing_code' => $req->leasing_code[$i],
                'leasing_name' => $req->leasing_name[$i],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
        toast('Data leasing berhasil disimpan','success');
        return redirect()->route('leasing.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Leasing $leasing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Leasing $leasing)
    {
        return view('page', compact('leasing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Leasing $leasing)
    {
        Leasing::where('id',$leasing->id)->update([
            'leasing_code' => $req->leasing_code,
            'leasing_name' => $req->leasing_name,
            'updated_by' => Auth::user()->id,
        ]);
        toast('Data leasing berhasil diubah','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id){
        Leasing::find($id)->delete();
        toast('Data leasing berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Leasing::whereIn('id',$req->pilih)->delete();
        toast('Data leasing berhasil dihapus','success');
        return redirect()->back();
    }

    public function printKwitansiDpPDF($id){
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

        $pdf = PDF::loadView('export.pdf-kwitansi-dp',compact('data','printDate','dealer','noKw'));
        $pdf->setPaper('A5','landscape');
        return $pdf->stream('Kwitansi_DP_'.$name.'-'.$unit.'.pdf');
    }

    public function printKwitansiPelunasan($id){
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
        ->join('leasings','sales.leasing_id','=','leasings.id')
        ->join('spks','sales.spk','=','spks.spk_no')
        ->join('manpowers','spks.manpower_id','=','manpowers.id')
        ->where('sales.id',$id)
        ->select('*','manpowers.name as manpower','spks.order_status','spks.tandajadi')
        ->get();

        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        // $customPaper = array(0,0,850,320);

        $pdf = PDF::loadView('export.pdf-kwitansi-pelunasan',compact('data','printDate','dealer','noKw'));
        $pdf->setPaper('A5','landscape');
        return $pdf->stream('Kwitansi_Pelunasan_'.$name.'-'.$unit.'.pdf');
    }
}

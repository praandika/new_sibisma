<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dealer;
use App\Models\Stock;
use App\Models\Unit;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class StockController extends Controller
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
            $unit = Unit::orderBy('model_name', 'desc')->get();
            $data = Stock::orderBy('qty','desc')->get(); 
            return view('page', compact('data','dealer','unit'));

        } else {
            // View units that have not been inputted to stock by dealer code
            $stock = Stock::join('dealers','stocks.dealer_id','=','dealers.id')
            ->select('unit_id')
            ->where('dealer_code',$dc)
            ->get();
            $unit_id = [];
            foreach($stock as $o){
                array_push($unit_id,$o->unit_id);
            }
            $unit = Unit::whereNotIn('id',$unit_id)->orderBy('model_name', 'desc')->get();
            // --------------------------------------------
            
            $data = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get();
            $dealerName = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
            $dealerName = $dealerName[0];
            $dealerId = Dealer::where('dealer_code',$dc)->pluck('id');
            $dealerId = $dealerId[0];
            return view('page', compact('data','dealer','unit','dealerName','dealerId'));

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
    public function store(Request $req)
    {
        // Checking Stock
        $cek = Stock::where([['unit_id',$req->unit_id],['dealer_id',$req->dealer_id]])->count();
        if ($cek > 0) {
            alert()->warning('Warning','Unit is already at '.$req->dealer_name.'');
            return redirect()->back()->with('display', true)->withInput($req->input());
        } else {
            $data = new Stock;
            $data->unit_id = $req->unit_id;
            $data->dealer_id = $req->dealer_id;
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;
            if ($req->qty == '') {
                $data->qty = 0;
            } else {
                $data->qty = $req->qty;
            }
            $data->save();

            // Write log
            $log = new Log;
            $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
            $log->activity = 'creates stock data';
            $log->user_id = Auth::user()->id;
            $log->save();

            toast('Data stock berhasil disimpan','success');
            return redirect()->back()->with('display', true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        $otherColors = Stock::join('units','units.id','=','stocks.unit_id')
        ->where([
            ['units.model_name', $stock->unit->model_name],
            ['stocks.qty', '>', 0],
        ])
        ->groupBy('color_id')
        ->get();

        $otherDealers = Stock::join('units','units.id','=','stocks.unit_id')
        ->join('dealers','dealers.id','=','stocks.dealer_id')
        ->where([
            ['units.model_name', $stock->unit->model_name],
            ['stocks.qty', '>', 0],
        ])
        ->groupBy('dealer_id')
        ->get();

        $otherYears = Stock::join('units','units.id','=','stocks.unit_id')
        ->join('dealers','dealers.id','=','stocks.dealer_id')
        ->where([
            ['units.model_name', $stock->unit->model_name],
            ['stocks.qty', '>', 0],
        ])
        ->groupBy('year_mc')
        ->get();
        // dd($otherYears);
        return view('page', compact('stock','otherColors','otherDealers','otherYears'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        // 
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
        Stock::find($id)->delete();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'deletes a stock data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data stock berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Stock::whereIn('id',$req->pilih)->delete();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'deletes some stocks data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data stock berhasil dihapus','success');
        return redirect()->back();
    }

    public function ratio(){
        return view('page');
    }
}

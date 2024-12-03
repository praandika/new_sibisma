<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Opname;
use App\Models\Stock;
use App\Models\Dealer;
use App\Models\Log;
use App\Models\StockHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OpnameController extends Controller
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
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        if ($dc == 'group') {
            $stock = Stock::join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->select('units.model_name','colors.color_name','colors.color_code','units.year_mc','stocks.qty','dealers.dealer_code','dealers.dealer_name','stocks.id as id')
            ->orderBy('stocks.qty','desc')
            ->get();

            $data = Opname::where('opname_date',$today)->orderBy('id','desc')->get();
        }else{
            $stock = Stock::join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->select('units.model_name','colors.color_name','colors.color_code','units.year_mc','stocks.qty','dealers.dealer_code','dealers.dealer_name','stocks.id as id')
            ->where('stocks.dealer_id',$did)
            ->orderBy('stocks.qty','desc')
            ->get();
            
            $data = Opname::join('stocks','opnames.stock_id','stocks.id')
            ->where('stocks.dealer_id',$did)
            ->where('opname_date',$today)->orderBy('opnames.id','desc')->get();
        }
        return view('page', compact('stock','today','data'));
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
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $qty = $req->on_hand;
        $opname = $req->stock_opname;

        if ($qty > $opname) {
            $diff = $qty - $opname;
        } else {
            $diff = $opname - $qty;
        }
        
        $data = new Opname;
        $data->opname_date = $req->opname_date;
        $data->stock_id = $req->stock_id;
        $data->stock_system = $req->on_hand;
        $data->stock_opname = $req->stock_opname;
        $data->difference = $diff;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();

        $stock = Stock::where('id', $req->stock_id)->first();
        $stock->qty = $req->stock_opname;
        $stock->save();

        // Update Stock History
        if ($dc == 'group') {
            $dealerCode = Stock::join('dealers','stocks.dealer_id','dealers.id')
            ->where('stocks.id', $req->stock_id)
            ->pluck('dealers.dealer_code');
            $dealerCode = $dealerCode[0];
            $dealerId = Stock::where('stocks.id', $req->stock_id)
            ->sum('dealer_id');
            $his = StockHistory::where('dealer_code', $dealerCode)->orderBy('history_date','desc')->first();
            $countHis = StockHistory::where('dealer_code', $dealerCode)->orderBy('history_date','desc')->count();
            
            $lastStock = Stock::where('dealer_id', $dealerId)->sum('qty');
            // dd($dealerCode, $dealerId, $his);
        }else{
            $his = StockHistory::where('dealer_code', $dc)->orderBy('history_date','desc')->first();
            $countHis = StockHistory::where('dealer_code', $dc)->orderBy('history_date','desc')->count();
            $lastStock = Stock::where('dealer_id', $did)->sum('qty');
            // dd($dc);
        }
        
        if ($countHis > 0) {
            $his->last_stock = $lastStock;
            $his->opname = 'yes';
            $his->save();
        }
        //END Update Stock History

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'creates stock opname data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data stock opname berhasil disimpan','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $req, $id)
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

    public function history(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = Opname::join('stocks','opnames.stock_id','stocks.id')
                ->orderBy('opnames.opname_date','desc')->limit(50)->get();
            }else{
                $data = Opname::join('stocks','opnames.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('opnames.opname_date','desc')->limit(50)->get();
            }
            
        } else {
            if ($dc == 'group') {
                $data = Opname::join('stocks','opnames.stock_id','stocks.id')
                ->whereBetween('opname_date',[$req->start, $req->end])->orderBy('opnames.opname_date','desc')->get();
            }else{
                $data = Opname::join('stocks','opnames.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('opname_date',[$req->start, $req->end])->orderBy('opnames.opname_date','desc')->get();
            }
        }
        return view('page', compact('data','start','end'));
    }
}

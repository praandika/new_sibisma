<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Sale;
use App\Models\Out;
use App\Models\Dealer;
use App\Models\Stock;
use App\Models\StockHistory;
use App\Models\Log;
use Carbon\Carbon;
use Auth;

class EntryController extends Controller
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
            
            $data = Entry::where('entry_date',$today)->orderBy('id','desc')->get();
            return view('page', compact('stock','today','data'));
        } else {
            $stock = Stock::join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->select('units.model_name','colors.color_name','colors.color_code','units.year_mc','stocks.qty','dealers.dealer_code','dealers.dealer_name','stocks.id as id')
            ->where('stocks.dealer_id',$did)
            ->orderBy('stocks.qty','desc')
            ->get();

            $dealerCode = $dc;
            $data = Entry::join('stocks','entries.stock_id','stocks.id')
            ->join('dealers','entries.dealer_id','dealers.id')
            ->where('entry_date',$today)->where('stocks.dealer_id',$did)->orderBy('entries.id','desc')
            ->select('dealers.dealer_name','stocks.*','entries.*')->get();
            // dd($data);

            return view('page', compact('stock','today','data','dealerCode'));
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
        if (Auth::user()->dealer_code == 'group') {
            $dealer_code = $req->dealer_code;
        } else {
            $dealer_code = Auth::user()->dealer_code;
        }

        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $dealerId = Dealer::where('dealer_code',$req->dealer_code)->sum('id');

        // Get Stok ID from Input
        $stockId = $req->stock_id;

        // Get Latest Stok from Stock Table
        $latestStock = Stock::where('id',$stockId)->sum('qty');

        // Get Entry QTY
        $entryQty = $req->in_qty;

        // Update Stock
        $updateStock = $latestStock + $entryQty;
        // dd($stockId);

        /** ============== Create Or Update Stock History ============== */
        if($dc == 'group'){
            $isSale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$req->entry_date)
            ->where('stocks.dealer_id',$dealerId)->count();
            $isOut = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$req->entry_date)
            ->where('stocks.dealer_id',$dealerId)->count();
            $isEntry = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$req->entry_date)
            ->where('stocks.dealer_id',$dealerId)->count();
    
            // Count first stock
            $stock = Stock::where('dealer_id',$dealerId)->sum('qty');
            $in = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$req->entry_date)
            ->where('stocks.dealer_id',$dealerId)->sum('in_qty');
            $in = ($in == 0) ? $in = 0 : (int)$in ;
            $out = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$req->entry_date)
            ->where('stocks.dealer_id',$dealerId)->sum('out_qty');
            $out = ($out == 0) ? $out = 0 : (int)$out ;
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$req->entry_date)
            ->where('stocks.dealer_id',$dealerId)->sum('sale_qty');
            $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
            $ios = $in + $out + $sale;
            $firstStock = $stock - $ios;
        }else{
            $isSale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$req->entry_date)
            ->where('stocks.dealer_id',$did)->count();
            $isOut = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$req->entry_date)
            ->where('stocks.dealer_id',$did)->count();
            $isEntry = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$req->entry_date)
            ->where('stocks.dealer_id',$did)->count();
    
            // Count first stock
            $stock = Stock::where('dealer_id',$did)->sum('qty');
            $in = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$req->entry_date)
            ->where('stocks.dealer_id',$did)->sum('in_qty');
            $in = ($in == 0) ? $in = 0 : (int)$in ;
            $out = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$req->entry_date)
            ->where('stocks.dealer_id',$did)->sum('out_qty');
            $out = ($out == 0) ? $out = 0 : (int)$out ;
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$req->entry_date)
            ->where('stocks.dealer_id',$did)->sum('sale_qty');
            $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
            $ios = $in + $out + $sale;
            $firstStock = $stock - $ios;
        }
        
        /** ============== END Create Or Update Stock History ============== */ 

        $data = new Entry;
        $data->entry_date = $req->entry_date;
        $data->stock_id = $req->stock_id;
        $data->dealer_id = $req->dealer_id;
        $data->in_qty = $req->in_qty;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();

        // Update Stock Table
        $stock = Stock::where('id',$stockId)->first();
        $stock->qty = $updateStock;
        $stock->updated_by = Auth::user()->id;
        $stock->update();

        /** ============== END Create Or Update Stock History ============== */ 

        // Get QTY after update
        if ($dc == 'group') {
            $entry_qty = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$req->entry_date)
            ->where('stocks.dealer_id',$dealerId)->sum('in_qty');
            $lastStock = Stock::where('dealer_id',$dealerId)->sum('qty');
        } else {
            $entry_qty = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$req->entry_date)
            ->where('stocks.dealer_id',$did)->sum('in_qty');
            $lastStock = Stock::where('dealer_id',$did)->sum('qty');
        }

        if ($isEntry > 0 && $isOut > 0 && $isSale > 0) {
            // If that variables has records -> Update History
            if ($dc == 'group') {
                $his = StockHistory::where('history_date',$req->entry_date)
                ->where('dealer_code',$req->dealer_code)->first();
            } else {
                $his = StockHistory::where('history_date',$req->entry_date)
                ->where('dealer_code',$dc)->first();
            }
            
            $his->in_qty = $entry_qty;
            $his->out_qty = $out;
            $his->sale_qty = $sale;
            $his->last_stock = $lastStock;
            $his->updated_by = Auth::user()->id;
            $his->update();
        } elseif($isEntry > 0 || $isOut > 0 || $isSale > 0) {
            // If one of them have records -> Update History
            if ($dc == 'group') {
                $his = StockHistory::where('history_date',$req->entry_date)
                ->where('dealer_code',$req->dealer_code)->first();
            } else {
                $his = StockHistory::where('history_date',$req->entry_date)
                ->where('dealer_code',$dc)->first();
            }

            $his->in_qty = $entry_qty;
            $his->out_qty = $out;
            $his->sale_qty = $sale;
            $his->last_stock = $lastStock;
            $his->updated_by = Auth::user()->id;
            $his->update();
        } else {
            // If no record by input date in DB -> Create History
            if ($dc == 'group') {
                $cek = StockHistory::where('history_date',$req->entry_date)
                ->where('dealer_code',$req->dealer_code)->count();
            } else {
                $cek = StockHistory::where('history_date',$req->entry_date)
                ->where('dealer_code',$dc)->count();
            }
            
            if ($cek > 0) {
                // if Stock history's table contain data with the same date -> Update History
                if ($dc == 'group') {
                    $his = StockHistory::where('history_date',$req->entry_date)
                    ->where('dealer_code',$req->dealer_code)->first();
                } else {
                    $his = StockHistory::where('history_date',$req->entry_date)
                    ->where('dealer_code',$dc)->first();
                }
                $his->in_qty = $entry_qty;
                $his->out_qty = $out;
                $his->sale_qty = $sale;
                $his->last_stock = $lastStock;
                $his->updated_by = Auth::user()->id;
                $his->update();
            } else {
                // if no record by date or by date and dealer code in stock history's table -> Create History
                $his = new StockHistory;
                $his->id_key = Carbon::now('GMT+8')->format('H').'sh'.$dealer_code.Carbon::now('GMT+8')->format('Y').Carbon::now('GMT+8')->format('i').Carbon::now('GMT+8')->format('m').'b'.Carbon::now('GMT+8')->format('d').Carbon::now('GMT+8')->format('s');
                $his->history_date = $req->entry_date;
                $his->dealer_code = $dealer_code;
                $his->first_stock = $firstStock;
                $his->in_qty = $entry_qty;
                $his->out_qty = $out;
                $his->sale_qty = $sale;
                $his->last_stock = $lastStock;
                $his->created_by = Auth::user()->id;
                $his->updated_by = Auth::user()->id;
                $his->save();
            }
        }
        /** ============== END Create Or Update Stock History ============== */ 

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'creates entry units data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data entry berhasil disimpan','success');
        return redirect()->back()->withInput($req->except('stock_id', 'model_name','color','year_mc','on_hand','dealer_id','dealer_name','in_qty'));
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

    public function delete($id){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        // Get Stock ID from Entry Table
        $stockId = Entry::where('id',$id)->pluck('stock_id');

        // Get Latest Stock from Stock Table
        $latestStock = Stock::where('id',$stockId)->sum('qty');

        // Get Deleted QTY
        $delQty = Entry::where('id',$id)->sum('in_qty');

        // Update Stock
        $updateStock = $latestStock - $delQty;

        /** ============== Create Or Update Stock History ============== */
        $entry_date = Entry::where('id',$id)->pluck('entry_date');
        $dealer_code = Entry::join('stocks','entries.stock_id','stocks.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->where('entries.id',$id)
        ->pluck('dealers.dealer_code');
        $dealerId = Entry::join('stocks','entries.stock_id','stocks.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->where('entries.id',$id)
        ->pluck('dealers.id');

        if($dc == 'group'){
            // Count first stock
            $stock = Stock::where('dealer_id',$dealerId)->sum('qty');
            $in = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$entry_date)
            ->where('stocks.dealer_id',$dealerId)->sum('in_qty');
            $in = ($in == 0) ? $in = 0 : (int)$in ;
            $out = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$entry_date)
            ->where('stocks.dealer_id',$dealerId)->sum('out_qty');
            $out = ($out == 0) ? $out = 0 : (int)$out ;
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$entry_date)
            ->where('stocks.dealer_id',$dealerId)->sum('sale_qty');
            $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
        }else{
            // Count first stock
            $stock = Stock::where('dealer_id',$did)->sum('qty');
            $in = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$entry_date)
            ->where('stocks.dealer_id',$did)->sum('in_qty');
            $in = ($in == 0) ? $in = 0 : (int)$in;
            $out = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$entry_date)
            ->where('stocks.dealer_id',$did)->sum('out_qty');
            $out = ($out == 0) ? $out = 0 : (int)$out;
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$entry_date)
            ->where('stocks.dealer_id',$did)->sum('sale_qty');
            $sale = ($sale == 0) ? $sale = 0 : (int)$sale;
        }
        /** ============== END Create Or Update Stock History ============== */ 

        // dd($updateStock);
        Entry::find($id)->delete();

        // Update Stock Table
        $stock = Stock::where('id',$stockId)->first();
        $stock->qty = $updateStock;
        $stock->updated_by = Auth::user()->id;
        $stock->save();

        /** ============== END Create Or Update Stock History ============== */ 
        // Get QTY after update
        if ($dc == 'group') {
            $entry_qty = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$entry_date)
            ->where('stocks.dealer_id',$dealerId)->sum('in_qty');
            $entry_qty = ($entry_qty == 0) ? $entry_qty = 0 : (int)$entry_qty;
            $lastStock = Stock::where('dealer_id',$dealerId)->sum('qty');
        } else {
            $entry_qty = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$entry_date)
            ->where('stocks.dealer_id',$did)->sum('in_qty');
            $entry_qty = ($entry_qty == 0) ? $entry_qty = 0 : (int)$entry_qty;
            $lastStock = Stock::where('dealer_id',$did)->sum('qty');
        }

        // Update Stock History
        if ($dc == 'group') {
            $his = StockHistory::where('history_date',$entry_date)
            ->where('dealer_code',$dealer_code)->first();
        }else{
            $his = StockHistory::where('history_date',$entry_date)
            ->where('dealer_code',$dc)->first();
        }
        
        $his->in_qty = $entry_qty;
        $his->out_qty = $out;
        $his->sale_qty = $sale;
        $his->last_stock = $lastStock;
        $his->updated_by = Auth::user()->id;
        $his->save();
        /** ============== END Create Or Update Stock History ============== */ 

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'deletes entry units data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data entry berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Entry::whereIn('id',$req->pilih)->delete();
        toast('Data entry berhasil dihapus','success');
        return redirect()->back();
    }

    public function history(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $yes = Carbon::yesterday('GMT+8')->format('Y-m-d');

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = Entry::join('stocks','entries.stock_id','stocks.id')
                ->join('dealers','entries.dealer_id','dealers.id')
                ->orderBy('entry_date','desc')
                ->select('dealers.dealer_name','stocks.*','entries.*')
                ->limit(20)->get();
                // dd($data);
            }else{
                $data = Entry::join('stocks','entries.stock_id','stocks.id')
                ->join('dealers','entries.dealer_id','dealers.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('entry_date','desc')
                ->select('dealers.dealer_name','stocks.*','entries.*')
                ->limit(20)->get();
            }
            
        } else {
            if ($dc == 'group') {
                $data = Entry::join('stocks','entries.stock_id','stocks.id')
                ->join('dealers','entries.dealer_id','dealers.id')
                ->whereBetween('entry_date',[$req->start, $req->end])
                ->select('dealers.dealer_name','stocks.*','entries.*')->get();
            }else{
                $data = Entry::join('stocks','entries.stock_id','stocks.id')
                ->join('dealers','entries.dealer_id','dealers.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('entry_date',[$req->start, $req->end])
                ->select('dealers.dealer_name','stocks.*','entries.*')->get();
            }
        }
        return view('page', compact('data','start','end'));
    }

    // PAGE Show All Achievment
    public function achievment($param){
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');
        $tgl = Carbon::now('GMT+8');
        $lastMonth = $tgl->subMonth()->format('Y-m');
        $lastYear = $year - 1;

        $sentral = Dealer::where('dealer_code','AA0101')->sum('id');
        $cokro = Dealer::where('dealer_code','AA0102')->sum('id');
        $ud = Dealer::where('dealer_code','AA0104')->sum('id');
        $tts = Dealer::where('dealer_code','AA0105')->sum('id');
        $imbo = Dealer::where('dealer_code','AA0106')->sum('id');
        $mandiri = Dealer::where('dealer_code','AA0107')->sum('id');
        $wr = Dealer::where('dealer_code','AA0108')->sum('id');
        $sr = Dealer::where('dealer_code','AA0109')->sum('id');
        $fss = Dealer::where('dealer_code','AA0104F')->sum('id');
        $dalung = Dealer::where('dealer_code','AA0104-01')->sum('id');

        if ($param == 'lm') {
            // Sentral
            $last_01 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sentral)
            ->where('entry_date','like', $lastMonth.'%')
            ->sum('in_qty');
            $data_01 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sentral)
            ->whereMonth('entry_date', $month)
            ->sum('in_qty');
            
            // Cokro
            $last_02 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->where('entry_date','like', $lastMonth.'%')
            ->sum('in_qty');
            $data_02 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->whereMonth('entry_date', $month)
            ->sum('in_qty');

            // UD
            $last_04 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $ud)
            ->where('entry_date','like', $lastMonth.'%')
            ->sum('in_qty');
            $data_04 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $ud)
            ->whereMonth('entry_date', $month)
            ->sum('in_qty');

            // TTS
            $last_05 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $tts)
            ->where('entry_date','like', $lastMonth.'%')
            ->sum('in_qty');
            $data_05 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $tts)
            ->whereMonth('entry_date', $month)
            ->sum('in_qty');

            // Imbo
            $last_06 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->where('entry_date','like', $lastMonth.'%')
            ->sum('in_qty');
            $data_06 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $imbo)
            ->whereMonth('entry_date', $month)
            ->sum('in_qty');

            // Mandiri
            $last_07 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $mandiri)
            ->where('entry_date','like', $lastMonth.'%')
            ->sum('in_qty');
            $data_07 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $mandiri)
            ->whereMonth('entry_date', $month)
            ->sum('in_qty');

            // WR
            $last_08 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $wr)
            ->where('entry_date','like', $lastMonth.'%')
            ->sum('in_qty');
            $data_08 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $wr)
            ->whereMonth('entry_date', $month)
            ->sum('in_qty');

            // SR
            $last_09 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sr)
            ->where('entry_date','like', $lastMonth.'%')
            ->sum('in_qty');
            $data_09 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sr)
            ->whereMonth('entry_date', $month)
            ->sum('in_qty');

            // Dalung
            $last_0401 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $dalung)
            ->where('entry_date','like', $lastMonth.'%')
            ->sum('in_qty');
            $data_0401 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $dalung)
            ->whereMonth('entry_date', $month)
            ->sum('in_qty');

            // FSS
            $last_04F = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $fss)
            ->where('entry_date','like', $lastMonth.'%')
            ->sum('in_qty');
            $data_04F = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $fss)
            ->whereMonth('entry_date', $month)
            ->sum('in_qty');
            
            // Bisma Group
            $last = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id','!=', $fss)
            ->where('entry_date','like', $lastMonth.'%')
            ->sum('in_qty');
            $data = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id','!=', $fss)
            ->whereMonth('entry_date', $month)
            ->sum('in_qty');

            // Bisma Group + FSS
            $lastPlus = Entry::where('entry_date','like', $lastMonth.'%')->sum('in_qty');
            $dataPlus = Entry::whereMonth('entry_date', $month)->sum('in_qty');
            
        } else {
            // Sentral
            $last_01 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sentral)
            ->where('entry_date','like', $lastYear.'%')
            ->sum('in_qty');
            $data_01 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sentral)
            ->whereYear('entry_date', $year)
            ->sum('in_qty');
            
            // Cokro
            $last_02 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->where('entry_date','like', $lastYear.'%')
            ->sum('in_qty');
            $data_02 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->whereYear('entry_date', $year)
            ->sum('in_qty');

            // UD
            $last_04 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $ud)
            ->where('entry_date','like', $lastYear.'%')
            ->sum('in_qty');
            $data_04 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $ud)
            ->whereYear('entry_date', $year)
            ->sum('in_qty');

            // TTS
            $last_05 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $tts)
            ->where('entry_date','like', $lastYear.'%')
            ->sum('in_qty');
            $data_05 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $tts)
            ->whereYear('entry_date', $year)
            ->sum('in_qty');

            // Imbo
            $last_06 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->where('entry_date','like', $lastYear.'%')
            ->sum('in_qty');
            $data_06 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $imbo)
            ->whereYear('entry_date', $year)
            ->sum('in_qty');

            // Mandiri
            $last_07 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $mandiri)
            ->where('entry_date','like', $lastYear.'%')
            ->sum('in_qty');
            $data_07 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $mandiri)
            ->whereYear('entry_date', $year)
            ->sum('in_qty');

            // WR
            $last_08 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $wr)
            ->where('entry_date','like', $lastYear.'%')
            ->sum('in_qty');
            $data_08 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $wr)
            ->whereYear('entry_date', $year)
            ->sum('in_qty');

            // SR
            $last_09 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sr)
            ->where('entry_date','like', $lastYear.'%')
            ->sum('in_qty');
            $data_09 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sr)
            ->whereYear('entry_date', $year)
            ->sum('in_qty');

            // Dalung
            $last_0401 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $dalung)
            ->where('entry_date','like', $lastYear.'%')
            ->sum('in_qty');
            $data_0401 = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $dalung)
            ->whereYear('entry_date', $year)
            ->sum('in_qty');

            // FSS
            $last_04F = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $fss)
            ->where('entry_date','like', $lastYear.'%')
            ->sum('in_qty');
            $data_04F = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $fss)
            ->whereYear('entry_date', $year)
            ->sum('in_qty');
            
            // Bisma Group
            $last = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id','!=', $fss)
            ->where('entry_date','like', $lastYear.'%')
            ->sum('in_qty');
            $data = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id','!=', $fss)
            ->whereYear('entry_date', $year)
            ->sum('in_qty');

            // Bisma Group + FSS
            $lastPlus = Entry::whereYear('entry_date', $lastYear)->sum('in_qty');
            $dataPlus = Entry::whereYear('entry_date', $year)->sum('in_qty');
        }

        // Sentral
        if ($last_01 == 0) {
            $vs_01 = 0*100;
        } else {
            $vs_01 = ($data_01 / $last_01)*100;
        }

        // Cokro
        if ($last_02 == 0) {
            $vs_02 = 0*100;
        } else {
            $vs_02 = ($data_02 / $last_02)*100;
        }

        // UD
        if ($last_04 == 0) {
            $vs_04 = 0*100;
        } else {
            $vs_04 = ($data_04 / $last_04)*100;
        }

        // TTS
        if ($last_05 == 0) {
            $vs_05 = 0*100;
        } else {
            $vs_05 = ($data_05 / $last_05)*100;
        }

        // Imbo
        if ($last_06 == 0) {
            $vs_06 = 0*100;
        } else {
            $vs_06 = ($data_06 / $last_06)*100;
        }

        // Mandiri
        if ($last_07 == 0) {
            $vs_07 = 0*100;
        } else {
            $vs_07 = ($data_07 / $last_07)*100;
        }

        // WR
        if ($last_08 == 0) {
            $vs_08 = 0*100;
        } else {
            $vs_08 = ($data_08 / $last_08)*100;
        }

        // SR
        if ($last_09 == 0) {
            $vs_09 = 0*100;
        } else {
            $vs_09 = ($data_09 / $last_09)*100;
        }

        // Dalung
        if ($last_0401 == 0) {
            $vs_0401 = 0*100;
        } else {
            $vs_0401 = ($data_0401 / $last_0401)*100;
        }

        // FSS
        if ($last_04F == 0) {
            $vs_04F = 0*100;
        } else {
            $vs_04F = ($data_04F / $last_04F)*100;
        }

        // Bisma Group
        if ($last == 0) {
            $vs = 0*100;
        } else {
            $vs = ($data / $last)*100;
        }

        // Bisma Group + FSS
        if ($lastPlus == 0) {
            $vsPlus = 0*100;
        } else {
            $vsPlus = ($dataPlus / $lastPlus)*100;
        }

        $vs_01 = number_format($vs_01, 1);
        $vs_02 = number_format($vs_02, 1);
        $vs_04 = number_format($vs_04, 1);
        $vs_05 = number_format($vs_05, 1);
        $vs_06 = number_format($vs_06, 1);
        $vs_07 = number_format($vs_07, 1);
        $vs_08 = number_format($vs_08, 1);
        $vs_09 = number_format($vs_09, 1);
        $vs_0401 = number_format($vs_0401, 1);
        $vs_04F = number_format($vs_04F, 1);
        $vs = number_format($vs, 1);
        $vsPlus = number_format($vsPlus, 1);
        return view('page', compact(
            'param',
            'last_01','data_01','vs_01',
            'last_02','data_02','vs_02',
            'last_04','data_04','vs_04',
            'last_05','data_05','vs_05',
            'last_06','data_06','vs_06',
            'last_07','data_07','vs_07',
            'last_08','data_08','vs_08',
            'last_09','data_09','vs_09',
            'last_0401','data_0401','vs_0401',
            'last_04F','data_04F','vs_04F',
            'last','data','vs',
            'lastPlus','dataPlus','vsPlus'
        ));
    }
}

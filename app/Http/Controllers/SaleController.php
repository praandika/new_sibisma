<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Sale;
use App\Models\Out;
use App\Models\Leasing;
use App\Models\Stock;
use App\Models\Document;
use App\Models\Log;
use App\Models\Spk;
use App\Models\StockHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
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

        $dealer = Dealer::all();
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        if ($dc == 'group') {
            $stock = Spk::join('stocks','spks.stock_id','stocks.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('leasings','spks.leasing_id','leasings.id')
            ->where('spks.sale_status','pending')
            ->where('spks.order_status','available')
            ->where(function($query){
                $query->where('spks.order_status','!=','indent')
                      ->where('spks.credit_status','acc')
                      ->orWhere('spks.credit_status','cash');
            })
            ->orderBy('stocks.qty','desc')
            ->select('stocks.*','spks.stock_id as idstok','spks.id as idspk','spks.*','leasings.leasing_code','units.*','dealers.dealer_name','dealers.dealer_code','colors.color_name','colors.color_code')->get();
            $data = Sale::where('sale_date',$today)->orderBy('id','desc')->get();
            return view('page', compact('stock','today','data','dealer'));
        }else{
            $stock = Spk::join('stocks','spks.stock_id','stocks.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('leasings','spks.leasing_id','leasings.id')
            ->where('stocks.dealer_id',$did)
            ->where('spks.sale_status','pending')
            ->where('spks.order_status','available')
            ->where(function($query){
                $query->where('spks.order_status','!=','indent')
                      ->where('spks.credit_status','acc')
                      ->orWhere('spks.credit_status','cash');
            })
            ->orderBy('stocks.qty','desc')
            ->select('stocks.*','spks.stock_id as idstok','spks.id as idspk','spks.*','leasings.leasing_code','units.*','dealers.dealer_name','dealers.dealer_code','colors.color_name','colors.color_code')->get();
            $dealerCode = $dc;
            $data = Sale::join('stocks','sales.stock_id','stocks.id')
            ->join('users','sales.created_by','users.id')
            ->where('sale_date',$today)->where('stocks.dealer_id',$did)->orderBy('sales.id','desc')
            ->select('*','sales.id as id_sale','users.first_name')->get();
            return view('page', compact('stock','today','data','dealer','dealerCode'));
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

        // Get Sold QTY
        $soldQty = 1;

        // Update Stock
        $updateStock = $latestStock - $soldQty;

        /** ============== Create Or Update Stock History ============== */
        if($dc == 'group'){
            $isSale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$req->sale_date)
            ->where('stocks.dealer_id',$dealerId)->count();
            $isOut = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$req->sale_date)
            ->where('stocks.dealer_id',$dealerId)->count();
            $isEntry = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$req->sale_date)
            ->where('stocks.dealer_id',$dealerId)->count();
    
            // Count first stock
            $stock = Stock::where('dealer_id',$dealerId)->sum('qty');
            $in = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$req->sale_date)
            ->where('stocks.dealer_id',$dealerId)->sum('in_qty');
            $in = ($in == 0) ? $in = 0 : (int)$in ;
            $out = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$req->sale_date)
            ->where('stocks.dealer_id',$dealerId)->sum('out_qty');
            $out = ($out == 0) ? $out = 0 : (int)$out ;
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$req->sale_date)
            ->where('stocks.dealer_id',$dealerId)->sum('sale_qty');
            $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
            $ios = $in + $out + $sale;
            $firstStock = $stock - $ios;
        }else{
            $isSale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$req->sale_date)
            ->where('stocks.dealer_id',$did)->count();
            $isOut = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$req->sale_date)
            ->where('stocks.dealer_id',$did)->count();
            $isEntry = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$req->sale_date)
            ->where('stocks.dealer_id',$did)->count();
    
            // Count first stock
            $stock = Stock::where('dealer_id',$did)->sum('qty');
            $in = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$req->sale_date)
            ->where('stocks.dealer_id',$did)->sum('in_qty');
            $in = ($in == 0) ? $in = 0 : (int)$in ;
            $out = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$req->sale_date)
            ->where('stocks.dealer_id',$did)->sum('out_qty');
            $out = ($out == 0) ? $out = 0 : (int)$out ;
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$req->sale_date)
            ->where('stocks.dealer_id',$did)->sum('sale_qty');
            $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
            $ios = $in + $out + $sale;
            $firstStock = $stock - $ios;
        }
        
        /** ============== END Create Or Update Stock History ============== */ 
        if ($dc == 'group') {
            $frameSale = Sale::where('frame_no',$req->frame_no)->count('frame_no');
            $frameOut = Out::where('frame_no',$req->frame_no)->count('frame_no');
        }else{
            $frameSale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('frame_no',$req->frame_no)
            ->where('stocks.dealer_id',$did)->count('frame_no');
            $frameOut = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('frame_no',$req->frame_no)
            ->where('stocks.dealer_id',$did)->count('frame_no');
        }

        if ($frameSale > 0 || $frameOut > 0) {
            alert()->warning('Warning','Frame number already sold!');
            return redirect()->back()->with('auto', true)->withInput($req->input());
        } else {
            $data = new Sale;
            $data->sale_date = $req->sale_date;
            $data->stock_id = $req->stock_id;
            $data->nik = $req->nik;
            $data->customer_name = strtoupper($req->customer_name);
            $data->phone = $req->phone;
            $data->address = $req->address;
            $data->sale_qty = 1;
            $data->frame_no = strtoupper($req->frame_no);
            $data->engine_no = $req->engine_no;
            $data->leasing_id = $req->leasing_id;
            $data->spk = $req->spk_no;
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;
            $data->save();

            // Update Stock Table
            $stock = Stock::where('id',$stockId)->first();
            $stock->qty = $updateStock;
            $stock->updated_by = Auth::user()->id;
            $stock->update();
            
            /** ============== Create Documents ============== */ 
            if ($dc == 'group') {
                $cekframe = Sale::where('frame_no',$req->frame_no)->count('frame_no');
            }else{
                $cekframe = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('frame_no',$req->frame_no)
                ->where('stocks.dealer_id',$did)->count('frame_no');
            }
            

            if($cekframe > 0){
                if ($dc == 'group') {
                    $saleId = Sale::where('frame_no',$req->frame_no)->sum('id');
                }else{
                    $saleId = Sale::join('stocks','sales.stock_id','stocks.id')
                    ->where('frame_no',$req->frame_no)
                    ->where('stocks.dealer_id',$did)->sum('sales.id');
                }

                $data = new Document;
                $data->sale_id = $saleId;
                $data->stck = $req->stck;
                $data->stnk = $req->stnk;
                $data->bpkb = $req->bpkb;
                $data->nopol = $req->nopol;
                $data->document_note = $req->document_note;
                $data->created_by = Auth::user()->id;
                $data->updated_by = Auth::user()->id;
                $data->save();
            }
            /** ============== END Create Documents ============== */ 
            
            /** ============== Create Or Update Stock History ============== */ 

            // Get QTY after update
            if ($dc == 'group') {
                $sale_qty = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('sale_date',$req->sale_date)
                ->where('stocks.dealer_id',$dealerId)->sum('sale_qty');
                $lastStock = Stock::where('dealer_id',$dealerId)->sum('qty');
            }else{
                $sale_qty = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('sale_date',$req->sale_date)
                ->where('stocks.dealer_id',$did)->sum('sale_qty');
                $lastStock = Stock::where('dealer_id',$did)->sum('qty');
            }
            

            if ($isEntry > 0 && $isOut > 0 && $isSale > 0) {
                // If that variables has records -> Update History
                if ($dc == 'group') {
                    $his = StockHistory::where('history_date',$req->sale_date)
                    ->where('dealer_code',$req->dealer_code)->first();
                }else{
                    $his = StockHistory::where('history_date',$req->sale_date)
                    ->where('dealer_code',$dc)->first();
                }
                
                $his->in_qty = $in;
                $his->out_qty = $out;
                $his->sale_qty = $sale_qty;
                $his->last_stock = $lastStock;
                $his->updated_by = Auth::user()->id;
                $his->update();
            } elseif($isEntry > 0 || $isOut > 0 || $isSale > 0) {
                // If one of them have records -> Update History
                if ($dc == 'group') {
                    $his = StockHistory::where('history_date',$req->sale_date)
                    ->where('dealer_code',$req->dealer_code)->first();
                }else{
                    $his = StockHistory::where('history_date',$req->sale_date)
                    ->where('dealer_code',$dc)->first();
                }
                
                $his->in_qty = $in;
                $his->out_qty = $out;
                $his->sale_qty = $sale_qty;
                $his->last_stock = $lastStock;
                $his->updated_by = Auth::user()->id;
                $his->update();
            } else {
                // If no record by input date in DB -> Create History
                if ($dc == 'group') {
                    $cek = StockHistory::where('history_date',$req->sale_date)
                    ->where('dealer_code',$dealer_code)->count();
                }else{
                    $cek = StockHistory::where('history_date',$req->sale_date)
                    ->where('dealer_code',$dc)->count();
                }
                
                if ($cek > 0) {
                    // if Stock history's table contain data with the same date -> Update History
                    if ($dc == 'group') {
                        $his = StockHistory::where('history_date',$req->sale_date)
                        ->where('dealer_code',$dealer_code)->first();
                    }else{
                        $his = StockHistory::where('history_date',$req->sale_date)
                        ->where('dealer_code',$dc)->first();
                    }
                    $his->in_qty = $in;
                    $his->out_qty = $out;
                    $his->sale_qty = $sale_qty;
                    $his->last_stock = $lastStock;
                    $his->updated_by = Auth::user()->id;
                    $his->update();
                } else {
                    // if no record by date in stock history's table -> Create History
                    $his = new StockHistory;
                    $his->history_date = $req->sale_date;
                    $his->id_key = Carbon::now('GMT+8')->format('H').'sh'.$dealer_code.Carbon::now('GMT+8')->format('Y').Carbon::now('GMT+8')->format('i').Carbon::now('GMT+8')->format('m').'b'.Carbon::now('GMT+8')->format('d').Carbon::now('GMT+8')->format('s');
                    $his->dealer_code = $dealer_code;
                    $his->first_stock = $firstStock;
                    $his->in_qty = $in;
                    $his->out_qty = $out;
                    $his->sale_qty = $sale_qty;
                    $his->last_stock = $lastStock;
                    $his->created_by = Auth::user()->id;
                    $his->updated_by = Auth::user()->id;
                    $his->save();
                }
            }
            /** ============== END Create Or Update Stock History ============== */ 

            // Update SPK
            $spk = Spk::find($req->spk_id);
            $spk->sale_status = 'sold';
            $spk->update();
            // END Update SPK

            // Write log
            $log = new Log;
            $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
            $log->activity = 'creates sale units data';
            $log->user_id = Auth::user()->id;
            $log->save();
        
            toast('Data sale berhasil disimpan','success');
            return redirect()->back()->withInput($req->except('stock_id', 'model_name','color','year_mc','on_hand','leasing_id','leasing_code','frame_no','engine_no','nik','customer_name','phone','address'));
        }
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

        // Get Stock ID from Sale Table
        $stockId = Sale::where('id',$id)->pluck('stock_id');

        // Get Latest Stock from Stock Table
        $latestStock = Stock::where('id',$stockId)->sum('qty');

        // Get Deleted QTY
        $delQty = Sale::where('id',$id)->sum('sale_qty');

        // Get SPK no
        $spk_no = Sale::where('id',$id)->pluck('spk');
        $spk_no = $spk_no[0];

        // Update Stock
        $updateStock = $latestStock + $delQty;

        /** ============== Create Or Update Stock History ============== */
        $sale_date = Sale::where('id',$id)->pluck('sale_date');
        $dealer_code = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->where('sales.id',$id)
        ->pluck('dealers.dealer_code');
        $dealerId = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->where('sales.id',$id)
        ->pluck('dealers.id');
        // dd($dealerId);

        if($dc == 'group'){
            // Count first stock
            $stock = Stock::where('dealer_id',$dealerId)->sum('qty');
            $in = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$sale_date)
            ->where('stocks.dealer_id',$dealerId)->sum('in_qty');
            $in = ($in == 0) ? $in = 0 : (int)$in ;
            $out = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$sale_date)
            ->where('stocks.dealer_id',$dealerId)->sum('out_qty');
            $out = ($out == 0) ? $out = 0 : (int)$out ;
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$sale_date)
            ->where('stocks.dealer_id',$dealerId)->sum('sale_qty');
            $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
        }else{
            // Count first stock
            $stock = Stock::where('dealer_id',$did)->sum('qty');
            $in = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$sale_date)
            ->where('stocks.dealer_id',$did)->sum('in_qty');
            $in = ($in == 0) ? $in = 0 : (int)$in ;
            $out = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$sale_date)
            ->where('stocks.dealer_id',$did)->sum('out_qty');
            $out = ($out == 0) ? $out = 0 : (int)$out ;
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$sale_date)
            ->where('stocks.dealer_id',$did)->sum('sale_qty');
            $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
        }
        /** ============== END Create Or Update Stock History ============== */ 

        // dd($updateStock);
        Sale::find($id)->delete();

        // Update Stock Table
        $stock = Stock::where('id',$stockId)->first();
        $stock->qty = $updateStock;
        $stock->updated_by = Auth::user()->id;
        $stock->save();

        /** ============== END Create Or Update Stock History ============== */
        // Get QTY after update
        if ($dc == 'group') {
            $sale_qty = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$sale_date)
            ->where('stocks.dealer_id',$dealerId)->sum('sale_qty');
            $sale_qty = ($sale_qty == 0) ? $sale_qty = 0 : (int)$sale_qty ;
            $lastStock = Stock::where('dealer_id',$dealerId)->sum('qty');
        }else{
            $sale_qty = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$sale_date)
            ->where('stocks.dealer_id',$did)->sum('sale_qty');
            $sale_qty = ($sale_qty == 0) ? $sale_qty = 0 : (int)$sale_qty ;
            $lastStock = Stock::where('dealer_id',$did)->sum('qty');
        }
        

        // Update Stock History
        if ($dc == 'group') {
            $his = StockHistory::where('history_date',$sale_date)
            ->where('dealer_code',$dealer_code)->first();
        }else{
            $his = StockHistory::where('history_date',$sale_date)
            ->where('dealer_code',$dc)->first();
        }

        $his->in_qty = $in;
        $his->out_qty = $out;
        $his->sale_qty = $sale_qty;
        $his->last_stock = $lastStock;
        $his->updated_by = Auth::user()->id;
        $his->save();
        /** ============== END Create Or Update Stock History ============== */

        if (Auth::user()->crud == 'normal') {
            // Delete Document by Sale ID
            // Get document ID by Sale ID
            $docId = Document::where('sale_id',$id)->pluck('id');
            Document::where('id',$docId)->delete();
        }

        // Update SPK
        Spk::where('spk_no',$spk_no)->update([
            'sale_status' => 'pending',
        ]);
        // END Update SPK

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'deletes sale units data';
        $log->user_id = Auth::user()->id;
        $log->save();
        
        toast('Data sale berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Sale::whereIn('id',$req->pilih)->delete();
        toast('Data sale berhasil dihapus','success');
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
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('spks','sales.spk','spks.spk_no')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->orderBy('sale_date','desc')
                ->select('*','sales.id as id_sale','manpowers.name as salesman','sales.phone as salesphone')
                ->limit(20)->get();
                // dd($data);
            }else{
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('spks','sales.spk','spks.spk_no')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('sale_date','desc')
                ->select('*','sales.id as id_sale','manpowers.name as salesman','sales.phone as salesphone')
                ->limit(20)->get();
                // dd($data);
            }
            
        } else {
            if ($dc == 'group') {
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('spks','sales.spk','spks.spk_no')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->whereBetween('sale_date',[$req->start, $req->end])
                ->select('*','sales.id as id_sale','manpowers.name as salesman','sales.phone as salesphone')->get();
            }else{
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('spks','sales.spk','spks.spk_no')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('sale_date',[$req->start, $req->end])
                ->select('*','sales.id as id_sale','manpowers.name as salesman','sales.phone as salesphone')->get();
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
            $last_01 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sentral)
            ->where('sale_date','like', $lastMonth.'%')
            ->sum('sale_qty');
            $data_01 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sentral)
            ->whereMonth('sale_date', $month)
            ->sum('sale_qty');
            
            // Cokro
            $last_02 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->where('sale_date','like', $lastMonth.'%')
            ->sum('sale_qty');
            $data_02 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->whereMonth('sale_date', $month)
            ->sum('sale_qty');

            // UD
            $last_04 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $ud)
            ->where('sale_date','like', $lastMonth.'%')
            ->sum('sale_qty');
            $data_04 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $ud)
            ->whereMonth('sale_date', $month)
            ->sum('sale_qty');

            // TTS
            $last_05 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $tts)
            ->where('sale_date','like', $lastMonth.'%')
            ->sum('sale_qty');
            $data_05 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $tts)
            ->whereMonth('sale_date', $month)
            ->sum('sale_qty');

            // Imbo
            $last_06 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->where('sale_date','like', $lastMonth.'%')
            ->sum('sale_qty');
            $data_06 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $imbo)
            ->whereMonth('sale_date', $month)
            ->sum('sale_qty');

            // Mandiri
            $last_07 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $mandiri)
            ->where('sale_date','like', $lastMonth.'%')
            ->sum('sale_qty');
            $data_07 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $mandiri)
            ->whereMonth('sale_date', $month)
            ->sum('sale_qty');

            // WR
            $last_08 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $wr)
            ->where('sale_date','like', $lastMonth.'%')
            ->sum('sale_qty');
            $data_08 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $wr)
            ->whereMonth('sale_date', $month)
            ->sum('sale_qty');

            // SR
            $last_09 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sr)
            ->where('sale_date','like', $lastMonth.'%')
            ->sum('sale_qty');
            $data_09 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sr)
            ->whereMonth('sale_date', $month)
            ->sum('sale_qty');

            // Dalung
            $last_0401 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $dalung)
            ->where('sale_date','like', $lastMonth.'%')
            ->sum('sale_qty');
            $data_0401 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $dalung)
            ->whereMonth('sale_date', $month)
            ->sum('sale_qty');

            // FSS
            $last_04F = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $fss)
            ->where('sale_date','like', $lastMonth.'%')
            ->sum('sale_qty');
            $data_04F = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $fss)
            ->whereMonth('sale_date', $month)
            ->sum('sale_qty');
            
            // Bisma Group
            $last = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id','!=', $fss)
            ->where('sale_date','like', $lastMonth.'%')
            ->sum('sale_qty');
            $data = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id','!=', $fss)
            ->whereMonth('sale_date', $month)
            ->sum('sale_qty');

            // Bisma Group + FSS
            $lastPlus = Sale::where('sale_date','like', $lastMonth.'%')->sum('sale_qty');
            $dataPlus = Sale::whereMonth('sale_date', $month)->sum('sale_qty');
            
        } else {
            // Sentral
            $last_01 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sentral)
            ->where('sale_date','like', $lastYear.'%')
            ->sum('sale_qty');
            $data_01 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sentral)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');
            
            // Cokro
            $last_02 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->where('sale_date','like', $lastYear.'%')
            ->sum('sale_qty');
            $data_02 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');

            // UD
            $last_04 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $ud)
            ->where('sale_date','like', $lastYear.'%')
            ->sum('sale_qty');
            $data_04 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $ud)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');

            // TTS
            $last_05 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $tts)
            ->where('sale_date','like', $lastYear.'%')
            ->sum('sale_qty');
            $data_05 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $tts)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');

            // Imbo
            $last_06 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $cokro)
            ->where('sale_date','like', $lastYear.'%')
            ->sum('sale_qty');
            $data_06 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $imbo)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');

            // Mandiri
            $last_07 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $mandiri)
            ->where('sale_date','like', $lastYear.'%')
            ->sum('sale_qty');
            $data_07 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $mandiri)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');

            // WR
            $last_08 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $wr)
            ->where('sale_date','like', $lastYear.'%')
            ->sum('sale_qty');
            $data_08 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $wr)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');

            // SR
            $last_09 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sr)
            ->where('sale_date','like', $lastYear.'%')
            ->sum('sale_qty');
            $data_09 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $sr)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');

            // Dalung
            $last_0401 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $dalung)
            ->where('sale_date','like', $lastYear.'%')
            ->sum('sale_qty');
            $data_0401 = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $dalung)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');

            // FSS
            $last_04F = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $fss)
            ->where('sale_date','like', $lastYear.'%')
            ->sum('sale_qty');
            $data_04F = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $fss)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');
            
            // Bisma Group
            $last = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id','!=', $fss)
            ->where('sale_date','like', $lastYear.'%')
            ->sum('sale_qty');
            $data = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id','!=', $fss)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');

            // Bisma Group + FSS
            $lastPlus = Sale::whereYear('sale_date', $lastYear)->sum('sale_qty');
            $dataPlus = Sale::whereYear('sale_date', $year)->sum('sale_qty');
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

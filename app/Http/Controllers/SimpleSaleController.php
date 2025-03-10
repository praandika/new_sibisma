<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dealer;
use App\Models\Entry;
use App\Models\Leasing;
use App\Models\Sale;
use App\Models\Out;
use App\Models\Stock;
use App\Models\Log;
use App\Models\StockHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SimpleSaleController extends Controller
{
    public function index()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $dealer = Dealer::all();
        $leasing = Leasing::all();
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        if ($dc == 'group') {
            $stock = Stock::join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->select('units.model_name','colors.color_name','colors.color_code','units.year_mc','stocks.qty','dealers.dealer_code','dealers.dealer_name','stocks.id as id')
            ->orderBy('stocks.qty','desc')
            ->get();
            $data = Sale::where('sale_date',$today)->orderBy('id','desc')->get();
            return view('page', compact('stock','leasing','today','data','dealer'));
        }else{
            $stock = Stock::join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->select('units.model_name','colors.color_name','colors.color_code','units.year_mc','stocks.qty','dealers.dealer_code','dealers.dealer_name','stocks.id as id')
            ->where('stocks.dealer_id',$did)
            ->orderBy('stocks.qty','desc')
            ->get();
            $dealerCode = $dc;
            $data = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$today)->where('stocks.dealer_id',$did)->orderBy('sales.id','desc')
            ->select('*','sales.id as id_sale')->get();
            return view('page', compact('stock','leasing','today','data','dealer','dealerCode'));
        }
        
    }

    public function store(Request $req){
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
        $soldQty = $req->sale_qty;

        // Update Stock
        $updateStock = $latestStock - $soldQty;

        if ($updateStock < 0) {
            alert()->warning('Warning','Sales quantity exceeds stock!');
            return redirect()->back()->with('auto', true)->withInput($req->input());
        } else {
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
                $firstStock = $stock - ($in + $out + $sale);
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
                $firstStock = $stock - ($in + $out + $sale);
            }
        
            /** ============== END Create Or Update Stock History ============== */ 
            $data = new Sale;
            $data->sale_date = $req->sale_date;
            $data->stock_id = $req->stock_id;
            $data->sale_qty = $req->sale_qty;
            $data->leasing_id = $req->leasing_id;
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;
            $data->save();

            // Update Stock Table
            $stock = Stock::where('id',$stockId)->first();
            $stock->qty = $updateStock;
            $stock->updated_by = Auth::user()->id;
            $stock->save();
            
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
                $his->save();
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
                $his->save();
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
                    $his->save();
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

            // Write log
            $log = new Log;
            $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
            $log->activity = 'creates sale units data';
            $log->user_id = Auth::user()->id;
            $log->save();
        
            toast('Data sale berhasil disimpan','success');
            return redirect()->back()->withInput($req->except('stock_id', 'model_name','color','year_mc','on_hand','sale_qty'));
        }
    }
}

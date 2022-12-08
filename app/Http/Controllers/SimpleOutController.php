<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Models\Out;
use App\Models\Sale;
use App\Models\Entry;
use App\Models\Stock;
use App\Models\StockHistory;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SimpleOutController extends Controller
{
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

        // Get Out QTY
        $outQty = $req->out_qty;

        // Update Stock
        $updateStock = $latestStock - $outQty;

        if ($updateStock < 0) {
            alert()->warning('Warning','Out quantity exceeds stock!');
            return redirect()->back()->with('auto', true)->withInput($req->input());
        } else {
            /** ============== Create Or Update Stock History ============== */ 
            if($dc == 'group'){
                $isSale = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('sale_date',$req->out_date)
                ->where('stocks.dealer_id',$dealerId)->count();
                $isOut = Out::join('stocks','outs.stock_id','stocks.id')
                ->where('out_date',$req->out_date)
                ->where('stocks.dealer_id',$dealerId)->count();
                $isEntry = Entry::join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$req->out_date)
                ->where('stocks.dealer_id',$dealerId)->count();

                // Count first stock
                $stock = Stock::where('dealer_id',$dealerId)->sum('qty');
                $in = Entry::join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$req->out_date)
                ->where('stocks.dealer_id',$dealerId)->sum('in_qty');
                $in = ($in == 0) ? $in = 0 : (int)$in ;
                $out = Out::join('stocks','outs.stock_id','stocks.id')
                ->where('out_date',$req->out_date)
                ->where('stocks.dealer_id',$dealerId)->sum('out_qty');
                $out = ($out == 0) ? $out = 0 : (int)$out ;
                $sale = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('sale_date',$req->out_date)
                ->where('stocks.dealer_id',$dealerId)->sum('sale_qty');
                $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
                $firstStock = $stock - ($in + $out + $sale);
            }else{
                $isSale = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('sale_date',$req->out_date)
                ->where('stocks.dealer_id',$did)->count();
                $isOut = Out::join('stocks','outs.stock_id','stocks.id')
                ->where('out_date',$req->out_date)
                ->where('stocks.dealer_id',$did)->count();
                $isEntry = Entry::join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$req->out_date)
                ->where('stocks.dealer_id',$did)->count();

                // Count first stock
                $stock = Stock::where('dealer_id',$did)->sum('qty');
                $in = Entry::join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$req->out_date)
                ->where('stocks.dealer_id',$did)->sum('in_qty');
                $in = ($in == 0) ? $in = 0 : (int)$in ;
                $out = Out::join('stocks','outs.stock_id','stocks.id')
                ->where('out_date',$req->out_date)
                ->where('stocks.dealer_id',$did)->sum('out_qty');
                $out = ($out == 0) ? $out = 0 : (int)$out ;
                $sale = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('sale_date',$req->out_date)
                ->where('stocks.dealer_id',$did)->sum('sale_qty');
                $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
                $firstStock = $stock - ($in + $out + $sale);
            }

            /** ============== END Create Or Update Stock History ============== */
                $data = new Out;
                $data->out_date = $req->out_date;
                $data->stock_id = $req->stock_id;
                $data->dealer_id = $req->dealer_id;
                $data->out_qty = $req->out_qty;
                $data->created_by = Auth::user()->id;
                $data->updated_by = Auth::user()->id;
                $data->save();

                // Update Stock Table
                $stock = Stock::where('id',$stockId)->first();
                $stock->qty = $updateStock;
                $stock->updated_by = Auth::user()->id;
                $stock->save();

                /** ============== END Create Or Update Stock History ============== */ 

                /** ============== Create Or Update Stock History ============== */ 

                // Get QTY after update
                if ($dc == 'group') {
                    $out_qty = Out::join('stocks','outs.stock_id','stocks.id')
                    ->where('out_date',$req->out_date)
                    ->where('stocks.dealer_id',$dealerId)->sum('out_qty');
                    $lastStock = Stock::where('dealer_id',$dealerId)->sum('qty');
                }else{
                    $out_qty = Out::join('stocks','outs.stock_id','stocks.id')
                    ->where('out_date',$req->out_date)
                    ->where('stocks.dealer_id',$did)->sum('out_qty');
                    $lastStock = Stock::where('dealer_id',$did)->sum('qty'); 
                }
                

                if ($isEntry > 0 && $isOut > 0 && $isSale > 0) {
                    // If that variables has records -> Update History
                    if ($dc == 'group') {
                        $his = StockHistory::where('history_date',$req->out_date)
                        ->where('dealer_code',$dealer_code)->first();
                    }else{
                        $his = StockHistory::where('history_date',$req->out_date)
                        ->where('dealer_code',$dc)->first();
                    }
                    
                    $his->in_qty = $in;
                    $his->out_qty = $out_qty;
                    $his->sale_qty = $sale;
                    $his->last_stock = $lastStock;
                    $his->updated_by = Auth::user()->id;
                    $his->save();
                } elseif($isEntry > 0 || $isOut > 0 || $isSale > 0) {
                    // If one of them have records -> Update History
                    if ($dc == 'group') {
                        $his = StockHistory::where('history_date',$req->out_date)
                        ->where('dealer_code',$dealer_code)->first();
                    }else{
                        $his = StockHistory::where('history_date',$req->out_date)
                        ->where('dealer_code',$dc)->first();
                    }
                    $his->in_qty = $in;
                    $his->out_qty = $out_qty;
                    $his->sale_qty = $sale;
                    $his->last_stock = $lastStock;
                    $his->updated_by = Auth::user()->id;
                    $his->save();
                } else {
                    // If no record by input date in DB -> Create History
                    if ($dc == 'group') {
                        $cek = StockHistory::where('history_date',$req->out_date)
                        ->where('dealer_code',$dealer_code)->count();
                    }else{
                        $cek = StockHistory::where('history_date',$req->out_date)
                        ->where('dealer_code',$dc)->count();
                    }

                    if ($cek > 0) {
                        // if Stock history's table contain data with the same date -> Update History
                        if ($dc == 'group') {
                            $his = StockHistory::where('history_date',$req->out_date)
                        ->where('dealer_code',$dealer_code)->first();
                        }else{
                            $his = StockHistory::where('history_date',$req->out_date)
                            ->where('dealer_code',$dc)->first();
                        }
                        $his->in_qty = $in;
                        $his->out_qty = $out_qty;
                        $his->sale_qty = $sale;
                        $his->last_stock = $lastStock;
                        $his->updated_by = Auth::user()->id;
                        $his->save();
                    } else {
                        // if no record by date in stock history's table -> Create History
                        $his = new StockHistory;
                        $his->history_date = $req->out_date;
                        $his->id_key = Carbon::now('GMT+8')->format('H').'sh'.$dealer_code.Carbon::now('GMT+8')->format('Y').Carbon::now('GMT+8')->format('i').Carbon::now('GMT+8')->format('m').'b'.Carbon::now('GMT+8')->format('d').Carbon::now('GMT+8')->format('s');
                        $his->dealer_code = $dealer_code;
                        $his->first_stock = $firstStock;
                        $his->in_qty = $in;
                        $his->out_qty = $out_qty;
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
            $log->activity = 'creates out units data';
            $log->user_id = Auth::user()->id;
            $log->save();

            toast('Data out berhasil disimpan','success');
            return redirect()->back()->withInput($req->except('stock_id', 'model_name','color','year_mc','on_hand','dealer_id','dealer_name','out_qty'));
        }
    }
}

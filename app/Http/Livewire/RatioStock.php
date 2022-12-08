<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Entry;
use App\Models\Out;
use App\Models\Dealer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RatioStock extends Component
{
    public function render()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');
        $tgl = Carbon::now('GMT+8');

        if ($dc == 'group') {
            $monthSales = Sale::whereMonth('sale_date',$month)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');

            $monthOut = Out::whereMonth('out_date',$month)
            ->whereYear('out_date', $year)
            ->sum('out_qty');

            // Total Sales
            $totalSales = Sale::where('sale_date',$today)->sum('sale_qty');
            // Total Sales
            $totalEntry = Entry::where('entry_date',$today)->sum('in_qty');
            // Total Sales
            $totalOut = Out::where('out_date',$today)->sum('out_qty');

            // Ratio Percentage
            $stockQty = Stock::sum('qty');
        } else {

            $monthSales = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',$month)
            ->whereYear('sale_date', $year)
            ->sum('sale_qty');

            $monthOut = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('out_date',$month)
            ->whereYear('out_date', $year)
            ->sum('out_qty');

            // Total Sales
            $totalSales = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->where('sale_date',$today)->sum('sale_qty');
            // Total Sales
            $totalEntry = Entry::join('stocks','entries.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->where('entry_date',$today)->sum('in_qty');
            // Total Sales
            $totalOut = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->where('out_date',$today)->sum('out_qty');

            // Ratio Percentage
            $stockQty = Stock::where('dealer_id', $did)
            ->sum('qty');
        }

        $monthSaleOut = $monthSales + $monthOut;

        if ($stockQty <= 0) {
            $ratioPercent = 0*100;
        } else {
            $ratioPercent = ($monthSaleOut/($stockQty + $monthSaleOut))*100;
        }
        
        $ratioPercent = number_format($ratioPercent,0);

        if ($monthSaleOut <= 0 && $stockQty <= 0) {
            $ratio = 0;
        }elseif($monthSaleOut <= 0 || $stockQty <= 0){
            if ($monthSaleOut <= 0) {
                $ratio = $stockQty/$stockQty;
            } else {
                $ratio = $stockQty/$monthSaleOut;
            }
        } else {
            $ratio = $stockQty/$monthSaleOut;
        }
        
        $ratio = number_format($ratio, 2);
        
        return view('livewire.ratio-stock', compact('ratio','ratioPercent','totalSales','totalEntry','totalOut','today'));
    }
}

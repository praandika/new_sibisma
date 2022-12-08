<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;
use App\Models\Dealer;
use Illuminate\Support\Facades\Auth;

class SaleLM extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');
        $lastMonthDisplay = Carbon::now('GMT+8')->subMonth()->format('Y-m-d');
        $lastMonth = Carbon::now('GMT+8')->subMonth()->format('m');
        $lastMonthY = Carbon::now('GMT+8')->subMonth()->format('Y');
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        if ($dc == 'group') {
            $monthSales = Sale::whereMonth('sale_date',$month)->whereYear('sale_date',$year)->sum('sale_qty');
            // vs LM
            $LM = Sale::whereMonth('sale_date',$lastMonth)->whereYear('sale_date',$lastMonthY)->sum('sale_qty');
            // dd($lastMonth, $lastMonthY, $LM);
        } else {
            $monthSales = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id',$did)
            ->whereMonth('sale_date',$month)->whereYear('sale_date',$year)->sum('sale_qty');
            // vs LM
            $LM = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id',$did)
            ->whereMonth('sale_date',$lastMonth)->whereYear('sale_date',$lastMonthY)->sum('sale_qty');
            // dd($lastMonth, $lastMonthY, $LM);
        }
        
        if($LM <= 0 && $monthSales <= 0){
            $vsLMach = 0;
            $vsLM = 0;
        }elseif ($LM <= 0 || $monthSales <= 0) {
            if ($LM <= 0) {
                $vsLMach = ($monthSales/$monthSales);
                $vsLM = ($LM)*100;
            } else {
                // $vsLMach = ($LM/$LM);
                $vsLMach = 0;
                $vsLM = (0-$LM)*100;
            }
        } else {
            $vsLMach = ($monthSales/$LM)*100;
            $vsLM = ($monthSales/$LM-1)*100;
        }

        return view('livewire.sale-l-m', compact('today','lastMonth','vsLM','vsLMach','lastMonthDisplay'));
    }
}

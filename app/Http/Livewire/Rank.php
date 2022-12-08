<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;

class Rank extends Component
{
    public function render()
    {
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');

        $rank1 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->selectRaw('sum(sale_qty) as qty, dealer_name')
        ->whereMonth('sale_date', $month)
        ->whereYear('sale_date', $year)
        ->orderBy('qty','desc')
        ->groupBy('stocks.dealer_id')
        ->limit(3)
        ->take(1)
        ->get();

        $rank2 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->selectRaw('sum(sale_qty) as qty, dealer_name')
        ->whereMonth('sale_date', $month)
        ->whereYear('sale_date', $year)
        ->orderBy('qty','desc')
        ->groupBy('stocks.dealer_id')
        ->limit(3)
        ->skip(1)
        ->take(1)
        ->get();

        $rank3 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->selectRaw('sum(sale_qty) as qty, dealer_name')
        ->whereMonth('sale_date', $month)
        ->whereYear('sale_date', $year)
        ->orderBy('qty','desc')
        ->groupBy('stocks.dealer_id')
        ->limit(3)
        ->skip(2)
        ->take(1)
        ->get();

        return view('livewire.rank', compact('rank1','rank2','rank3'));
    }
}

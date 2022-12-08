<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;

class ModalRanking extends Component
{
    public function render()
    {
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');

        $rankData = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->selectRaw('sum(sale_qty) as qty, dealer_name')
        ->whereMonth('sale_date', $month)
        ->whereYear('sale_date', $year)
        ->orderBy('qty','desc')
        ->groupBy('stocks.dealer_id')
        ->get();
        return view('livewire.modal-ranking', compact('rankData'));
    }
}

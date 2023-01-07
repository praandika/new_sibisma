<?php

namespace App\Http\Livewire;

use App\Models\StockHistory;
use Livewire\Component;

class InStockInfo extends Component
{
    public function render()
    {
        $data = StockHistory::join('dealers','stock_histories.dealer_code','=','dealers.dealer_code')
        ->orderBy('stock_histories.history_date','desc')
        ->limit(8)
        ->get();
        return view('livewire.in-stock-info', compact('data'));
    }
}

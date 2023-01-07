<?php

namespace App\Http\Livewire;

use App\Models\StockHistory;
use Livewire\Component;

class OutStockInfo extends Component
{
    public function render()
    {
        $data = StockHistory::join('dealers','stock_histories.dealer_code','=','dealers.dealer_code')
        ->orderBy('stock_histories.history_date','desc')
        ->limit(8)
        ->get();
        return view('livewire.out-stock-info', compact('data'));
    }
}

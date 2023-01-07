<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;

class SaleStockInfo extends Component
{
    public function render()
    {
        $data = Sale::join('stocks','sales.stock_id','=','stocks.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->orderBy('sales.sale_date','desc')
        ->limit(8)
        ->get();
        return view('livewire.sale-stock-info', compact('data'));
    }
}

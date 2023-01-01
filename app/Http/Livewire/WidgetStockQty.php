<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stock;
use App\Models\Dealer;
use Illuminate\Support\Facades\Auth;

class WidgetStockQty extends Component
{
    public function render()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        if ($dc == 'group') {
            $stock = Stock::sum('qty');
            $data = Stock::join('dealers','stocks.dealer_id','=','dealers.id')
            ->selectRaw('SUM(stocks.qty) as stock, dealers.dealer_code, dealers.dealer_name')
            ->groupBy('stocks.dealer_id')->orderBy('stock','desc')->get();
        } else {
            $stock = Stock::where('dealer_id',$did)->sum('qty');
        }
        
        return view('livewire.widget-stock-qty', compact('stock','data'));
    }
}

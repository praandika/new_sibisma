<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dealer;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

class TopStockChart extends Component
{
    public function render()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $cek = Dealer::where('dealer_code',$dc)->count();
        if ($cek > 0) {
            $dealerId = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
            if ($dc == 'group') {
                $dealerName = 'Bisma Group';
            } else {
                $dealerName = $dealerId[0];
            }
        } else {
            if ($dc == 'group') {
                $dealerName = 'Bisma Group';
            } else {
                $dealerName = null;
            }
        }

        if ($dc == 'group') {
            $data = Stock::join('units','stocks.unit_id','units.id')
            ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
            ->where('stocks.qty','>',0)
            ->groupBy('units.model_name')
            ->orderBy('sum_qty','desc')
            ->limit(5)
            ->get();
        }else{
            $data = Stock::join('units','stocks.unit_id','units.id')
            ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
            ->where('stocks.dealer_id',$did)
            ->where('stocks.qty','>',0)
            ->groupBy('units.model_name')
            ->orderBy('sum_qty','desc')
            ->limit(5)
            ->get();
            
        }

        return view('livewire.top-stock-chart', compact('data','dealerName'));
    }
}

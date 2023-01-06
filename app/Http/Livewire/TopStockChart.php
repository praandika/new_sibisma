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

        $aa0101 = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0101")
        ->where('stocks.qty','>',0)
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0102 = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0102")
        ->where('stocks.qty','>',0)
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0104 = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0104")
        ->where('stocks.qty','>',0)
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0105 = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0105")
        ->where('stocks.qty','>',0)
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0106 = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0106")
        ->where('stocks.qty','>',0)
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0107 = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0107")
        ->where('stocks.qty','>',0)
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0108 = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0108")
        ->where('stocks.qty','>',0)
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0109 = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0109")
        ->where('stocks.qty','>',0)
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa010401 = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0104-01")
        ->where('stocks.qty','>',0)
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0104F = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0104F")
        ->where('stocks.qty','>',0)
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $bismaGroup = Stock::join('units','stocks.unit_id','units.id')
        ->selectRaw('sum(qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('stocks.qty','>',0)
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        return view('livewire.top-stock-chart', compact('data','dealerName','aa0101','aa0102','aa0104','aa0105','aa0106','aa0107','aa0108','aa0109','aa010401','aa0104F','bismaGroup'));
    }
}

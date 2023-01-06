<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dealer;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TopProductChart extends Component
{
    public function render()
    {
        $dc = Auth::user()->dealer_code;
        $cek = Dealer::where('dealer_code',$dc)->count();
        if ($cek > 0) {
            $did = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
            if ($dc == 'group') {
                $dealerName = 'Bisma Group';
            } else {
                $dealerName = $did[0];
            }
        } else {
            if ($dc == 'group') {
                $dealerName = 'Bisma Group';
            } else {
                $dealerName = null;
            }
        }

        $year = Carbon::now('GMT+8')->format('Y');

        $aa0101 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(sales.sale_qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0101")
        ->groupBy('units.model_name')
        ->whereYear('sales.sale_date',$year)
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0102 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(sales.sale_qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0102")
        ->groupBy('units.model_name')
        ->whereYear('sales.sale_date',$year)
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0104 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(sales.sale_qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0104")
        ->groupBy('units.model_name')
        ->whereYear('sales.sale_date',$year)
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0105 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(sales.sale_qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0105")
        ->groupBy('units.model_name')
        ->whereYear('sales.sale_date',$year)
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0106 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(sales.sale_qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0106")
        ->groupBy('units.model_name')
        ->whereYear('sales.sale_date',$year)
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0107 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(sales.sale_qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0107")
        ->groupBy('units.model_name')
        ->whereYear('sales.sale_date',$year)
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0108 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(sales.sale_qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0108")
        ->groupBy('units.model_name')
        ->whereYear('sales.sale_date',$year)
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0109 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(sales.sale_qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0109")
        ->groupBy('units.model_name')
        ->whereYear('sales.sale_date',$year)
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa010401 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(sales.sale_qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA010401")
        ->groupBy('units.model_name')
        ->whereYear('sales.sale_date',$year)
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $aa0104F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(sales.sale_qty) as sum_qty, units.model_name, units.category, units.image')
        ->where('dealers.dealer_code',"AA0104F")
        ->groupBy('units.model_name')
        ->whereYear('sales.sale_date',$year)
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        $bismaGroup = Sale::join('stocks','sales.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','=','dealers.id')
        ->selectRaw('sum(sales.sale_qty) as sum_qty, units.model_name, units.category, units.image')
        ->groupBy('units.model_name')
        ->orderBy('sum_qty','desc')
        ->limit(5)
        ->get();

        return view('livewire.top-product-chart', compact('dealerName','aa0101','aa0102','aa0104','aa0105','aa0106','aa0107','aa0108','aa0109','aa010401','aa0104F','bismaGroup'));
    }
}

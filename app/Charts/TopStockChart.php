<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Dealer;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

class TopStockChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        if ($dc == 'group') {
            $topStock = Stock::join('units','stocks.unit_id','units.id')
            ->selectRaw('sum(qty) as sum_qty, units.model_name')
            ->where('stocks.qty','>',0)
            ->groupBy('units.model_name')
            ->orderBy('sum_qty','desc')
            ->limit(5)
            ->pluck('units.model_name')
            ->toArray();

            $sumStock = Stock::join('units','stocks.unit_id','units.id')
            ->selectRaw('sum(qty) as sum_qty, units.model_name')
            ->where('stocks.qty','>',0)
            ->groupBy('units.model_name')
            ->orderBy('sum_qty','desc')
            ->limit(5)
            ->pluck('sum_qty')
            ->toArray();
        }else{
            $topStock = Stock::join('units','stocks.unit_id','units.id')
            ->selectRaw('sum(qty) as sum_qty, units.model_name')
            ->where('stocks.dealer_id',$did)
            ->where('stocks.qty','>',0)
            ->groupBy('units.model_name')
            ->orderBy('sum_qty','desc')
            ->limit(5)
            ->pluck('units.model_name')
            ->toArray();

            $sumStock = Stock::join('units','stocks.unit_id','units.id')
            ->selectRaw('sum(qty) as sum_qty, units.model_name')
            ->where('stocks.dealer_id',$did)
            ->where('stocks.qty','>',0)
            ->groupBy('units.model_name')
            ->orderBy('sum_qty','desc')
            ->limit(5)
            ->pluck('sum_qty')
            ->toArray();
        }

        return Chartisan::build()
            ->labels($topStock)
            ->dataset('Top Stocks', $sumStock);
    }
}
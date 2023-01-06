<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Dealer;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class TopProductChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $year = Carbon::now('GMT+8')->format('Y');
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        if ($dc == 'group') {
            $top = Sale::join('stocks','sales.stock_id','stocks.id')
            ->join('units','stocks.unit_id','units.id')
            ->selectRaw('sum(sale_qty) as unit_sum, units.model_name')
            ->whereYear('sales.sale_date', $year)
            ->groupBy('units.model_name')
            ->orderBy('unit_sum', 'desc')
            ->limit(5)
            ->pluck('units.model_name')
            ->toArray();

            $sum = Sale::join('stocks','sales.stock_id','stocks.id')
            ->join('units','stocks.unit_id','units.id')
            ->selectRaw('sum(sale_qty) as unit_sum, units.model_name')
            ->whereYear('sales.sale_date', $year)
            ->groupBy('units.model_name')
            ->orderBy('unit_sum', 'desc')
            ->limit(5)
            ->pluck('unit_sum')
            ->toArray();
        } else {
            $top = Sale::join('stocks','sales.stock_id','stocks.id')
            ->join('units','stocks.unit_id','units.id')
            ->selectRaw('sum(sale_qty) as unit_sum, units.model_name')
            ->whereYear('sales.sale_date', $year)
            ->where('stocks.dealer_id',$did)
            ->groupBy('units.model_name')
            ->orderBy('unit_sum', 'desc')
            ->limit(5)
            ->pluck('units.model_name')
            ->toArray();

            $sum = Sale::join('stocks','sales.stock_id','stocks.id')
            ->join('units','stocks.unit_id','units.id')
            ->selectRaw('sum(sale_qty) as unit_sum, units.model_name')
            ->whereYear('sales.sale_date', $year)
            ->where('stocks.dealer_id',$did)
            ->groupBy('units.model_name')
            ->orderBy('unit_sum', 'desc')
            ->limit(5)
            ->pluck('unit_sum')
            ->toArray();
        }

        return Chartisan::build()
            ->labels($top)
            ->dataset('Top Products', $sum);
    }
}
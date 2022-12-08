<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Dealer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SaleChart extends BaseChart
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

        $yearNow = Carbon::now('GMT+8')->format('Y');
        $yearLast = $yearNow-1;

        $LY = Carbon::createFromDate($yearLast, 01, 01, 'GMT+8');
        $TY = Carbon::createFromDate($yearNow, 12, 31, 'GMT+8');

        if ($dc == 'group') {
            // THIS YEAR
            $jan = Sale::whereMonth('sale_date',1)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $feb = Sale::whereMonth('sale_date',2)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $mar = Sale::whereMonth('sale_date',3)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $apr = Sale::whereMonth('sale_date',4)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $may = Sale::whereMonth('sale_date',5)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $jun = Sale::whereMonth('sale_date',6)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $jul = Sale::whereMonth('sale_date',7)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $aug = Sale::whereMonth('sale_date',8)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $sep = Sale::whereMonth('sale_date',9)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $oct = Sale::whereMonth('sale_date',10)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $nov = Sale::whereMonth('sale_date',11)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $dec = Sale::whereMonth('sale_date',12)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');

            // LAST YEAR
            $janLy = Sale::whereMonth('sale_date',1)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $febLy = Sale::whereMonth('sale_date',2)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $marLy = Sale::whereMonth('sale_date',3)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $aprLy = Sale::whereMonth('sale_date',4)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $mayLy = Sale::whereMonth('sale_date',5)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $junLy = Sale::whereMonth('sale_date',6)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $julLy = Sale::whereMonth('sale_date',7)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $augLy = Sale::whereMonth('sale_date',8)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $sepLy = Sale::whereMonth('sale_date',9)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $octLy = Sale::whereMonth('sale_date',10)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $novLy = Sale::whereMonth('sale_date',11)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $decLy = Sale::whereMonth('sale_date',12)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');

            // Total TY + LY
            $janTotal = Sale::whereMonth('sale_date',1)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $febTotal = Sale::whereMonth('sale_date',2)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $marTotal = Sale::whereMonth('sale_date',3)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $aprTotal = Sale::whereMonth('sale_date',4)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $mayTotal = Sale::whereMonth('sale_date',5)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $junTotal = Sale::whereMonth('sale_date',6)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $julTotal = Sale::whereMonth('sale_date',7)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $augTotal = Sale::whereMonth('sale_date',8)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $sepTotal = Sale::whereMonth('sale_date',9)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $octTotal = Sale::whereMonth('sale_date',10)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $novTotal = Sale::whereMonth('sale_date',11)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $decTotal = Sale::whereMonth('sale_date',12)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
        }else{
            // THIS YEAR
            $jan = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',1)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $feb = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',2)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $mar = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',3)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $apr = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',4)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $may = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',5)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $jun = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',6)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $jul = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',7)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $aug = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',8)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $sep = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',9)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $oct = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',10)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $nov = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',11)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');
            $dec = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',12)
            ->whereYear('sale_date',$yearNow)
            ->sum('sale_qty');

            // LAST YEAR
            $janLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',1)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $febLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',2)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $marLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',3)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $aprLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',4)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $mayLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',5)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $junLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',6)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $julLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',7)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $augLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',8)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $sepLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',9)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $octLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',10)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $novLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',11)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');
            $decLy = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',12)
            ->whereYear('sale_date',$yearLast)
            ->sum('sale_qty');

            // Total TY + LY
            $janTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',1)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $febTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',2)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $marTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',3)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $aprTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',4)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $mayTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',5)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $junTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',6)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $julTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',7)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $augTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',8)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $sepTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',9)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $octTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',10)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $novTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',11)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
            $decTotal = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id', $did)
            ->whereMonth('sale_date',12)
            ->whereBetween('sale_date',[$LY,$TY])
            ->sum('sale_qty');
        }

        return Chartisan::build()
            ->labels(['Jan', 'Feb', 'Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'])
            ->dataset(''.$yearNow.'', [$jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec])
            ->dataset(''.$yearLast.'', [$janLy, $febLy, $marLy, $aprLy, $mayLy, $junLy, $julLy, $augLy, $sepLy, $octLy, $novLy, $decLy])
            ->dataset('Total', [$janTotal, $febTotal, $marTotal, $aprTotal, $mayTotal, $junTotal, $julTotal, $augTotal, $sepTotal, $octTotal, $novTotal, $decTotal]);
    }
}
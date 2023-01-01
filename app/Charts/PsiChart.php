<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Dealer;
use App\Models\Out;
use App\Models\Entry;
use App\Models\StockHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PsiChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $id = Auth::user()->id;
        $dc = User::where('id',$id)->pluck('dealer_code');
        $dc = $dc[0];
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $yearNow = Carbon::now('GMT+8')->format('Y');

        if ($dc == 'group') {
            $sale = [];
            $in = [];
            $code = Dealer::where('dealer_code','!=','YIMM')->groupBy('dealer_code')->pluck('dealer_code');
            $stock = [];
            $ratio = [];

            for ($i=1; $i < 13; $i++) {
                $dataSale = Sale::whereMonth('sale_date',$i)
                ->whereYear('sale_date',$yearNow)
                ->sum('sale_qty');

                $dataOut = Out::whereMonth('out_date',$i)
                ->whereYear('out_date',$yearNow)
                ->sum('out_qty');

                $dataSaleOut = $dataSale + $dataOut;

                $dataIn = Entry::whereMonth('entry_date',$i)
                ->whereYear('entry_date',$yearNow)
                ->sum('in_qty');

                array_push($sale, $dataSaleOut);
                array_push($in, $dataIn);
            }

            // January
            $janArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $janStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',1)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($janStock) == 0) {
                    $janStock = 0;
                } else {
                    $janStock = $janStock[0];
                }

                array_push($janArray, $janStock);
            }

            $jan = array_sum($janArray);
            array_push($stock, $jan);

            // February
            $febArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $febStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',2)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($febStock) == 0) {
                    $febStock = 0;
                } else {
                    $febStock = $febStock[0];
                }

                array_push($febArray, $febStock);
            }

            $feb = array_sum($febArray);
            array_push($stock, $feb);

            // March
            $marArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $marStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',3)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($marStock) == 0) {
                    $marStock = 0;
                } else {
                    $marStock = $marStock[0];
                }

                array_push($marArray, $marStock);
            }

            $mar = array_sum($marArray);
            array_push($stock, $mar);

            // April
            $aprArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $aprStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',4)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($aprStock) == 0) {
                    $aprStock = 0;
                } else {
                    $aprStock = $aprStock[0];
                }

                array_push($aprArray, $aprStock);
            }

            $apr = array_sum($aprArray);
            array_push($stock, $apr);

            // May
            $mayArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $mayStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',5)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($mayStock) == 0) {
                    $mayStock = 0;
                } else {
                    $mayStock = $mayStock[0];
                }

                array_push($mayArray, $mayStock);
            }

            $may = array_sum($mayArray);
            array_push($stock, $may);

            // June
            $junArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $junStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',6)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($junStock) == 0) {
                    $junStock = 0;
                } else {
                    $junStock = $junStock[0];
                }

                array_push($junArray, $junStock);
            }

            $jun = array_sum($junArray);
            array_push($stock, $jun);

            // July
            $julArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $julStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',7)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($julStock) == 0) {
                    $julStock = 0;
                } else {
                    $julStock = $julStock[0];
                }

                array_push($julArray, $julStock);
            }

            $jul = array_sum($julArray);
            array_push($stock, $jul);

            // August
            $augArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $augStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',8)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($augStock) == 0) {
                    $augStock = 0;
                } else {
                    $augStock = $augStock[0];
                }

                array_push($augArray, $augStock);
            }

            $aug = array_sum($augArray);
            array_push($stock, $aug);

            // September
            $sepArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $sepStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',9)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($sepStock) == 0) {
                    $sepStock = 0;
                } else {
                    $sepStock = $sepStock[0];
                }

                array_push($sepArray, $sepStock);
            }

            $sep = array_sum($sepArray);
            array_push($stock, $sep);

            // October
            $octArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $octStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',10)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($octStock) == 0) {
                    $octStock = 0;
                } else {
                    $octStock = $octStock[0];
                }

                array_push($octArray, $octStock);
            }

            $oct = array_sum($octArray);
            array_push($stock, $oct);

            // November
            $novArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $novStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',11)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($novStock) == 0) {
                    $novStock = 0;
                } else {
                    $novStock = $novStock[0];
                }

                array_push($novArray, $novStock);
            }

            $nov = array_sum($novArray);
            array_push($stock, $nov);

            // December
            $decArray = [];
            for ($a=0; $a < count($code); $a++) { 
                $decStock = StockHistory::where('dealer_code',$code[$a])
                ->whereMonth('history_date',12)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($decStock) == 0) {
                    $decStock = 0;
                } else {
                    $decStock = $decStock[0];
                }

                array_push($decArray, $decStock);
            }

            $dec = array_sum($decArray);
            array_push($stock, $dec);

            // dd($stock);

            // Ratio
            for ($b=0; $b < count($stock); $b++) {
                if ($sale[$b] == 0) {
                    $dataRatio = 0;
                } else {
                    $dataRatio = $stock[$b] / $sale[$b];
                }

                array_push($ratio, $dataRatio);
            }
            
        } else {
            $sale = [];
            $stock = [];
            $in = [];
            $ratio = [];
            for ($i=1; $i < 13; $i++) {
                $dataSale = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('stocks.dealer_id', $did)
                ->whereMonth('sale_date',$i)
                ->whereYear('sale_date',$yearNow)
                ->sum('sale_qty');

                $dataOut = Out::join('stocks','outs.stock_id','stocks.id')
                ->where('stocks.dealer_id', $did)
                ->whereMonth('out_date',$i)
                ->whereYear('out_date',$yearNow)
                ->sum('out_qty');

                $dataSaleOut = $dataSale + $dataOut;

                $dataIn = Entry::join('stocks','entries.stock_id','stocks.id')
                ->where('stocks.dealer_id', $did)
                ->whereMonth('entry_date',$i)
                ->whereYear('entry_date',$yearNow)
                ->sum('in_qty');

                $dataStock = StockHistory::where('dealer_code',$dc)
                ->whereMonth('history_date',$i)
                ->whereYear('history_date',$yearNow)
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($dataStock) == 0 ) {
                    $dataStock = 0;
                } else {
                    $dataStock = $dataStock[0];
                }

                if ($dataSaleOut == 0) {
                    $dataRatio = 0;
                } else {
                    $dataRatio = (int)$dataStock / (int)$dataSaleOut;
                }
                // dd($dataRatio);

                array_push($sale, $dataSaleOut);
                array_push($stock, $dataStock);
                array_push($in, $dataIn);
                array_push($ratio, $dataRatio);
            }
            // dd($sale, $in, $stock);
        }
        


        return Chartisan::build()
            ->labels(['Jan', 'Feb', 'Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'])
            ->dataset('Sales', $sale)
            ->dataset('Delivery', $in)
            ->dataset('Stock', $stock)
            ->dataset('Stock Ratio', $ratio);
    }
}
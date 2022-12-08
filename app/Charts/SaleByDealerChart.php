<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Dealer;

class SaleByDealerChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $yearNow = Carbon::now('GMT+8')->format('Y');
        $a01 = Dealer::where('dealer_code','AA0101')->sum('id');
        $a02 = Dealer::where('dealer_code','AA0102')->sum('id');
        $a04 = Dealer::where('dealer_code','AA0104')->sum('id');
        $a05 = Dealer::where('dealer_code','AA0105')->sum('id');
        $a06 = Dealer::where('dealer_code','AA0106')->sum('id');
        $a07 = Dealer::where('dealer_code','AA0107')->sum('id');
        $a08 = Dealer::where('dealer_code','AA0108')->sum('id');
        $a09 = Dealer::where('dealer_code','AA0109')->sum('id');
        $a04F = Dealer::where('dealer_code','AA0104F')->sum('id');
        $a041 = Dealer::where('dealer_code','AA0104-01')->sum('id');

        // SENTRAL
        $jan01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',1)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $feb01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',2)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $mar01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',3)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $apr01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',4)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $may01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',5)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jun01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',6)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jul01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',7)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $aug01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',8)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $sep01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',9)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $oct01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',10)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $nov01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',11)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $dec01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a01)
        ->whereMonth('sale_date',12)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');

        // COKRO
        $jan02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',1)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $feb02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',2)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $mar02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',3)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $apr02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',4)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $may02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',5)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jun02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',6)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jul02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',7)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $aug02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',8)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $sep02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',9)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $oct02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',10)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $nov02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',11)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $dec02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a02)
        ->whereMonth('sale_date',12)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');

        // Hasanuddin
        $jan04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',1)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $feb04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',2)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $mar04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',3)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $apr04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',4)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $may04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',5)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jun04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',6)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jul04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',7)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $aug04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',8)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $sep04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',9)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $oct04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',10)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $nov04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',11)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $dec04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04)
        ->whereMonth('sale_date',12)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');

        // TTS
        $jan05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',1)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $feb05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',2)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $mar05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',3)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $apr05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',4)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $may05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',5)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jun05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',6)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jul05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',7)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $aug05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',8)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $sep05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',9)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $oct05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',10)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $nov05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',11)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $dec05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a05)
        ->whereMonth('sale_date',12)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');

        // IMBO
        $jan06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',1)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $feb06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',2)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $mar06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',3)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $apr06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',4)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $may06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',5)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jun06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',6)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jul06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',7)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $aug06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',8)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $sep06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',9)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $oct06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',10)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $nov06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',11)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $dec06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a06)
        ->whereMonth('sale_date',12)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');

        // MANDIRI
        $jan07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',1)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $feb07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',2)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $mar07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',3)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $apr07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',4)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $may07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',5)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jun07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',6)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jul07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',7)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $aug07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',8)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $sep07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',9)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $oct07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',10)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $nov07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',11)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $dec07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a07)
        ->whereMonth('sale_date',12)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');

        // SUPRATMAN
        $jan08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',1)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $feb08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',2)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $mar08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',3)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $apr08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',4)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $may08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',5)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jun08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',6)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jul08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',7)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $aug08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',8)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $sep08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',9)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $oct08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',10)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $nov08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',11)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $dec08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a08)
        ->whereMonth('sale_date',12)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');

        // SUNSET
        $jan09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',1)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $feb09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',2)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $mar09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',3)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $apr09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',4)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $may09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',5)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jun09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',6)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jul09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',7)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $aug09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',8)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $sep09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',9)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $oct09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',10)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $nov09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',11)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $dec09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a09)
        ->whereMonth('sale_date',12)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');

        // FSS
        $jan04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',1)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $feb04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',2)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $mar04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',3)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $apr04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',4)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $may04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',5)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jun04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',6)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jul04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',7)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $aug04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',8)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $sep04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',9)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $oct04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',10)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $nov04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',11)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $dec04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a04F)
        ->whereMonth('sale_date',12)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');

        // DALUNG
        $jan041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',1)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $feb041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',2)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $mar041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',3)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $apr041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',4)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $may041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',5)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jun041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',6)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $jul041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',7)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $aug041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',8)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $sep041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',9)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $oct041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',10)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $nov041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',11)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');
        $dec041 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $a041)
        ->whereMonth('sale_date',12)
        ->whereYear('sale_date',$yearNow)
        ->sum('sale_qty');

        return Chartisan::build()
            ->labels(['Jan', 'Feb', 'Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'])
            ->dataset('Sentral', [$jan01, $feb01, $mar01, $apr01, $may01, $jun01, $jul01, $aug01, $sep01, $oct01, $nov01, $dec01])
            ->dataset('Cokro', [$jan02, $feb02, $mar02, $apr02, $may02, $jun02, $jul02, $aug02, $sep02, $oct02, $nov02, $dec02])
            ->dataset('Hasanudin', [$jan04, $feb04, $mar04, $apr04, $may04, $jun04, $jul04, $aug04, $sep04, $oct04, $nov04, $dec04])
            ->dataset('TTS', [$jan05, $feb05, $mar05, $apr05, $may05, $jun05, $jul05, $aug05, $sep05, $oct05, $nov05, $dec05])
            ->dataset('Imbo', [$jan06, $feb06, $mar06, $apr06, $may06, $jun06, $jul06, $aug06, $sep06, $oct06, $nov06, $dec06])
            ->dataset('Mandiri', [$jan07, $feb07, $mar07, $apr07, $may07, $jun07, $jul07, $aug07, $sep07, $oct07, $nov07, $dec07])
            ->dataset('Supratman', [$jan08, $feb08, $mar08, $apr08, $may08, $jun08, $jul08, $aug08, $sep08, $oct08, $nov08, $dec08])
            ->dataset('Sunset', [$jan09, $feb09, $mar09, $apr09, $may09, $jun09, $jul09, $aug09, $sep09, $oct09, $nov09, $dec09])
            ->dataset('FSS', [$jan04F, $feb04F, $mar04F, $apr04F, $may04F, $jun04F, $jul04F, $aug04F, $sep04F, $oct04F, $nov04F, $dec04F])
            ->dataset('Dalung', [$jan041, $feb041, $mar041, $apr041, $may041, $jun041, $jul041, $aug041, $sep041, $oct041, $nov041, $dec041]);
    }
}
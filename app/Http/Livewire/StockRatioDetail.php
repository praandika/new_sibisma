<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Out;
use App\Models\Entry;
use App\Models\Stock;
use App\Models\Dealer;
use Carbon\Carbon;


class StockRatioDetail extends Component
{
    public function render()
    {
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');

        $sentral = Dealer::where('dealer_code','AA0101')->sum('id');
        $cokro = Dealer::where('dealer_code','AA0102')->sum('id');
        $ud = Dealer::where('dealer_code','AA0104')->sum('id');
        $tts = Dealer::where('dealer_code','AA0105')->sum('id');
        $imbo = Dealer::where('dealer_code','AA0106')->sum('id');
        $mandiri = Dealer::where('dealer_code','AA0107')->sum('id');
        $wr = Dealer::where('dealer_code','AA0108')->sum('id');
        $sr = Dealer::where('dealer_code','AA0109')->sum('id');
        $fss = Dealer::where('dealer_code','AA0104F')->sum('id');
        $dalung = Dealer::where('dealer_code','AA0104-01')->sum('id');

        // Sentral
        $monthSales_01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $sentral)
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOut_01 = Out::join('stocks','outs.stock_id','stocks.id')
        ->where('stocks.dealer_id', $sentral)
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntry_01 = Entry::join('stocks','entries.stock_id','stocks.id')
        ->where('stocks.dealer_id', $sentral)
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQty_01 = Stock::where('dealer_id',$sentral)
        ->sum('qty');
        
        $monthSaleOut_01 = $monthSales_01 + $monthOut_01;

        // Cokro
        $monthSales_02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $cokro)
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOut_02 = Out::join('stocks','outs.stock_id','stocks.id')
        ->where('stocks.dealer_id', $cokro)
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntry_02 = Entry::join('stocks','entries.stock_id','stocks.id')
        ->where('stocks.dealer_id', $cokro)
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQty_02 = Stock::where('dealer_id',$cokro)
        ->sum('qty');
        $monthSaleOut_02 = $monthSales_02 + $monthOut_02;

        // UD
        $monthSales_04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $ud)
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOut_04 = Out::join('stocks','outs.stock_id','stocks.id')
        ->where('stocks.dealer_id', $ud)
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntry_04 = Entry::join('stocks','entries.stock_id','stocks.id')
        ->where('stocks.dealer_id', $ud)
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQty_04 = Stock::where('dealer_id',$ud)
        ->sum('qty');
        $monthSaleOut_04 = $monthSales_04 + $monthOut_04;

        // TTS
        $monthSales_05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $tts)
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOut_05 = Out::join('stocks','outs.stock_id','stocks.id')
        ->where('stocks.dealer_id', $tts)
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntry_05 = Entry::join('stocks','entries.stock_id','stocks.id')
        ->where('stocks.dealer_id', $tts)
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQty_05 = Stock::where('dealer_id',$tts)
        ->sum('qty');
        $monthSaleOut_05 = $monthSales_05 + $monthOut_05;

        // Imbo
        $monthSales_06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $imbo)
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOut_06 = Out::join('stocks','outs.stock_id','stocks.id')
        ->where('stocks.dealer_id', $imbo)
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntry_06 = Entry::join('stocks','entries.stock_id','stocks.id')
        ->where('stocks.dealer_id', $imbo)
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQty_06 = Stock::where('dealer_id',$imbo)
        ->sum('qty');
        $monthSaleOut_06 = $monthSales_06 + $monthOut_06;

        // Mandiri
        $monthSales_07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $mandiri)
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOut_07 = Out::join('stocks','outs.stock_id','stocks.id')
        ->where('stocks.dealer_id', $mandiri)
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntry_07 = Entry::join('stocks','entries.stock_id','stocks.id')
        ->where('stocks.dealer_id', $mandiri)
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQty_07 = Stock::where('dealer_id',$mandiri)
        ->sum('qty');
        $monthSaleOut_07 = $monthSales_07 + $monthOut_07;

        // WR
        $monthSales_08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $wr)
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOut_08 = Out::join('stocks','outs.stock_id','stocks.id')
        ->where('stocks.dealer_id', $wr)
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntry_08 = Entry::join('stocks','entries.stock_id','stocks.id')
        ->where('stocks.dealer_id', $wr)
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQty_08 = Stock::where('dealer_id',$wr)
        ->sum('qty');
        $monthSaleOut_08 = $monthSales_08 + $monthOut_08;

        // SR
        $monthSales_09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $sr)
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOut_09 = Out::join('stocks','outs.stock_id','stocks.id')
        ->where('stocks.dealer_id', $sr)
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntry_09 = Entry::join('stocks','entries.stock_id','stocks.id')
        ->where('stocks.dealer_id', $sr)
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQty_09 = Stock::where('dealer_id',$sr)
        ->sum('qty');
        $monthSaleOut_09 = $monthSales_09 + $monthOut_09;

        // Dalung
        $monthSales_0401 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $dalung)
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOut_0401 = Out::join('stocks','outs.stock_id','stocks.id')
        ->where('stocks.dealer_id', $dalung)
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntry_0401 = Entry::join('stocks','entries.stock_id','stocks.id')
        ->where('stocks.dealer_id', $dalung)
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQty_0401 = Stock::where('dealer_id',$dalung)
        ->sum('qty');
        $monthSaleOut_0401 = $monthSales_0401 + $monthOut_0401;

        // FSS
        $monthSales_04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id', $fss)
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOut_04F = Out::join('stocks','outs.stock_id','stocks.id')
        ->where('stocks.dealer_id', $fss)
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntry_04F = Entry::join('stocks','entries.stock_id','stocks.id')
        ->where('stocks.dealer_id', $fss)
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQty_04F = Stock::where('dealer_id',$fss)
        ->sum('qty');
        $monthSaleOut_04F = $monthSales_04F + $monthOut_04F;

        // Group
        $monthSales = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id','!=', $fss)
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOut = Out::join('stocks','outs.stock_id','stocks.id')
        ->where('stocks.dealer_id','!=', $fss)
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntry = Entry::join('stocks','entries.stock_id','stocks.id')
        ->where('stocks.dealer_id','!=', $fss)
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQty = Stock::where('dealer_id','!=',$fss)
        ->sum('qty');

        $monthSaleOut = $monthSales + $monthOut;

        // Group + FSS
        $monthSalesPlus = Sale::join('stocks','sales.stock_id','stocks.id')
        ->whereMonth('sale_date',$month)
        ->whereYear('sale_date', $year)
        ->sum('sale_qty');
        $monthOutPlus = Out::join('stocks','outs.stock_id','stocks.id')
        ->whereMonth('out_date',$month)
        ->whereYear('out_date', $year)
        ->sum('out_qty');
        $monthEntryPlus = Entry::join('stocks','entries.stock_id','stocks.id')
        ->whereMonth('entry_date',$month)
        ->whereYear('entry_date', $year)
        ->sum('in_qty');
        $stockQtyPlus = Stock::sum('qty');

        $monthSaleOutPlus = $monthSalesPlus + $monthOutPlus;

        // Sentral
        if ($monthSaleOut_01 <= 0 && $stockQty_01 <= 0) {
            $ratio_01 = 0;
        }elseif($monthSaleOut_01 <= 0 || $stockQty_01 <= 0){
            if ($monthSaleOut_01 <= 0) {
                $ratio_01 = $stockQty_01/$stockQty_01;
            } else {
                $ratio_01 = $stockQty_01/$monthSaleOut_01;
            }
        } else {
            $ratio_01 = $stockQty_01/$monthSaleOut_01;
        }
        
        $ratio_01 = number_format($ratio_01, 2);

        // Cokro
        if ($monthSaleOut_02 <= 0 && $stockQty_02 <= 0) {
            $ratio_02 = 0;
        }elseif($monthSaleOut_02 <= 0 || $stockQty_02 <= 0){
            if ($monthSaleOut_02 <= 0) {
                $ratio_02 = $stockQty_02/$stockQty_02;
            } else {
                $ratio_02 = $stockQty_02/$monthSaleOut_02;
            }
        } else {
            $ratio_02 = $stockQty_02/$monthSaleOut_02;
        }
        
        $ratio_02 = number_format($ratio_02, 2);

        // UD
        if ($monthSaleOut_04 <= 0 && $stockQty_04 <= 0) {
            $ratio_04 = 0;
        }elseif($monthSaleOut_04 <= 0 || $stockQty_04 <= 0){
            if ($monthSaleOut_04 <= 0) {
                $ratio_04 = $stockQty_04/$stockQty_04;
            } else {
                $ratio_04 = $stockQty_04/$monthSaleOut_04;
            }
        } else {
            $ratio_04 = $stockQty_04/$monthSaleOut_04;
        }
        
        $ratio_04 = number_format($ratio_04, 2);

        // TTS
        if ($monthSaleOut_05 <= 0 && $stockQty_05 <= 0) {
            $ratio_05 = 0;
        }elseif($monthSaleOut_05 <= 0 || $stockQty_05 <= 0){
            if ($monthSaleOut_05 <= 0) {
                $ratio_05 = $stockQty_05/$stockQty_05;
            } else {
                $ratio_05 = $stockQty_05/$monthSaleOut_05;
            }
        } else {
            $ratio_05 = $stockQty_05/$monthSaleOut_05;
        }
        
        $ratio_05 = number_format($ratio_05, 2);

        // Imbo
        if ($monthSaleOut_06 <= 0 && $stockQty_06 <= 0) {
            $ratio_06 = 0;
        }elseif($monthSaleOut_06 <= 0 || $stockQty_06 <= 0){
            if ($monthSaleOut_06 <= 0) {
                $ratio_06 = $stockQty_06/$stockQty_06;
            } else {
                $ratio_06 = $stockQty_06/$monthSaleOut_06;
            }
        } else {
            $ratio_06 = $stockQty_06/$monthSaleOut_06;
        }
        
        $ratio_06 = number_format($ratio_06, 2);

        // Mandiri
        if ($monthSaleOut_07 <= 0 && $stockQty_07 <= 0) {
            $ratio_07 = 0;
        }elseif($monthSaleOut_07 <= 0 || $stockQty_07 <= 0){
            if ($monthSaleOut_07 <= 0) {
                $ratio_07 = $stockQty_07/$stockQty_07;
            } else {
                $ratio_07 = $stockQty_07/$monthSaleOut_07;
            }
        } else {
            $ratio_07 = $stockQty_07/$monthSaleOut_07;
        }
        
        $ratio_07 = number_format($ratio_07, 2);

        // WR
        if ($monthSaleOut_08 <= 0 && $stockQty_08 <= 0) {
            $ratio_08 = 0;
        }elseif($monthSaleOut_08 <= 0 || $stockQty_08 <= 0){
            if ($monthSaleOut_08 <= 0) {
                $ratio_08 = $stockQty_08/$stockQty_08;
            } else {
                $ratio_08 = $stockQty_08/$monthSaleOut_08;
            }
        } else {
            $ratio_08 = $stockQty_08/$monthSaleOut_08;
        }
        
        $ratio_08 = number_format($ratio_08, 2);

        // SR
        if ($monthSaleOut_09 <= 0 && $stockQty_09 <= 0) {
            $ratio_09 = 0;
        }elseif($monthSaleOut_09 <= 0 || $stockQty_09 <= 0){
            if ($monthSaleOut_09 <= 0) {
                $ratio_09 = $stockQty_09/$stockQty_09;
            } else {
                $ratio_09 = $stockQty_09/$monthSaleOut_09;
            }
        } else {
            $ratio_09 = $stockQty_09/$monthSaleOut_09;
        }
        
        $ratio_09 = number_format($ratio_09, 2);

        // Dalung
        if ($monthSaleOut_0401 <= 0 && $stockQty_0401 <= 0) {
            $ratio_0401 = 0;
        }elseif($monthSaleOut_0401 <= 0 || $stockQty_0401 <= 0){
            if ($monthSaleOut_0401 <= 0) {
                $ratio_0401 = $stockQty_0401/$stockQty_0401;
            } else {
                $ratio_0401 = $stockQty_0401/$monthSaleOut_0401;
            }
        } else {
            $ratio_0401 = $stockQty_0401/$monthSaleOut_0401;
        }
        
        $ratio_0401 = number_format($ratio_0401, 2);

        // FSS
        if ($monthSaleOut_04F <= 0 && $stockQty_04F <= 0) {
            $ratio_04F = 0;
        }elseif($monthSaleOut_04F <= 0 || $stockQty_04F <= 0){
            if ($monthSaleOut_04F <= 0) {
                $ratio_04F = $stockQty_04F/$stockQty_04F;
            } else {
                $ratio_04F = $stockQty_04F/$monthSaleOut_04F;
            }
        } else {
            $ratio_04F = $stockQty_04F/$monthSaleOut_04F;
        }
        
        $ratio_04F = number_format($ratio_04F, 2);

        // Group
        if ($monthSaleOut <= 0 && $stockQty <= 0) {
            $ratio = 0;
        }elseif($monthSaleOut <= 0 || $stockQty <= 0){
            if ($monthSaleOut <= 0) {
                $ratio = $stockQty/$stockQty;
            } else {
                $ratio = $stockQty/$monthSaleOut;
            }
        } else {
            $ratio = $stockQty/$monthSaleOut;
        }
        
        $ratio = number_format($ratio, 2);

        // Group + FSS
        if ($monthSaleOutPlus <= 0 && $stockQtyPlus <= 0) {
            $ratioPlus = 0;
        }elseif($monthSaleOutPlus <= 0 || $stockQtyPlus <= 0){
            if ($monthSaleOutPlus <= 0) {
                $ratioPlus = $stockQtyPlus/$stockQtyPlus;
            } else {
                $ratioPlus = $stockQtyPlus/$monthSaleOutPlus;
            }
        } else {
            $ratioPlus = $stockQtyPlus/$monthSaleOutPlus;
        }
        
        $ratioPlus = number_format($ratioPlus, 2);

        return view('livewire.stock-ratio-detail', compact(
            'monthSaleOut_01','monthEntry_01','stockQty_01','ratio_01','monthSales_01','monthOut_01',
            'monthSaleOut_02','monthEntry_02','stockQty_02','ratio_02','monthSales_02','monthOut_02',
            'monthSaleOut_04','monthEntry_04','stockQty_04','ratio_04','monthSales_04','monthOut_04',
            'monthSaleOut_05','monthEntry_05','stockQty_05','ratio_05','monthSales_05','monthOut_05',
            'monthSaleOut_06','monthEntry_06','stockQty_06','ratio_06','monthSales_06','monthOut_06',
            'monthSaleOut_07','monthEntry_07','stockQty_07','ratio_07','monthSales_07','monthOut_07',
            'monthSaleOut_08','monthEntry_08','stockQty_08','ratio_08','monthSales_08','monthOut_08',
            'monthSaleOut_09','monthEntry_09','stockQty_09','ratio_09','monthSales_09','monthOut_09',
            'monthSaleOut_0401','monthEntry_0401','stockQty_0401','ratio_0401','monthSales_0401','monthOut_0401',
            'monthSaleOut_04F','monthEntry_04F','stockQty_04F','ratio_04F','monthSales_04F','monthOut_04F',
            'monthSaleOut','monthEntry','stockQty','ratio','monthSales','monthOut',
            'monthSaleOutPlus','monthEntryPlus','stockQtyPlus','ratioPlus','monthSalesPlus','monthOutPlus',
        ));
    }
}

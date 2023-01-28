<?php

namespace App\Http\Livewire;

use App\Models\Dealer;
use App\Models\Sale;
use App\Models\STU;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StuVsReal extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');
        $yesterday = Carbon::yesterday('GMT+8')->format('Y-m-d');
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

    if ($dc == 'group') {
        // STU vs Real
        $stu = STU::whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real = Sale::whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');
    }else{
        // STU vs Real
        $stu = STU::where('dealer_code',$dc)
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id',$did)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');
    }
        
        if($stu <= 0 && $real <= 0){
            $stuRealAch = 0;
            $stuReal = 0;
        }elseif ($stu <= 0 || $real <= 0) {
            if ($real <= 0) {
                $stuRealAch = ($stu/$stu);
                $stuReal = ($stu)*100;
            } else {
                $stuRealAch = 0;
                $stuReal = (0-$real)*100;
            }
        } else {
            $stuRealAch = ($stu/$real)*100;
            $stuReal = ($stu/$real-1)*100;
        }

        return view('livewire.stu-vs-real', compact('today','stuReal','yesterday','stuRealAch'));
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\STU;
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
        $Yes = STU::whereYear('stu_date',$yesterday)->sum('stu');
    }else{
        // STU vs Real
        $Yes = STU::where('dealer_code',$dc)
        ->whereYear('stu_date',$yesterday)->sum('stu');
    }
        
        if($LY <= 0 && $yearSales <= 0){
            $vsLYach = 0;
            $vsLY = 0;
        }elseif ($LY <= 0 || $yearSales <= 0) {
            if ($LY <= 0) {
                $vsLYach = ($yearSales/$yearSales);
                $vsLY = ($LY)*100;
            } else {
                $vsLYach = 0;
                $vsLY = (0-$LY)*100;
            }
        } else {
            $vsLYach = ($yearSales/$LY)*100;
            $vsLY = ($yearSales/$LY-1)*100;
        }

        return view('livewire.stu-vs-real', compact('today','vsLY','lastYear','vsLYach'));
    }
}

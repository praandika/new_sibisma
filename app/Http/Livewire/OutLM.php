<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Out;
use Carbon\Carbon;

class OutLM extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');
        $lastMonthDisplay = Carbon::now('GMT+8')->subMonth()->format('Y-m-d');
        $lastMonth = Carbon::now('GMT+8')->subMonth()->format('m');
        $lastMonthY = Carbon::now('GMT+8')->subMonth()->format('Y');
        $monthOut = Out::whereMonth('out_date',$month)->whereYear('out_date',$year)->sum('out_qty');

        // vs LM
        $LM = Out::whereMonth('out_date',$lastMonth)->whereYear('out_date',$lastMonthY)->sum('out_qty');
        // dd($lastMonth, $lastMonthY, $LM);
        if($LM <= 0 && $monthOut <= 0){
            $vsLMach = 0;
            $vsLM = 0;
        }elseif ($LM <= 0 || $monthOut <= 0) {
            if ($LM <= 0) {
                $vsLMach = ($monthOut/$monthOut);
                $vsLM = ($LM)*100;
            } else {
                $vsLMach = 0;
                $vsLM = (0-$LM)*100;
            }
        } else {
            $vsLMach = ($monthOut/$LM)*100;
            $vsLM = ($monthOut/$LM-1)*100;
        }

        return view('livewire.out-l-m', compact('today','lastMonth','vsLM','vsLMach','lastMonthDisplay'));
    }
}

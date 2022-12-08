<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Out;
use Carbon\Carbon;

class OutLY extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');
        $lastMonth = Carbon::now('GMT+8')->subMonth()->format('Y-m');
        $lastYear = Carbon::now('GMT+8')->format('Y') - 1;
        $yearOut = Out::whereYear('out_date',$year)->sum('out_qty');

        // vs LY
        $LY = Out::whereYear('out_date',$lastYear)->sum('out_qty');
        if($LY <= 0 && $yearOut <= 0){
            $vsLYach = 0;
            $vsLY = 0;
        }elseif ($LY <= 0 || $yearOut <= 0) {
            if ($LY <= 0) {
                $vsLYach = ($yearOut/$yearOut);
                $vsLY = ($LY)*100;
            } else {
                $vsLYach = 0;
                $vsLY = (0-$LY)*100;
            }
        } else {
            $vsLYach = ($yearOut/$LY)*100;
            $vsLY = ($yearOut/$LY-1)*100;
        }

        return view('livewire.out-l-y', compact('today','lastYear','vsLY','vsLYach'));
    }
}

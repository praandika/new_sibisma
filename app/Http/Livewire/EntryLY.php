<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Entry;
use Carbon\Carbon;

class EntryLY extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m'); 
        $year = Carbon::now('GMT+8')->format('Y');
        $lastMonth = Carbon::now('GMT+8')->subMonth()->format('Y-m');
        $lastYear = Carbon::now('GMT+8')->format('Y') - 1;
        $yearEntry = Entry::whereYear('entry_date',$year)->sum('in_qty');

        // vs LY
        $LY = Entry::whereYear('entry_date',$lastYear)->sum('in_qty');
        if($LY <= 0 && $yearEntry <= 0){
            $vsLYach = 0;
            $vsLY = 0;
        }elseif ($LY <= 0 || $yearEntry <= 0) {
            if ($LY <= 0) {
                $vsLYach = ($yearEntry/$yearEntry);
                $vsLY = ($LY)*100;
            } else {
                $vsLYach = 0;
                $vsLY = (0-$LY)*100;
            }
        } else {
            $vsLYach = ($yearEntry/$LY)*100;
            $vsLY = ($yearEntry/$LY-1)*100;
        }

        return view('livewire.entry-l-y',compact('today','lastYear','vsLY','vsLYach'));
    }
}

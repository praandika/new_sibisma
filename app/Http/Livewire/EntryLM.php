<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Entry;
use Carbon\Carbon;

class EntryLM extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');
        $lastMonthDisplay = Carbon::now('GMT+8')->subMonth()->format('Y-m-d');
        $lastMonth = Carbon::now('GMT+8')->subMonth()->format('m');
        $lastMonthY = Carbon::now('GMT+8')->subMonth()->format('Y');
        $monthEntry = Entry::whereMonth('entry_date',$month)->whereYear('entry_date',$year)->sum('in_qty');

        // vs LM
        $LM = Entry::whereMonth('entry_date',$lastMonth)->whereYear('entry_date',$lastMonthY)->sum('in_qty');
        if($LM <= 0 && $monthEntry <= 0){
            $vsLMach = 0;
            $vsLM = 0;
        }elseif ($LM <= 0 || $monthEntry <= 0) {
            if ($LM <= 0) {
                $vsLMach = ($monthEntry/$monthEntry);
                $vsLM = ($LM)*100;
            } else {
                $vsLMach = 0;
                $vsLM = (0-$LM)*100;
            }
        } else {
            $vsLMach = ($monthEntry/$LM)*100;
            $vsLM = ($monthEntry/$LM-1)*100;
        }

        return view('livewire.entry-l-m', compact('today','lastMonth','vsLM','vsLMach','lastMonthDisplay'));
    }
}

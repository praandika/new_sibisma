<?php

namespace App\Http\Livewire;

use App\Models\Allocation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InfoAllocationOut extends Component
{
    public function render()
    {
        $dc = Auth::user()->dealer_code;
        $thisMonth = Carbon::now('GMT+8')->format('F Y');
        $month = Carbon::now('GMT+8')->format('m');
        
        if ($dc == 'group') {
            $data = Allocation::whereMonth('allocation_date', $month)
            ->where('out_status','yes')->count();
        } else {
            $data = Allocation::whereMonth('allocation_date', $month)
            ->where('out_status','yes')
            ->where('dealer_code', $dc)->count();
        }
        return view('livewire.info-allocation-out', compact('thisMonth','data'));
    }
}

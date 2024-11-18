<?php

namespace App\Http\Livewire;

use App\Models\Allocation;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Dealer;

class WidgetAllocation extends Component
{
    public function render()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        if ($dc == 'group') {
            $stock = Allocation::where('out_status','no')->count();
            $data = Allocation::selectRaw('COUNT(frame_no) as stock, dealer_code')
            ->where('out_status','no')
            ->groupBy('dealer_code')
            ->get();
        } else {
            $stock = Allocation::where('out_status','no')
            ->where('dealer_code',$dc)->count();
            $data = Allocation::selectRaw('COUNT(frame_no) as stock, dealer_code')
            ->where('out_status','no')
            ->where('dealer_code',$dc)
            ->groupBy('dealer_code')
            ->get();
        }
        
        return view('livewire.widget-allocation', compact('stock','data'));
    }
}

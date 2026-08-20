<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UnitOnHand;
use Illuminate\Support\Facades\Auth;

class WidgetStockQty extends Component
{
    public function render()
    {
        $dc = Auth::user()->dealer_code;

        if ($dc == 'group') {
            $stock = UnitOnHand::where('status','onhand')->count('frame_no');
            $data = UnitOnHand::with('dealer')
            ->selectRaw('COUNT(frame_no) as qty, dealer_code')
            ->groupBy('dealer_code')
            ->orderBy('qty', 'desc')
            ->get();
            
        } else {
            $stock = UnitOnHand::where('dealer_code',$dc)->count('frame_no');
            $data = UnitOnHand::with('dealer')
            ->selectRaw('COUNT(frame_no) as qty, dealer_code')
            ->groupBy('dealer_code')
            ->orderBy('qty', 'desc')
            ->get();
        }
        
        return view('livewire.widget-stock-qty', compact('stock','data'));
    }
}

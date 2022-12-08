<?php

namespace App\Http\Livewire;

use App\Models\StockHistory;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Dealer;

class Notification extends Component
{
    public function render()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        if ($dc == 'group') {
            $data = StockHistory::where([
                ['faktur','=',null],
                ['service','=',null]
            ])->get();
            
        } else {
            $data = StockHistory::where('dealer_code', $dc)
            ->where([
                ['faktur','=',null],
                ['service','=',null]
            ])->get();
        }
        
        $count = count($data);
        
        return view('livewire.notification', compact('data', 'count'));
    }
}

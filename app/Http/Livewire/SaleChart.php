<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dealer;
use Illuminate\Support\Facades\Auth;

class SaleChart extends Component
{
    public function render()
    {
        $dc = Auth::user()->dealer_code;
        $cek = Dealer::where('dealer_code',$dc)->count();
        if ($cek > 0) {
            $did = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
            if ($dc == 'group') {
                $dealerName = 'Bisma Group';
            } else {
                $dealerName = $did[0];
            }
        } else {
            if ($dc == 'group') {
                $dealerName = 'Bisma Group';
            } else {
                $dealerName = null;
            }
        }
        return view('livewire.sale-chart', compact('dealerName'));
    }
}

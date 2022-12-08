<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dealer;

class DealerData extends Component
{
    protected $listeners = [
        'dealerCreateListen',
    ];

    public function dealerCreateListen(){}

    public function render()
    {
        $data = Dealer::orderBy('dealers.dealer_code','asc')->get();
        return view('livewire.dealer-data', compact('data'));
    }
}

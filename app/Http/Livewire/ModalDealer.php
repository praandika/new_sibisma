<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dealer;
use Illuminate\Support\Facades\Auth;

class ModalDealer extends Component
{
    public function render()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        if ($dc == 'group') {
            $dealer = Dealer::orderBy('id','asc')->get();
            $dealerOut = Dealer::where('dealer_code','!=','YIMM')
            ->orderBy('id','asc')->get();
        }else{
            $dealer = Dealer::orderBy('id','asc')->where('id','!=',$did)->get();
            $dealerOut = Dealer::orderBy('id','asc')
            ->where('dealer_code','!=','YIMM')
            ->where('id','!=',$did)->get();
        }

        return view('livewire.modal-dealer', compact('dealer','dealerOut'));
    }
}

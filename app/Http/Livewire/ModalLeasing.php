<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Leasing;

class ModalLeasing extends Component
{
    public function render()
    {
        $leasing = Leasing::all();
        return view('livewire.modal-leasing', compact('leasing'));
    }
}

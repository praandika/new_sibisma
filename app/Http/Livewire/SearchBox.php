<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\Spk;
use App\Models\Sale;

class SearchBox extends Component
{
    public function render()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->format('Y-m-d');

        return view('livewire.search-box', compact('start', 'end'));
    }
}

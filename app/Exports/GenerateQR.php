<?php

namespace App\Exports;

use App\Models\Warehouse;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class GenerateQR implements FromView
{
    use Exportable;

    public function dealer(string $dealer)
    {
        $this->dealer = $dealer;
        return $this;
    }

    public function date(string $date)
    {
        $this->date = $date;
        return $this;
    }

    public function baris(string $baris)
    {
        $this->baris = $baris;
        return $this;
    }

    public function gudang(string $gudang)
    {
        $this->gudang = $gudang;
        return $this;
    }

    public function view(): View{
        $data = [];
        for ($i=1; $i <= $this->baris ; $i++) { 
            array_push($data, 'https://sibisma.yamahabismagroup.com/public/warehouse/entry/'.$this->dealer.$this->date.$i.'/'.$this->gudang);
        }

        return view('export.qrcode',[
            'data' => $data
        ]);
    }
}

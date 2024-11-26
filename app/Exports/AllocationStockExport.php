<?php

namespace App\Exports;

use App\Models\Allocation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\Auth;
use App\Models\Dealer;
use Maatwebsite\Excel\Events\AfterSheet;

class AllocationStockExport implements FromView, WithTitle, WithEvents
{
    protected $start, $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }
    public function view(): View{
        $dc = Auth::user()->dealer_code;

        if ($dc == 'group') {
            return view('export.allocation-stock',[
                'data' => Allocation::whereBetween('allocation_date', [$this->start, $this->end])
                ->where('out_status','no')
                ->orderBy('allocation_date','asc')->get()
            ]);
        } else {
            $dc = Auth::user()->dealer_code;
            $did = Dealer::where('dealer_code',$dc)->sum('id');
            return view('export.allocation-stock',[
                'data' => Allocation::whereBetween('allocation_date', [$this->start, $this->end])
                ->where('out_status','no')
                ->where('dealer_code',$dc)
                ->get()
            ]);
        }
    }

    public function title(): string
    {
        return 'Stock'; // Name of the second sheet
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Get the active sheet
                $sheet = $event->sheet;

                // Alternatively, if you want to auto-size all columns, you can loop through them
                foreach (range('A', 'Z') as $columnID) {
                    $sheet->getDelegate()->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}

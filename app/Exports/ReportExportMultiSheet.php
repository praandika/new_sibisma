<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReportExportMultiSheet implements WithMultipleSheets
{
    use Exportable;

    protected $start, $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function sheets(): array
    {
        return [
            new AllocationOutExport($this->start, $this->end),
            new AllocationStockExport($this->start, $this->end),
        ];
    }
}

<?php

namespace App\Imports;

use App\Models\Allocation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AllocationsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Allocation([
            'model' => $row['model'],
            'model_name' => $row['model_name'],
            'color' => $row['color'],
            'frame_no' => $row['frame_no'],
            'engine_no' => $row['engine_no'],
            'faktur_no' => $row['faktur_no'],
            'nik_no' => $row['nik_no'],
            'yimm_revise_type' => $row['yimm_revise_type'],
            'received' => $row['received'],
            'allocation_date' => $row['allocation_date'],
            'dealer_code' => $row['dealer_code'],
        ]);
    }
}

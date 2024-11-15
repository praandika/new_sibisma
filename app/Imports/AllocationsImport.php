<?php

namespace App\Imports;

use App\Models\Allocation;
use Maatwebsite\Excel\Concerns\ToModel;

class AllocationsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Allocation([
            'model' => $row[0],
            'model_name' => $row[1],
            'color' => $row[2],
            'frame_no' => $row[3],
            'engine_no' => $row[4],
            'faktur_no' => $row[5],
            'nik_no' => $row[6],
            'yimm_revise_type' => $row[7],
            'received' => $row[8],
        ]);
    }
}

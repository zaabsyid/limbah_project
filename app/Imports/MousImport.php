<?php

namespace App\Imports;

use App\Models\Mou;
use Maatwebsite\Excel\Concerns\ToModel;

class MousImport implements ToModel
{
    // /**
    //  * @param array $row
    //  *
    //  * @return \Illuminate\Database\Eloquent\Model|null
    //  */
    public function model(array $row)
    {
        return new Mou([
            'mou_number' => $row[0],
            'customer_name' => $row[1],
            'customer_nik' => $row[2],
            'customer_address' => $row[3],
            'customer_occupation' => $row[4],
            'mou_status' => $row[5],
            'province_id' => $row[6],
            'city_id' => $row[7],
            'contract_period' => $row[8],
            'contract_end_date' => $row[9],
        ]);
    }
}

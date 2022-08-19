<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Models\Cargo;

class CargosImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            $data = [
                'number'=>$row['cargo_no'],
                'type'=>$row['cargo_type'],
                'size'=>$row['cargo_size'],
                'weight'=>$row['weight_kg'],
                'remarks'=>$row['remarks'],
                'wharfage'=>$row['wharfage_usd'],
                'penalty'=>$row['penalty_days'],
                'storage'=>$row['storage_usd'],
                'electricity'=>$row['electricity_usd'],
                'destuffing'=>$row['destuffing_usd'],
                'lifting'=>$row['lifting_usd'],
            ];
            Cargo::create($data);
        }
    }
}

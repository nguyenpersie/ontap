<?php

namespace App\Imports;

use App\Models\Mst_customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel
{
    /**
    *  $row
    *
    *
    */
    public function model(array $row)
    {
        return new Mst_customer([
            'customer_name' => $row[1],
            'email' => $row[2],
            'tel_num' => $row[3],
            'address' => $row[4],
        ]);
    }

    public function mapRow(Row $row): array
{
    return $row = $row->toArray();
}
}

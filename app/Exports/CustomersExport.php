<?php

namespace App\Exports;

use App\Models\Mst_Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection
{
    /**
    */
    public function collection()
    {
        return Mst_Customer::all();
    }

    public function headings(): array
    {
        return [
            'customer_name',
            'email',
            'address',
            'tel_num',
            // Add more columns as needed
        ];
    }
}

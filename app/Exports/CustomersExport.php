<?php

namespace App\Exports;

use App\Models\Mst_Customer;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomersExport implements FromCollection
{
    /**
    */
    public function collection()
    {
        return Mst_Customer::all();
    }
}

<?php

namespace App\Exports;

use App\Models\Mst_Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromQuery, ShouldQueue, WithChunkReading
{
    use Exportable;
    /**
    */
    public function query()
    {
        return Mst_Customer::query();
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

    public function batchSize(): int
    {
        return 3000;
    }

    public function chunkSize(): int
    {
        return 3000;
    }
}

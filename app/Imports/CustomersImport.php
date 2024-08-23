<?php

namespace App\Imports;

use App\Models\Mst_customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel, WithBatchInserts, WithChunkReading, ShouldQueue
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
            // 'is_active' => $row[5],
        ]);
    }

    public function mapRow(Row $row): array
    {
        return $row = $row->toArray();
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

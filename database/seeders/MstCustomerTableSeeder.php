<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Mst_customer;
use Illuminate\Database\Seeder;

class MstCustomerTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Mst_customer::factory()->count(9000)->create();
    }
}

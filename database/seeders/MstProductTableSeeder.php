<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Mst_product;
use Illuminate\Database\Seeder;

class MstProductTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Mst_product::factory()->count(9950)->create();
    }
}

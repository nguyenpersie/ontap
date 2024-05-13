<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mst_products', function (Blueprint $table) {
            $table->string('product_id',20)->unique()->index();
            $table->string('product_name',255);
            $table->string('product_image',255)->nullable();
            $table->decimal('product_price')->default(0);
            $table->tinyInteger('is_sales')->length(1)->default(1);
            $table->text('deccription')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_products');
    }
};

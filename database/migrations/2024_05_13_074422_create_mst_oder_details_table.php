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
        Schema::create('mst_oder_details', function (Blueprint $table) {
            $table->integer('order_id')->length(11)->index()->unique();
            $table->integer('detail_line')->length(11)->primary();
            $table->string('product_id',50);
            $table->integer('price_buy')->length(11);
            $table->integer('quantity')->length(11);
            $table->string('shop_id',50);
            $table->integer('receiver_id')->length(11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_oder_details');
    }
};

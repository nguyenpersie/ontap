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
        Schema::create('mst_oders', function (Blueprint $table) {
            $table->increments('order_id')->unique()->index();
            $table->string('order_shop',40);
            $table->integer('customer_id')->length(11);
            $table->integer('totle_price')->length(11);
            $table->tinyInteger('payment_method')->length(4);
            $table->integer('ship_charge')->length(11)->nullable();
            $table->integer('tax')->length(11)->nullable();
            $table->dateTime('order_date');
            $table->dateTime('shipment_date')->nullable();
            $table->dateTime('cancel_date')->nullable();
            $table->tinyInteger('order_status')->length(1);
            $table->string('note_customer',255)->nullable();
            $table->string('error_code_api',20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_oders');
    }
};

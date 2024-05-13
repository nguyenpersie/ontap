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
        Schema::create('mst_customers', function (Blueprint $table) {
            $table->increments('customer_id')->length(11)->unique()->index();
            $table->string('customer_name',255);
            $table->string('email',255);
            $table->string('tel_num',14);
            $table->string('address',255);
            $table->tinyInteger('is_active')->length(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_customers');
    }
};

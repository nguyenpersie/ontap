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
        Schema::create('mst_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('email',255)->unique()->index();
            $table->string('password',255);
            $table->string('remember_token',100)->nullable();
            $table->string('verify_email',100)->nullable();
            $table->tinyInteger('is_active')->length(1)->default(1);
            $table->tinyInteger('is_delete')->length(1)->default(0);
            $table->string('group_role',50);
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip',40)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_users');
    }
};

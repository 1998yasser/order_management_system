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
        Schema::create('costumers', function (Blueprint $table) {
            $table->string('phone')->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address_1')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('email')->nullable();
            $table->longText('remarques')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costumers');
    }
};

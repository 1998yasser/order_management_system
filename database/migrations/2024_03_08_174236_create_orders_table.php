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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->date('date_created')->nullable();
            $table->date('date_modified')->nullable();
            $table->string('discount_total')->nullable();
            $table->string('shipping_total')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->string('tracking')->nullable();
            $table->string('total')->nullable();
            $table->string('customer_id')->index();
            $table->foreign('customer_id')->references('phone')->on('costumers')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

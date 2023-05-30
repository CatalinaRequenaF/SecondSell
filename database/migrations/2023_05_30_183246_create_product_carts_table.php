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
        Schema::create('product_carts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();/*
            $table->string('emit');
            $table->decimal('price');

            ///Fk's
            $table->foreignId('order_id')->nullable();
            $table->foreignId('buyer_id')->nullable();

            //$table->foreignId('discount_id')->nullable();*/
            $table->foreignId('product_id');
            $table->foreignId('cart_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_carts');
    }
};

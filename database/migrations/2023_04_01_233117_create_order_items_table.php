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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //$table->string('name');
            $table->decimal('price');

            ///Fk's
            $table->foreignId('order_id');
            $table->foreignId('seller_id');
            $table->foreignId('buyer_id')->nullable();
            //$table->foreignId('discount_id')->nullable();
            $table->foreignId('product_id');


            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('buyer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

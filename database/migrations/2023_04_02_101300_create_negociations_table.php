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
        Schema::create('negociations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('actual_price');
            $table->string('proposed_price');

            //Fk's
            $table->foreignId('product_id');
            $table->foreignId('seller_id');
            $table->foreignId('buyer_id');
                
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('buyer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negociations');
    }
};

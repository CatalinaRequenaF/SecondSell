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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price');
            $table->text('state'); //Muy usado, semi nuevo, nuevo
            $table->string('active'); //Disponible (o no)
            $table->timestamps();


            //Fk's
            $table->foreignId('seller_id');
            $table->foreignId('buyer_id')->nullable();
            $table->foreignId('category_id')->nullable();

            
        $table->foreign('seller_id')->references('id')->on('users');
        $table->foreign('buyer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

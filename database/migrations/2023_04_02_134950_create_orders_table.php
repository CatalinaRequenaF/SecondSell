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
            $table->timestamps();

       
            $table->decimal('subtotal', 8, 2)->default(0);

            $table->float('total', 8, 2)->default(0);
            
            //Estado (en pausa, en proceso, completado)
            $table->string('status')->default('processing');

            $table->string('orderItem');

            $table->foreignId('user_id');
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

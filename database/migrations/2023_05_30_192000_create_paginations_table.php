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
        Schema::create('paginations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('emit');
            $table->integer('categoryBlank');
            $table->boolean('categoryDisplay'); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paginations');
    }
};

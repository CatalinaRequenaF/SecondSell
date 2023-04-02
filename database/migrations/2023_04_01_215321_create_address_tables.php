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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('street');
            $table->bigInteger('number');
            $table->string('complement');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zip_code');





        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

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
        Schema::create('followables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('');

            /*    tag_id - integer
            taggable_id - integer
            taggable_type - string*/
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followables');
    }
};

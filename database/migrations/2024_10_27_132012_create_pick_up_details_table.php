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
        Schema::create('pick_up_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pick_up_id')->constrained('pick_ups')->onDelete('cascade');
            $table->foreignId('limbah_id')->constrained('limbahs')->onDelete('cascade');
            $table->integer('price');
            $table->integer('qty');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pick_up_details');
    }
};

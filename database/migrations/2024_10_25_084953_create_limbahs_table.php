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
        Schema::create('limbahs', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('status')->default('pending'); // pending, picked_up, or terminated
            $table->date('pickup_date');
            $table->integer('weight_kg');
            $table->string('manifest_code')->nullable();
            $table->string('team_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('limbahs');
    }
};

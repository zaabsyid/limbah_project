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
            $table->string('code_manifest')->nullable();
            $table->string('document_manifest')->nullable();
            $table->integer('weight_limbah');
            $table->enum('pickup_1', ['belum_dijemput', 'sudah_dijemput', 'putus_kontrak'])->default('belum_dijemput');
            $table->enum('pickup_2', ['belum_dijemput', 'sudah_dijemput', 'putus_kontrak'])->default('belum_dijemput');
            $table->enum('pickup_3', ['belum_dijemput', 'sudah_dijemput', 'putus_kontrak'])->default('belum_dijemput');
            $table->enum('pickup_4', ['belum_dijemput', 'sudah_dijemput', 'putus_kontrak'])->default('belum_dijemput');
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
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

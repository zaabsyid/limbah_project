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
        Schema::create('penjemputan_limbahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('limbah_id')->constrained('limbahs')->onDelete('cascade');
            $table->string('code_manifest')->nullable();
            $table->string('document_manifest')->nullable();
            $table->integer('weight_limbah')->nullable();
            $table->enum('pickup', ['belum_dijemput', 'siap_dijemput', 'sudah_dijemput', 'putus_kontrak'])->default('belum_dijemput');
            $table->date('date_pickup');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjemputan_limbahs');
    }
};

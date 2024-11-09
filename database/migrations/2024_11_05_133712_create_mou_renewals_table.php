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
        Schema::create('mou_renewals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perpanjangan_mou_id')->constrained('perpanjangan_mous')->onDelete('cascade');
            $table->integer('year'); // Tahun perpanjangan (1 hingga 5)
            $table->enum('status', ['belum_dibayar', 'sudah_dibayar'])->default('belum_dibayar'); // Status pembayaran
            $table->date('due_date'); // Tanggal jatuh tempo untuk setiap tahun
            $table->string('document_payment')->nullable(); // Bukti pembayaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mou_renewals');
    }
};

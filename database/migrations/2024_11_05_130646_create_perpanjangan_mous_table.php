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
        Schema::create('perpanjangan_mous', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mou_id')->constrained('mous')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->enum('package', ['2', '5']);
            $table->integer('year')->nullable(); // Tahun perpanjangan (1 hingga 5)
            $table->enum('status', ['orange', 'green'])->default('orange'); // Status pembayaran
            $table->date('due_date'); // Tanggal jatuh tempo untuk setiap tahun
            $table->string('document_payment')->nullable(); // Bukti pembayaran
            $table->boolean('notified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perpanjangan_mous');
    }
};

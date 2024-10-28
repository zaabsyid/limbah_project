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
        Schema::create('pick_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mou_id')->constrained('mous')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
            $table->string('pickup_code')->unique();
            $table->date('pickup_date');
            $table->integer('total_weight');
            $table->integer('total_price');
            $table->string('remarks')->nullable();
            $table->enum('payment_status', ['Pending', 'Completed', 'Canceled'])->default('Pending');
            $table->enum('pickup_status', ['Belum Dijemput', 'Sudah Dijemput', 'Putus Kontrak'])->default('Belum Dijemput');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pick_ups');
    }
};

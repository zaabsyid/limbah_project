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
        Schema::create('mous', function (Blueprint $table) {
            $table->id();
            $table->string('mou_number');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('customer_name')->nullable();
            $table->string('customer_nik')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_occupation')->nullable();
            $table->string('customer_ktp_image')->nullable();
            $table->string('customer_npwp_image')->nullable();
            $table->string('customer_sip_str_image')->nullable();
            $table->string('customer_image_1')->nullable();
            $table->string('customer_image_2')->nullable();
            $table->string('customer_materai_1')->nullable();
            $table->string('customer_materai_2')->nullable();
            $table->enum('mou_status', ['draft', 'file'])->default('status');
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->enum('contract_period', ['2', '5'])->default('2');
            $table->date('contract_end_date');
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mous');
    }
};

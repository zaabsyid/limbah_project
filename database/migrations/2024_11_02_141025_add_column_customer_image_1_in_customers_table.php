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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('customer_image_2')->after('image')->nullable();
            $table->string('customer_npwp_file')->after('customer_image_2')->nullable();
            $table->string('customer_ktp_file')->after('customer_npwp_file')->nullable();
            $table->string('customer_str_sip_file')->after('customer_ktp_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('customer_image_2');
            $table->dropColumn('customer_npwp_file');
            $table->dropColumn('customer_ktp_file');
            $table->dropColumn('customer_str_sip_file');
        });
    }
};

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
        Schema::table('mous', function (Blueprint $table) {
            $table->dropColumn('customer_image_1');
            $table->dropColumn('customer_image_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mous', function (Blueprint $table) {
            $table->string('customer_image_1')->nullable();
            $table->string('customer_image_2')->nullable();
        });
    }
};

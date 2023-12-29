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
        Schema::create('m_akses', function (Blueprint $table) {
            $table->unsignedSmallInteger('k_akses')->primary();
            $table->masterColumn();

            $table->unsignedSmallInteger('urutan')->nullable();
            $table->tinyInteger('is_aktif')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_akses');
    }
};

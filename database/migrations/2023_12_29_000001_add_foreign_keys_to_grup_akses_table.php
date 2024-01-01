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
        Schema::table('grup_akses', function (Blueprint $table) {
            $table->foreign('k_grup')->references('k_grup')->on('m_grup');
            $table->foreign('k_akses')->references('k_akses')->on('m_akses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grup_akses', function (Blueprint $table) {
            $table->dropForeign('k_grup');
            $table->dropForeign('k_akses');
        });
    }
};

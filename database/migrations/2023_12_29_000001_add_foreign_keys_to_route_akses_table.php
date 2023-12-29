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
        Schema::table('route_akses', function (Blueprint $table) {
            $table->foreign('route_key')->references('key')->on('routes');
            $table->foreign('k_akses')->references('k_akses')->on('m_akses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('route_akses', function (Blueprint $table) {
            $table->dropForeign('route_key');
            $table->dropForeign('k_akses');
        });
    }
};

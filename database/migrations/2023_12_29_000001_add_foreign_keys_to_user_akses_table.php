<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_akses', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('k_akses')->references('k_akses')->on('m_akses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_akses', function(Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('k_akses');
        });
    }
};

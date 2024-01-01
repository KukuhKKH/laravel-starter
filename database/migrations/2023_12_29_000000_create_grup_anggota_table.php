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
        Schema::create('grup_anggota', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('k_grup')->index();
            $table->unsignedSmallInteger('k_grup_anggota')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grup_anggota');
    }
};

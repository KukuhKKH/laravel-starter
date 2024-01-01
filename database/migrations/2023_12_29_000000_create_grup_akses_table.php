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
        Schema::create('grup_akses', function(Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('k_grup')->index();
            $table->unsignedSmallInteger('k_akses')->index();

            $table->string('duplikasi', 50)->unique();
            $table->tinyInteger('is_aktif')->default(0);

            $table->timestamps();
            $table->auditable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grup_akses');
    }
};

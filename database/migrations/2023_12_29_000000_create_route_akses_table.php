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
        Schema::create('route_akses', function (Blueprint $table) {
            $table->id();
            $table->string('route_key', 100);
            $table->unsignedSmallInteger('k_akses');
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
        Schema::dropIfExists('route_akses');
    }
};

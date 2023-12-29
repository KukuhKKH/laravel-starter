<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Blueprint::macro('masterColumn', function (int $singkat = 50, int $keterangan = 100, array $nullable = []) {
            /** @var Blueprint $this */
            $table = $this;

            $table->string('singkat', $singkat)
                ->nullable($nullable['singkat'] ?? true);

            $table->string('keterangan', $keterangan)
                ->nullable($nullable['keterangan'] ?? true);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

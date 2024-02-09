<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
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

            $nullSingkat    = (bool)Arr::get($nullable, 'singkat', false);
            $nullKeterangan = (bool)Arr::get($nullable, 'keterangan', false);

            $table->string('singkat', $singkat)
                ->nullable($nullSingkat);

            $table->string('keterangan', $keterangan)
                ->nullable($nullKeterangan);

            return $this;
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

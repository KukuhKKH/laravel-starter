<?php

namespace Tests\Helpers;

use Illuminate\Foundation\Testing\RefreshDatabase as BaseTrait;
use Illuminate\Foundation\Testing\RefreshDatabaseState;

trait LazilyRefreshDatabase
{
    use BaseTrait {
        refreshDatabase as baseRefreshDatabase;
    }

    protected function calculateHash(): string
    {
        $files = [
            database_path('migrations'),
            database_path('seeders'),
        ];

        $hash = '';
        while ($file = array_shift($files)) {
            if (is_file($file)) {
                $hash .= '-' . md5_file($file);
                continue;
            }

            $dir = dir($file);
            while (false != ($subfile = $dir->read())) {
                if ($subfile != '.' && $subfile != '..') {
                    $files[] = $file . DIRECTORY_SEPARATOR . $subfile;
                }
            }
        }

        return md5($hash);
    }

    protected function shouldSeed()
    {
        return true;
    }

    public function refreshDatabase()
    {
        $database = $this->app->make('db');

        $database->beforeExecuting(function() {
            if (RefreshDatabaseState::$lazilyRefreshed) {
                return;
            }

            RefreshDatabaseState::$lazilyRefreshed = true;

            $path = database_path('db.checksum');
            $hash = null;
            if (!RefreshDatabaseState::$migrated) {
                $hash = $this->calculateHash();

                if (file_exists($path) && file_get_contents($path) == $hash) {
                    RefreshDatabaseState::$migrated = true;
                }
            }

            $this->baseRefreshDatabase();

            if ($hash) {
                file_put_contents($path, $hash);
            }
        });

        $this->beforeApplicationDestroyed(function() {
            RefreshDatabaseState::$lazilyRefreshed = false;
        });
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Routes;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Throwable;

class GenerateRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-routes {--commit : Jika akan disimpan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate routes from routes/*';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(): void
    {
        $isCommit = $this->option('commit') ?? null;
        $routes   = collect(Route::getRoutes());

        $result = $routes->map(function(\Illuminate\Routing\Route $route) {
            return [
                'key'   => $this->fromController($route->getActionName()),
                'label' => $route->getActionName(),
            ];
        })->chunk(100);

        $bar = $this->output->createProgressBar($result->count());

        $result->each(function($chunk) use ($bar, $isCommit) {
            $bar->advance();

            foreach ($chunk as $value) {
                $modelRoutes = Routes::query()
                    ->firstOrNew(['key' => $value['key']], $value);

                if ($isCommit) {
                    $modelRoutes->save();
                }
            }

        });

        $bar->finish();
        $this->line('');
    }

    public function fromController($controller): string
    {
        $controller = Str::replace('App\\Http\\Controllers\\', '', $controller);
        $controller = Str::replace('Controller@', '.', $controller);
        $controller = Str::replace('\\', '', $controller);

        return Str::lower(Str::snake($controller, '-'));
    }
}

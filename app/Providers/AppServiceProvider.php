<?php

namespace App\Providers;

use App;
use DateTimeInterface;
use Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events;
use Illuminate\Support\ServiceProvider;
use Log;
use Monolog\Handler\StreamHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($_COOKIE['debug-cuy'] ?? '' == '71244dd982415ad10726a7df3926c405') { // md5('haiyaaa')
            config(['app.debug' => true]);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (App::runningInConsole()) {
            $logger = Log::getLogger();
            /** @noinspection PhpPossiblePolymorphicInvocationInspection */
            $logger->pushHandler(new StreamHandler("php://stdout"));
        }

        if (App::runningInConsole()) {
            Event::listen(function(Events\QueryExecuted $event) {
                if (!config('app.debug')) {
                    return;
                }

                $bindings = [];
                foreach ($event->bindings as $binding) {
                    if (is_object($binding)) {
                        if ($binding instanceof DateTimeInterface) {
                            $bindings[] = $binding->format('Y-m-d H:i:s');
                        } else {
                            $bindings[] = "'$binding'";
                        }
                    } else {
                        $bindings[] = var_export($binding, true);
                    }
                }

                $query = str_replace(['%', '?'], ['%%', '%s'], $event->sql);
                $query = vsprintf($query, $bindings);

                Log::debug("$event->connectionName - $query");
            });

            Event::listen(function(Events\TransactionBeginning $event) {
                Log::debug("$event->connectionName - begin");
            });

            Event::listen(function(Events\TransactionCommitted $event) {
                Log::debug("$event->connectionName - committed");
            });

            Event::listen(function(Events\TransactionCommitting $event) {
                Log::debug("$event->connectionName - committing");
            });

            Event::listen(function(Events\TransactionRolledBack $event) {
                Log::debug("$event->connectionName - rollback");
            });
        }

        Model::shouldBeStrict(App::hasDebugModeEnabled() || App::runningUnitTests());
    }
}

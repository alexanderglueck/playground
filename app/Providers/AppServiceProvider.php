<?php

namespace App\Providers;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel as HttpKernel;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Everything strict, all the time.
        Model::shouldBeStrict();

        // In production, merely log lazy loading violations.
        if ($this->app->isProduction()) {
            Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
                $class = get_class($model);

                info("Attempted to lazy load [{$relation}] on model [{$class}].");
            });
        }

        // Enforce a morph map instead of making it optional.
        Relation::enforceMorphMap([
            'user' => \App\Models\User::class,
            'contact' => \App\Models\Contact::class,
            'invoice' => \App\Models\Invoice::class,
        ]);

        // Log a warning if we spend more than a total of 2000ms querying.
        DB::whenQueryingForLongerThan(2000, function (Connection $connection) {
            Log::warning("Database queries exceeded 2 seconds on {$connection->getName()}");
        });

        // Log a warning if we spend more than 1000ms on a single query.
        DB::listen(function ($query) {
            if ($query->time > 1000) {
                Log::warning("An individual database query exceeded 1 second.", [
                    'sql' => $query->sql
                ]);
            }
        });

        if ($this->app->runningInConsole()) {
            // Log slow commands.
            $this->app[ConsoleKernel::class]->whenCommandLifecycleIsLongerThan(
                5000,
                function ($startedAt, $input, $status) {
                    Log::warning("A command took longer than 5 seconds.");
                }
            );
        } else {
            // Log slow requests.
            $this->app[HttpKernel::class]->whenRequestLifecycleIsLongerThan(
                5000,
                function ($startedAt, $request, $response) {
                    Log::warning("A request took longer than 5 seconds.");
                }
            );
        }
    }
}

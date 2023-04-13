<?php

namespace App\Providers;

use App\Models\ShareableLink;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            foreach ($this->centralDomains() as $domain) {
                Route::prefix('api')
                    ->domain($domain)
                    ->middleware('api')
                    ->group(base_path('routes/api.php'));

                Route::middleware('web')
                    ->domain($domain)
                    ->group(base_path('routes/web.php'));
            }
        });

        Route::bind('shareable_link', function ($value) {
            try {
                return ShareableLink::query()->where('uuid', $value)->firstOrFail();
            } catch (QueryException $e) {
                throw new ModelNotFoundException($e->getMessage());
            }
        });
    }

    protected function centralDomains(): array
    {
        return config('tenancy.central_domains');
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}

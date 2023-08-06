<?php

namespace App\Http\Middleware\Subscription;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfCancelled
{
    public function handle(Request $request, Closure $next): Response
    {
        if ( ! tenancy()->tenant->hasSubscription() || tenancy()->tenant->hasCancelled()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

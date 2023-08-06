<?php

namespace App\Http\Middleware\Subscription;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotActive
{
    public function handle(Request $request, Closure $next): Response
    {
        if ( ! tenancy()->tenant->onTrial() && tenancy()->tenant->hasNoSubscription()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

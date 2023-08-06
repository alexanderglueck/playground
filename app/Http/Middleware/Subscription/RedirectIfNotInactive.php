<?php

namespace App\Http\Middleware\Subscription;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotInactive
{
    public function handle(Request $request, Closure $next): Response
    {
        if (tenancy()->tenant->hasSubscription()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

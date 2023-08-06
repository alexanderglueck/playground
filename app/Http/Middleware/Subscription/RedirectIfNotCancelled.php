<?php

namespace App\Http\Middleware\Subscription;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotCancelled
{
    public function handle(Request $request, Closure $next): Response
    {
        if (tenancy()->tenant->hasNotCancelled()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

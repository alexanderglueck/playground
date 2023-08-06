<?php

namespace App\Http\Middleware\Subscription;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfCannotManageSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()->canManageSubscription()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

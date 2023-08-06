<?php

namespace App\Http\Middleware\Subscription;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotCustomer
{
    public function handle(Request $request, Closure $next): Response
    {
        if ( ! tenancy()->tenant->isCustomer()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

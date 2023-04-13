<?php

namespace App\Http\Middleware;

use App\Models\ShareableLink;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateShareableLink
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var ShareableLink $link */
        $link = $request->route('shareable_link');

        abort_unless($link->isActive(), 404);

        return $next($request);
    }
}

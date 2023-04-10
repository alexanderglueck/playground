<?php

namespace App\Http\Controllers;

use Stancl\Tenancy\Database\Models\ImpersonationToken;
use Stancl\Tenancy\Features\UserImpersonation;

class ImpersonationController extends Controller
{
    public function __invoke(ImpersonationToken $token)
    {
        return UserImpersonation::makeResponse($token);
    }
}

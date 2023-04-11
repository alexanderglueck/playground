<?php

namespace App\Http\Controllers;

use Stancl\Tenancy\Database\Models\ImpersonationToken;
use Stancl\Tenancy\Features\UserImpersonation;

class ImpersonationController extends Controller
{
    public function show()
    {
        // TODO finish implementation
        $redirectUrl = '/';

        $tenant = tenancy()->tenant;

        // TODO Change hardcoded ID to some passed-in value
        $userId = 1;

        // Let's say we want to be redirected to the dashboard
        // after we're logged in as the impersonated user.
        $token = tenancy()->impersonate($tenant, $userId, $redirectUrl);

        return $token;
    }

    public function store(ImpersonationToken $token)
    {
        return UserImpersonation::makeResponse($token);
    }
}

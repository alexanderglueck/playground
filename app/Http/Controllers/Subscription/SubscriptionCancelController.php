<?php

namespace App\Http\Controllers\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stancl\Tenancy\Contracts\Tenant;

class SubscriptionCancelController extends Controller
{
    public function index()
    {
        return view('subscription.cancel.index');
    }

    public function store(Tenant $tenant)
    {
        $tenant->subscription('main')->cancel();

        flash(trans('flash_message.settings.subscription.cancelled'), 'success');

        return redirect()->route('dashboard');
    }
}

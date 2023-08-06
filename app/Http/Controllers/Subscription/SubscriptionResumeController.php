<?php

namespace App\Http\Controllers\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stancl\Tenancy\Contracts\Tenant;

class SubscriptionResumeController extends Controller
{
    public function index()
    {
        return view('subscription.resume.index');
    }

    public function store(Tenant $tenant)
    {
        $tenant->subscription('main')->resume();

        flash(trans('flash_message.settings.subscription.resumed'), 'success');

        return redirect()->route('dashboard');
    }
}

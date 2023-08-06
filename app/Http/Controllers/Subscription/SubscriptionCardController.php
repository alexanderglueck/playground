<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\SubscriptionCardStoreRequest;
use Illuminate\Http\Request;
use Stancl\Tenancy\Contracts\Tenant;

class SubscriptionCardController extends Controller
{
    public function index(Request $request, Tenant $tenant)
    {
        return view('subscription.card.index', [
            'intent' => $tenant->createSetupIntent()
        ]);
    }

    public function store(SubscriptionCardStoreRequest $request, Tenant $tenant)
    {
        $tenant->updateDefaultPaymentMethod($request->token);

        flash(trans('flash_message.settings.card.updated'), 'success');

        return redirect()->route('subscription.card.index');
    }
}

<?php

namespace App\Http\Controllers\Subscription;

use App\Events\SubscriptionCreated;
use App\Models\Plan;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\SubscriptionStoreRequest;
use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment ;
use Laravel\Cashier\SubscriptionBuilder;
use Stancl\Tenancy\Contracts\Tenant;

class SubscriptionController extends Controller
{
    public function index(Tenant $tenant)
    {
        $plans = Plan::active()->get();

        return view('subscription.index', [
            'plans' => $plans,
            'intent' => $tenant->createSetupIntent()
        ]);
    }

    public function store(SubscriptionStoreRequest $request, Tenant $tenant)
    {
        /** @var SubscriptionBuilder $subscription */
        $subscription = $tenant->newSubscription('main', $request->plan);

        if ($request->has('coupon')) {
            $subscription->withCoupon($request->coupon);
        }

        try {
            $subscription->create($request->token);
        } catch (IncompletePayment  $exception) {
            return redirect()->route('cashier.payment',
                [$exception->payment->id, 'redirect' => route('home')]
            );
        }

        event(new SubscriptionCreated($tenant));

        flash(trans('flash_message.settings.subscription.subscribed'), 'success');

        return redirect()->route('dashboard');
    }
}

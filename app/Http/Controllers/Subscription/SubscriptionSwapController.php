<?php

namespace App\Http\Controllers\Subscription;

use App\Models\Plan;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\SubscriptionSwapStoreRequest;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stancl\Tenancy\Contracts\Tenant;

class SubscriptionSwapController extends Controller
{
    public function index(Tenant $tenant)
    {
        $plans = Plan::except($tenant->subscription('main')->stripe_price)->active()->get();

        return view('subscription.swap.index', [
            'plans' => $plans
        ]);
    }

    public function store(SubscriptionSwapStoreRequest $request, Tenant $tenant)
    {
        $plan = Plan::where('gateway_id', $request->plan)->first();

        try {
            $tenant->subscription('main')->swap($plan->gateway_id);
        } catch (IncompletePayment $exception) {
            return redirect()->route('cashier.payment',
                [$exception->payment->id, 'redirect' => route('home')]
            );
        }

        flash(trans('flash_message.settings.plan.changed'), 'success');

        return back();
    }

}

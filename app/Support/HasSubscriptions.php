<?php

namespace App\Support;

trait HasSubscriptions
{

    public function hasSubscription($subscription = 'main'): bool
    {
        return $this->subscribed($subscription);
    }

    public function hasNoSubscription($subscription = 'main'): bool
    {
        return ! $this->hasSubscription($subscription);
    }

    public function hasCancelled()
    {
        return optional($this->subscription('main'))->canceled();
    }

    public function hasNotCancelled(): bool
    {
        return ! $this->hasCancelled();
    }

    public function isCustomer(): bool
    {
        return $this->hasStripeId();
    }
}

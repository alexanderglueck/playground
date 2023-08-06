<?php

namespace App\Events;

use App\Models\Tenant;
use Illuminate\Queue\SerializesModels;

class SubscriptionCreated
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Tenant $tenant)
    {
        //
    }
}

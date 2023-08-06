<?php

namespace App\Models;

use App\Support\HasSubscriptions;
use Laravel\Cashier\Billable;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, Billable, HasSubscriptions;

    protected $casts = [
        'trial_ends_at' => 'datetime'
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'created_at',
            'updated_at',
            'stripe_id',
            'pm_type',
            'pm_last_four',
            'trial_ends_at',
        ];
    }

    public function stripeName(): ?string
    {
        return $this->id;
    }

    // stripeEmail, stripePhone, stripeAddress, stripePreferredLocales
}

<?php

namespace App\Support;

use App\Models\Tenant;
use App\Models\TenantUser;
use Illuminate\Database\Eloquent\Collection;

class TenantUserLookup
{
    public static function get(string $email): Collection
    {
        return TenantUser::query()
            ->select('domain')
            ->join('domains', 'domains.tenant_id', '=', 'tenant_user.tenant')
            ->where([
                'email' => $email
            ])->get();
    }

    public static function insert(string $tenant, string $email): void
    {
        TenantUser::query()->insert([
            'tenant' => $tenant,
            'email' => $email
        ]);
    }

    public static function update(string $oldEmail, string $newEmail): void
    {
        TenantUser::query()
            ->where('tenant', tenant('id'))
            ->where('email', $oldEmail)
            ->update([
                'email' => $newEmail
            ]);
    }
}

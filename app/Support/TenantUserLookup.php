<?php

namespace App\Support;

use App\Models\TenantUser;

class TenantUserLookup
{
    public static function get(string $email)
    {

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

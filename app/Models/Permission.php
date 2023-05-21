<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    public $timestamps = false;

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function inRole(Role|string $role): bool
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return ! ! $role->intersect($this->roles)->count();
    }
}

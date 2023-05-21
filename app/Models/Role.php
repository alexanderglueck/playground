<?php

namespace App\Models;

use App\Support\CanBeFlashed;
use App\Support\Flashable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model implements Flashable
{
    use CanBeFlashed;

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function givePermissionTo(Permission $permission): Permission
    {
        return $this->permissions()->save($permission);
    }

    public function hasPermission(Permission $permission, User $user): bool
    {
        return $this->hasRole($permission->roles);
    }

    public function inRole($permission): bool
    {
        if (is_string($permission)) {
            return $this->permissions->contains('name', $permission);
        }
        return ! ! $permission->intersect($this->permissions)->count();
    }
}

<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class LimitNotebooksScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();

        if ( ! $user) {
            return;
        }

        $builder->where(function (Builder $query) use ($user) {
            $query->where('user_id', '=', $user->id)
                ->where('is_private', '=', 1);
        })->orWhere('is_private', '=', 0);
    }
}

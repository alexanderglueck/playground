<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LimitNotesScope implements Scope
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

        $inSubQuery = DB::table('notebooks')->select('notebooks.id')
            ->where(function (QueryBuilder $query) use ($user) {
                $query->where('notebooks.user_id', '=', $user->id)
                    ->where('notebooks.is_private', '=', 1);
            })->orWhere('notebooks.is_private', '=', 0)
            ->whereColumn('notes.notebook_id', '=', 'notebooks.id');

        $builder->whereIn('notebook_id', $inSubQuery);
    }
}

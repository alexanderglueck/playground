<?php

namespace App\Models\Scopes;

use App\Support\AccessRight;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Query\Builder as QueryBuilder;

class LimitContactsScope implements Scope
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

        $builder->whereExists(function (QueryBuilder $query) use ($user) {
            $query->select('contact_contact_group.contact_id')
                ->from('contact_contact_group')
                ->join('contact_group_user', 'contact_group_user.contact_group_id', '=', 'contact_contact_group.contact_group_id')
                ->whereIn('contact_group_user.privilege', [AccessRight::READ, AccessRight::WRITE])
                ->where('contact_group_user.user_id', '=', $user->id)
                ->whereColumn('contact_contact_group.contact_id', '=', 'contacts.id');
        });
    }
}

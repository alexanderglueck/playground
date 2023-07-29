<?php

namespace App\Models\Scopes;

use App\Support\AccessRight;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        // TODO Check if whereExists is really the correct way to check access
        $builder->where(function (Builder $query) use ($user) {
            $query->whereExists(function (QueryBuilder $query) use ($user) {
                $query->select('contact_contact_group.contact_id')
                    ->from('contact_contact_group')
                    ->join('contact_group_role', 'contact_group_role.contact_group_id', '=', 'contact_contact_group.contact_group_id')
                    ->whereIn('contact_group_role.privilege', [AccessRight::READ, AccessRight::WRITE])
                    ->whereIn('contact_group_role.role_id', $user->roles()->pluck('roles.id')->toArray())
                    ->whereColumn('contact_contact_group.contact_id', '=', 'contacts.id');
            })->orWhereNotIn('id', DB::table('contact_contact_group')->select('contact_id'));
        });
    }
}

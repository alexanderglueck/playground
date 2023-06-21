<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;

class ContactPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-contacts');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Contact $contact): bool
    {
        return $user->hasPermissionTo('view-contacts');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-contacts');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contact $contact): bool
    {
        return $user->hasPermissionTo('update-contacts');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Contact $contact): bool
    {
        return $user->hasPermissionTo('delete-contacts');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Contact $contact): bool
    {
        return $user->hasPermissionTo('restore-contacts');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Contact $contact): bool
    {
        return $user->hasPermissionTo('force-delete-contacts');
    }
}

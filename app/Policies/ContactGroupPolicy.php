<?php

namespace App\Policies;

use App\Models\ContactGroup;
use App\Models\User;

class ContactGroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-contact-groups');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ContactGroup $contactGroup): bool
    {
        return $user->hasPermissionTo('view-contact-groups');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-contact-groups');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ContactGroup $contactGroup): bool
    {
        return $user->hasPermissionTo('update-contact-groups');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContactGroup $contactGroup): bool
    {
        return $user->hasPermissionTo('delete-contact-groups');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ContactGroup $contactGroup): bool
    {
        return $user->hasPermissionTo('restore-contact-groups');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ContactGroup $contactGroup): bool
    {
        return $user->hasPermissionTo('force-delete-contact-groups');
    }
}

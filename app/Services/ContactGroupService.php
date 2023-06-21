<?php

namespace App\Services;

use App\Data\ContactGroupData;
use App\Models\ContactGroup;
use App\Models\Role;
use App\Models\User;
use App\Support\AccessRight;
use Illuminate\Support\Collection;
use RuntimeException;

class ContactGroupService
{
    public function getContactGroups(): Collection
    {
        return ContactGroup::query()->get();
    }

    public function createContactGroup(User $user, ContactGroupData $data): ContactGroup
    {
        $contactGroup = new ContactGroup();
        $contactGroup->fill($data->toArray());

        if ( ! $contactGroup->save()) {
            throw new RuntimeException(__('Could not create contact group'));
        }

        // Add the creating user to the authorized users
        $contactGroup->users()->updateExistingPivot($user, ['privilege' => AccessRight::WRITE]);

        return $contactGroup;
    }

    public function updateContactGroup(ContactGroup $contactGroup, ContactGroupData $data): ContactGroup
    {
        $contactGroup->fill($data->toArray());

        if ( ! $contactGroup->save()) {
            throw new RuntimeException(__('Could not update contact group'));
        }

        return $contactGroup;
    }
}

<?php

namespace App\Services;

use App\Data\ContactData;
use App\Models\Contact;
use App\Models\User;
use App\Support\ViewType;
use Illuminate\Support\Collection;
use RuntimeException;

class ContactService
{
    public function __construct(private readonly ViewValidationService $viewValidationService)
    {
    }

    public function getContacts(): Collection
    {
        return Contact::withFields()->with('contactGroups')->get();
    }

    public function createContact(User $user, ContactData $data): Contact
    {
        $contact = new Contact();
        $contact->fill($data->toArray());

        if ( ! $contact->save()) {
            throw new RuntimeException(__('Could not create contact'));
        }

        if ( ! empty($data->customFields)) {
            $contact->customFields()->update($data->customFields);
        }

        if ($data->contactGroups !== null) {
            // If contactGroups is null, no contact groups were selected.
            // We need to differentiate between "no contact groups were selected" and
            // "contact groups were absent from the edit mask".

            // Another thing to keep in mind is that a contact could have more contact groups
            // than the user is allowed to see. Passing in his contact groups could result
            // in all "hidden" contact groups being detached.
            // Ideally we would calculate the difference between the received contact groups
            // and the contact groups the user is allowed to see, and to then detach the ones that are no longer
            // included in the diff.
            $contact->contactGroups()->sync($data->contactGroups);
        }

        return $contact;
    }

    public function updateContact(Contact $contact, ContactData $data): Contact
    {
        // TODO Refactor so toArray only returns the fields that were passed with the view
        $fieldInView = array_keys($this->viewValidationService->getRules(ViewType::CONTACT, $data->view->id));

        $temp = [];
        foreach ($data->toArray() as $key => $value) {
            if ( ! in_array($key, $fieldInView)) {
                continue;
            }

            $temp[$key] = $value;
        }

        $contact->fill($temp);

        if ( ! $contact->save()) {
            throw new RuntimeException(__('Could not update contact'));
        }

        if ( ! empty($data->customFields)) {
            $contact->customFields()->update($data->customFields);
        }

        if ($data->contactGroups !== null) {
            // If contactGroups is null, no contact groups were selected.
            // We need to differentiate between "no contact groups were selected" and
            // "contact groups were absent from the edit mask".

            // Another thing to keep in mind is that a contact could have more contact groups
            // than the user is allowed to see. Passing in his contact groups could result
            // in all "hidden" contact groups being detached.
            // Ideally we would calculate the difference between the received contact groups
            // and the contact groups the user is allowed to see, and to then detach the ones that are no longer
            // included in the diff.
            $contact->contactGroups()->sync($data->contactGroups);
        }

        return $contact;
    }
}

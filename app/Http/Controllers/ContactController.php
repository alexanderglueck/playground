<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Field;

class ContactController
{
    public function index()
    {
        $contacts = Contact::with(['view', 'customFields'])->get();
        //return $contacts;
        return $contacts->map(function (Contact $contact) {
            return $contact->fields();
        });
    }

    public function show(Contact $contact)
    {
//        return $contact->fields();
        return $contact->fields()->map(function (Field $field) use ($contact) {
//            return $field->column;
            return $contact->fieldValue($field);
        });
    }
}

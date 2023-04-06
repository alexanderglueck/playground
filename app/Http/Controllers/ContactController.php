<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

class ContactController
{
    public function index(): Collection
    {
        return Contact::withFields()->get();
    }

    public function show(Contact $contact)
    {
        return $contact->fields();
    }
}

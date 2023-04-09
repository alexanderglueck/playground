<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ContactController
{
    public function index(): Collection
    {
        return Contact::withFields()->visibleTo(Auth::user())->with('contactGroups')->get();
    }

    public function show(Contact $contact)
    {
        return $contact->fields();
    }
}

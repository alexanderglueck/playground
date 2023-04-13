<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ContactController
{
    public function index(): View
    {
        $contacts = Contact::withFields()->visibleTo(Auth::user())->with('contactGroups')->get();

        return view('contacts.index', [
            'contacts' => $contacts
        ]);
    }

    public function show(Contact $contact)
    {
        return $contact->fields();
    }
}

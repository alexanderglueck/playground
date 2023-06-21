<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\ContactGroup;
use App\Models\Country;
use App\Services\ContactService;
use App\Services\ViewService;
use App\Support\Flash;
use App\Support\ViewType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RuntimeException;

class ContactController extends Controller
{
    public function __construct(
        private readonly ContactService $contactService,
        private readonly ViewService $viewService
    )
    {
    }

    public function index(): View
    {
        $this->authorize('viewAny', Contact::class);

        return view('contact.index', [
            'contacts' => $this->contactService->getContacts()
        ]);
    }

    public function create(Request $request): View
    {
        $this->authorize('create', Contact::class);

        $contact = new Contact();
        $contact->view_id = $request->input('view')
            ? \App\Models\View::findOrFail($request->input('view'))->id
            : \App\Models\View::find(\App\Models\View::getDefaultViewId(ViewType::CONTACT))->id;

        return view('contact.create', [
            'contact' => $contact,
            'contactGroups' => ContactGroup::all(),
            'countries' => Country::all(),
            'views' => $this->viewService->getViews(ViewType::CONTACT)
        ]);
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        $this->authorize('create', Contact::class);

        try {
            $contact = $this->contactService->createContact($request->user(), $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        Flash::created($contact);

        return redirect()->route('contacts.index');
    }

    public function show(Request $request, Contact $contact)
    {
        $this->authorize('view', $contact);

        $request->input('view') && $contact->view_id = \App\Models\View::findOrFail($request->input('view'))->id;

        return view('contact.show', [
            'contact' => $contact,
            'views' => $this->viewService->getViews(ViewType::CONTACT)
        ]);
    }

    public function edit(Request $request, Contact $contact): View
    {
        $this->authorize('update', $contact);

        $request->input('view') && $contact->view_id = \App\Models\View::findOrFail($request->input('view'))->id;

        return view('contact.edit', [
            'createButtonText' => __('Create contact'),
            'contact' => $contact,
            'contactGroups' => ContactGroup::all(),
            'countries' => Country::all()
        ]);
    }

    public function update(ContactRequest $request, Contact $contact): RedirectResponse
    {
        $this->authorize('update', $contact);

        try {
            $contact = $this->contactService->updateContact($contact, $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        Flash::updated($contact);

        return redirect()->route('contacts.show', [$contact]);
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $this->authorize('delete', $contact);

        $contact->delete();

        return redirect()->route('contacts.index');
    }
}

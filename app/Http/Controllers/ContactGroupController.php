<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactGroupRequest;
use App\Models\ContactGroup;
use App\Services\ContactGroupService;
use App\Support\Flash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RuntimeException;

class ContactGroupController extends Controller
{
    public function __construct(
        private readonly ContactGroupService $contactGroupService
    )
    {
    }

    public function index(): View
    {
        $this->authorize('viewAny', ContactGroup::class);

        return view('contact_group.index', [
            'contactGroups' => $this->contactGroupService->getContactGroups()
        ]);
    }

    public function create(Request $request): View
    {
        $this->authorize('create', ContactGroup::class);

        $contactGroup = new ContactGroup();

        return view('contact_group.create', [
            'contactGroup' => $contactGroup,
        ]);
    }

    public function store(ContactGroupRequest $request): RedirectResponse
    {
        $this->authorize('create', ContactGroup::class);

        try {
            $contactGroup = $this->contactGroupService->createContactGroup($request->user(), $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        Flash::created($contactGroup);

        return redirect()->route('contact_groups.index');
    }

    public function show(ContactGroup $contactGroup)
    {
        $this->authorize('view', $contactGroup);

        return view('contact_group.show', [
            'contactGroup' => $contactGroup
        ]);
    }

    public function edit(ContactGroup $contactGroup): View
    {
        $this->authorize('update', $contactGroup);

        return view('contact_group.edit', [
            'createButtonText' => __('Create contact group'),
            'contactGroup' => $contactGroup
        ]);
    }

    public function update(ContactGroupRequest $request, ContactGroup $contactGroup): RedirectResponse
    {
        $this->authorize('update', $contactGroup);

        try {
            $contactGroup = $this->contactGroupService->updateContactGroup($contactGroup, $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        Flash::updated($contactGroup);

        return redirect()->route('contact_groups.show', [$contactGroup]);
    }

    public function destroy(ContactGroup $contactGroup): RedirectResponse
    {
        $this->authorize('delete', $contactGroup);

        $contactGroup->delete();

        return redirect()->route('contact_groups.index');
    }
}

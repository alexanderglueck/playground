<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessContactExport;
use App\Models\ContactExport;
use App\Models\ContactGroup;
use App\Services\ContactGroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ContactExportController extends Controller
{
    public function index(ContactGroupService $contactGroupService)
    {
        return view('contact_export.index', [
            'contactGroups' => $contactGroupService->getContactGroups()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contact_group' => ['required', Rule::in(ContactGroup::query()->pluck('id'))]
        ]);

        $contactExport = new ContactExport();
        $contactExport->started_at = now();
        $contactExport->contact_group_id = $validated['contact_group'];
        $contactExport->file_path = Str::uuid()->toString() . '.xlsx';
        $contactExport->save();

        ProcessContactExport::dispatch($request->user(), $contactExport);

        return redirect()->route('contact_export.index');
    }
}

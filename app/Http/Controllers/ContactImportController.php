<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessContactImport;
use App\Models\ContactImport;
use App\Services\FieldService;
use App\Support\ViewType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\SimpleExcel\SimpleExcelReader;

class ContactImportController extends Controller
{
    public function index()
    {
        return view('contact_import.index');
    }

    public function store(Request $request)
    {
        $path = $request->file('upload')->store();

        $contactImport = ContactImport::forceCreate([
            'file_path' => $path
        ]);

        return redirect()->route('contact_import.show', $contactImport);
    }

    public function show(Request $request, FieldService $fieldService, ContactImport $contactImport)
    {
        $import = SimpleExcelReader::create(\Storage::path($contactImport->file_path));

        $rows = $import->take(5)
            ->getRows()
            ->toArray();

        return view('contact_import.show', [
            'contactImport' => $contactImport,
            'headers' => $import->getHeaders(),
            'rows' => $rows,
            'fields' => $fieldService->getFields(ViewType::CONTACT)
        ]);
    }

    public function update(Request $request, ContactImport $contactImport)
    {
        $validated = $request->validate([
            'skip_header' => ['sometimes', Rule::in([1])],
            'map' => ['required', 'array'],
            'map.*' => ['required', 'string']
        ]);

        $contactImport->started_at = now();
        $contactImport->save();

        ProcessContactImport::dispatch(
            $request->user(),
            $contactImport, $request->has('skip_header'),
            $validated['map']
        );

        return redirect()->route('contact_import.index');
    }
}

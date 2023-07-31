<?php

namespace App\Http\Controllers;

use App\Models\ContactExport;
use App\Models\ContactImport;
use Illuminate\Contracts\View\View;

class ProcessesController extends Controller
{
    public function index(): View
    {
        return view('processes.index', [
            'contactImports' => ContactImport::all(),
            'contactExports' => ContactExport::all(),
        ]);
    }
}

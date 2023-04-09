<?php

namespace App\Http\Controllers;

use App\Models\InvoiceOption;
use App\Support\Flash;
use Illuminate\Http\Request;

class InvoiceOptionController extends Controller
{
    public function index()
    {
        return view('invoice_options.index', [
            'invoiceOptions' => InvoiceOption::all()
        ]);
    }

    public function show(InvoiceOption $invoiceOption)
    {
        return $invoiceOption;
    }

    public function create()
    {
        Flash::created(InvoiceOption::first());

        return redirect()->route('invoice_options.index');
    }
}

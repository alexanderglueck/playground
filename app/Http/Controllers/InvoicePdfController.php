<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

class InvoicePdfController extends Controller
{
    public function show(Invoice $invoice)
    {
        $invoice->loadMissing(['invoiceItems', 'invoiceOption']);

        return $invoice->toPdf()->inline($invoice->number);
    }

    public function store(Invoice $invoice)
    {
        $invoice->loadMissing(['invoiceItems', 'invoiceOption']);

        return $invoice->toPdf()->download($invoice->number);
    }
}

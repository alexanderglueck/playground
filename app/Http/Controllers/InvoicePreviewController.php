<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicePreviewController extends Controller
{
    public function show(Request $request)
    {
        $validated = $request->validate([
            // TODO Add invoice field validation
        ]);

        $invoice = new Invoice($validated);
        $invoice->loadMissing(['invoiceItems', 'invoiceOption']);

        return $invoice->toPdf()->inline($invoice->number);
    }
}

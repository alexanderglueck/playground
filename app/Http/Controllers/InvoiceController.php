<?php

namespace App\Http\Controllers;

use App\Actions\Invoice\CreateInvoiceAction;
use App\Models\Invoice;
use App\Models\InvoiceOption;
use App\Support\Flash;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice.index', [
            'invoices' => Invoice::with('invoiceItems')->get()
        ]);
    }

    public function show(Invoice $invoice)
    {
        $invoice->loadMissing(['invoiceItems', 'invoiceOption']);

//        return [
//            $invoice,
//            $invoice->sumGross(),
//            $invoice->sum(),
//            $invoice->share()
//        ];

        return view('invoice.show', [
            'invoice' => $invoice
        ]);
    }

    public function store(CreateInvoiceAction $createInvoiceAction)
    {
        // TODO Pass data (InvoiceDTO)
        $invoice = $createInvoiceAction->perform();

        Flash::created($invoice);

        return redirect()->route('invoices.index');
    }

    public function credit(Invoice $invoice)
    {
        // TODO Remove hardcoded invoice option id
        $credit = $invoice->credit(InvoiceOption::find(2));

        Flash::created($credit);

        return redirect()->route('invoices.index');
    }
}

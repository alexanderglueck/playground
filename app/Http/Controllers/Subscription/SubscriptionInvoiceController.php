<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Stancl\Tenancy\Contracts\Tenant;

class SubscriptionInvoiceController extends Controller
{
    public function index(Tenant $tenant)
    {
        return view('subscription.invoice.index', [
            'invoices' => $tenant->invoices()
        ]);
    }

    public function show(Tenant $tenant, $invoice)
    {
        return $tenant->downloadInvoice($invoice, [
            'vendor' => config('app.name'),
            'product' => config('app.name') . ' membership',
        ]);
    }
}

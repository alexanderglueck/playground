<?php

namespace App\Actions\Invoice;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\InvoiceOption;

class CreditInvoiceAction
{
    public function perform(Invoice $invoice, InvoiceOption $invoiceOption): Invoice
    {
        return \DB::transaction(function () use ($invoice, $invoiceOption) {
            $credit = $invoice->replicate();

            // Reset number
            $credit->number = null;
            // Change invoice option
            $credit->invoice_option_id = $invoiceOption->id;
            $credit->save();

            /** @var InvoiceItem $invoiceItem */
            foreach ($invoice->invoiceItems as $invoiceItem) {
                /** @var InvoiceItem $creditItem */
                $creditItem = $invoiceItem->replicate();
                $creditItem->invoice_id = $credit->id;
                $creditItem->price_per_unit *= -1;

                $credit->invoiceItems()->save($creditItem);
            }

            return $credit;
        });
    }
}

<?php

namespace App\Actions\Invoice;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class CreateInvoiceAction
{
    // TODO Accept data (Replace hardcoded data)
    public function perform(): Invoice
    {
        return DB::transaction(function () {
            $invoice = new Invoice();
            $invoice->invoice_option_id = 1;
            $invoice->save();

            $items = [
                [
                    'description' => 'Hamburger',
                    'quantity' => 2,
                    'price_per_unit' => 1099,
                    'tax' => 10
                ],
                [
                    'description' => 'Drink',
                    'quantity' => 1,
                    'price_per_unit' => 399,
                    'tax' => 13
                ],
            ];

            foreach ($items as $item) {
                $invoice->invoiceItems()->create($item);
            }

            return $invoice;
        });
    }
}

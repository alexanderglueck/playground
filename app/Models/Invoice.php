<?php

namespace App\Models;

use App\Actions\Invoice\CreditInvoiceAction;
use App\Support\CanBeFlashed;
use App\Support\CanBeShared;
use App\Support\Flashable;
use App\Support\Shareable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use WeasyPrint\Objects\Output;

class Invoice extends Model implements Flashable, Shareable
{
    use HasFactory, CanBeFlashed, CanBeShared;

    public function sumGross()
    {
        return $this->invoiceItems()->sum(DB::raw('quantity * price_per_unit * (1 + (tax / 100))'));
    }

    public function sum()
    {
        return $this->invoiceItems()->sum(DB::raw('quantity * price_per_unit'));
    }

    public function getFlashName(): string
    {
        return $this->number;
    }

    public function credit(InvoiceOption $invoiceOption): Invoice
    {
        $action = app(CreditInvoiceAction::class);
        return $action->perform($this, $invoiceOption);
    }

    public function invoiceOption(): BelongsTo
    {
        return $this->belongsTo(InvoiceOption::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function nextInvoiceNumber(): string
    {
        /** @var InvoiceOption $invoiceOption */
        $invoiceOption = $this->invoiceOption;

        $lastNumber = $invoiceOption->last_number;
        $numberFormat = $invoiceOption->number_format;

        $i = 1;

        do {
            $number = Str::replace('##NUMBER##', $lastNumber + $i, $numberFormat);
            $i++;
        } while (Invoice::query()->where('number', '=', $number)->exists());

        $invoiceOption->increment('last_number', $i - 1);

        return $number;
    }

    public function toPdf(): Output
    {
        $source = Blade::render('invoice.pdf', [
            'invoice' => $this
        ]);

        $service = \WeasyPrint\Service::new(binary: '/python/venv/bin/weasyprint')->prepareSource($source);

        return $service->build();
    }

    protected static function booted(): void
    {
        self::creating(function (Invoice $invoice) {
            if (isset($invoice->number)) {
                return;
            }

            $invoice->number = $invoice->nextInvoiceNumber();
        });
    }
}

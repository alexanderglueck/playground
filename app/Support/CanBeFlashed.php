<?php

namespace App\Support;

use Illuminate\Support\Str;

trait CanBeFlashed
{
    public function getFlashType(): string
    {
        // InvoiceOption => Invoice Option => invoice option => Invoice option (German: Rechnungskreis)
        return __(class_basename(self::class));
    }

    public function getFlashName(): string
    {
        return $this->name;
    }

    public function hasShowRoute(): bool
    {
        return true;
    }

    public function getShowRoute(): string
    {
        // InvoiceOption => InvoiceOptions => invoice_options
        $key = Str::snake(Str::pluralStudly(class_basename(self::class)));

        return $this->hasShowRoute()
            ? route($key . '.show', $this)
            : '/';
    }
}

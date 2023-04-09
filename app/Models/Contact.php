<?php

namespace App\Models;

use App\Support\CanBeFlashed;
use App\Support\CustomContact;
use App\Support\CustomFielded;
use App\Support\Flashable;
use App\Support\HasCustomFields;
use App\Support\ViewType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model implements CustomFielded, Flashable
{
    use HasFactory, HasCustomFields, CanBeFlashed;

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function getViewType(): ViewType
    {
        return ViewType::CONTACT;
    }

    public function getCustomFieldClass(): string
    {
        return CustomContact::class;
    }
}

<?php

namespace App\Models;

use App\Support\CustomCustomer;
use App\Support\CustomFielded;
use App\Support\HasCustomFields;
use App\Support\ViewType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model implements CustomFielded
{
    use HasFactory, HasCustomFields;

    public function getViewType(): ViewType
    {
        return ViewType::CUSTOMER;
    }

    public function getCustomFieldClass(): string
    {
        return CustomCustomer::class;
    }
}

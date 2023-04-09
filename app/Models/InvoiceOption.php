<?php

namespace App\Models;

use App\Support\CanBeFlashed;
use App\Support\Flashable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceOption extends Model implements Flashable
{
    use HasFactory, CanBeFlashed;
}

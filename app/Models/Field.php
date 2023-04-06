<?php

namespace App\Models;

use App\Support\ViewType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $casts = [
        'view_type' => ViewType::class
    ];

    public function isCustomField(): bool
    {
        return $this->is_custom === 1;
    }
}

<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomFieldModel extends Model
{
    public function getTable(): string
    {
        return Str::snake(class_basename($this));
    }
}

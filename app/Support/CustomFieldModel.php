<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomFieldModel extends Model
{
    public static string $customTableKey = 'entity_id';
    public $timestamps = false;
}

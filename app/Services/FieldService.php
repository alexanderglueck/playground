<?php

namespace App\Services;

use App\Models\Field;
use App\Support\ViewType;
use Illuminate\Support\Collection;

class FieldService
{
    public function getFields(ViewType $viewType = null): Collection
    {
        return Field::query()
            ->whereNotIn('field_type', ['section'])
            ->where('view_type', '=', $viewType)->get();
    }
}

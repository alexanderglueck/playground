<?php

namespace App\Models;

use App\Data\CustomFieldData;
use App\Support\CustomFielded;
use App\Support\ViewType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $casts = [
        'view_type' => ViewType::class
    ];

    protected $fillable = [
        'name',
        'field_type'
    ];

    public function isCustomField(): bool
    {
        return $this->is_custom === 1;
    }

    public function hasCustomValueGetter(): bool
    {
        return match ($this->field_type) {
            'contact_group' => true,
            default => false
        };
    }

    public function getValue(CustomFielded $model)
    {
        return match ($this->field_type) {
            'contact_group' => $this->getContactGroupValue($model),
            default => false
        };
    }

    private function getContactGroupValue(CustomFielded $model): Collection
    {
        return $model->contactGroups;
    }
}

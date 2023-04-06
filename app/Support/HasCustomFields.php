<?php

namespace App\Support;

use App\Models\Field;
use App\Models\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasCustomFields
{
    public static string $customTableKey = 'entity_id';

    public function fieldValue(Field $field)
    {
        if ( ! $field->isCustomField()) {
            return $this->{$field->column};
        }

        $this->loadMissing('customFields');

        return $this->customFields->{$field->column};
    }

    public function view(): BelongsTo
    {
        return $this->belongsTo(View::class);
    }

    public function viewId(): Attribute
    {
        return Attribute::make(
            get: fn(?int $value) => $value ?? View::getDefaultViewId($this->getViewType()),
            set: fn(?int $value) => $value,
        );
    }

    public function customFields(): HasOne
    {
        return $this->hasOne($this->getCustomFieldClass(), self::$customTableKey);
    }

    public function scopeWithFields(Builder $builder): void
    {
        $builder->with(['customFields', 'view.fields']);
    }

    public function fields(): Collection
    {
        return $this->view->fields->map(function (Field $field) {
            $field->value = $this->fieldValue($field);
            return $field;
        });
    }
}

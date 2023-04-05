<?php

namespace App\Support;

use App\Models\Field;
use App\Models\View;
use Illuminate\Database\Eloquent\Collection;

trait HasCustomFields
{
    public static string $customTableKey = 'entity_id';

    public function fields(): Collection
    {
        return View::fields($this);
    }

    public function getViewId(): ?int
    {
        return $this->view_id;
    }

    public function fieldValue(Field $field)
    {
        return $this->{$field->column};
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new CustomFieldScope);
    }
}

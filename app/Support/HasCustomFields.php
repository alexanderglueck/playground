<?php

namespace App\Support;

use App\Models\Field;
use App\Models\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        if (!$field->isCustomField()) {
            return $this->{$field->column};
        }

        $this->loadMissing('customFields');

        return $this->customFields->{$field->column};
    }

    public function customFields(): HasOne
    {
        return $this->hasOne($this->getCustomFieldClass(), self::$customTableKey);
    }
}

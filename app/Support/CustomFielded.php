<?php

namespace App\Support;

use App\Models\Field;
use Illuminate\Database\Eloquent\Relations\HasOne;

interface CustomFielded
{
    public function getViewType(): ViewType;

    public function getViewId(): ?int;

    public function fieldValue(Field $field);

    public function getCustomFieldClass(): string;

    public function customFields(): HasOne;
}

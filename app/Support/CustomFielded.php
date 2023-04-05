<?php

namespace App\Support;

use App\Models\Field;

interface CustomFielded
{
    public function getViewType(): ViewType;

    public function getViewId(): ?int;

    public function fieldValue(Field $field);
}

<?php

namespace App\Support;

use App\Models\Field;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

interface CustomFielded
{
    public static function getViewType(): ViewType;

    public function fieldValue(Field $field);

    public function getCustomFieldClass(): string;

    public function customFields(): HasOne;

    public function viewId(): Attribute;

    public function view(): BelongsTo;

    public function fields(): Collection;
}

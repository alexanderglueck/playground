<?php

namespace App\Data;

class CustomFieldData
{
    public function __construct(
        public readonly string $name,
        public readonly string $fieldType
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'field_type' => $this->fieldType,
        ];
    }
}

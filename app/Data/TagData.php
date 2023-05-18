<?php

namespace App\Data;

class TagData
{
    public function __construct(
        public readonly string $name,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name
        ];
    }
}

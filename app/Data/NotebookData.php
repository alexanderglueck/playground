<?php

namespace App\Data;

class NotebookData
{
    public function __construct(
        public readonly string $name,
        public readonly bool   $isFavorite,
        public readonly bool   $isPrivate,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'is_favorite' => $this->isFavorite,
            'is_private' => $this->isPrivate,
        ];
    }
}

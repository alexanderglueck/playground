<?php

namespace App\Data;

class NoteData
{
    public function __construct(
        public readonly string $name,
        public readonly string $content,
        public readonly int    $notebookId,
        public readonly bool   $isFavorite,
        public readonly array  $tags
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'content' => $this->content,
            'notebook_id' => $this->notebookId,
            'is_favorite' => $this->isFavorite,
            'tags' => $this->tags
        ];
    }
}

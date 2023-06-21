<?php

namespace App\Data;

class CommentData
{
    public function __construct(
        public readonly ?string $comment,
        public readonly ?int    $parentId,
        public readonly ?int    $contactId
    )
    {
    }

    public function toArray(): array
    {
        return [
            'comment' => $this->comment,
            'parent_id' => $this->parentId,
            'contact_id' => $this->contactId,
        ];
    }
}

<?php

namespace App\Services;

use App\Data\TagData;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Collection;
use RuntimeException;

class TagService
{
    public function getTags(): Collection
    {
        return Tag::all();
    }

    public function createTag(User $user, TagData $data): Tag
    {
        $tag = new Tag();
        $tag->fill($data->toArray());
        $tag->user_id = $user->id;

        if ( ! $tag->save()) {
            throw new RuntimeException(__('Could not create tag'));
        }

        return $tag;
    }

    public function updateTag(Tag $tag, TagData $data): Tag
    {
        $tag->fill($data->toArray());

        if ( ! $tag->save()) {
            throw new RuntimeException(__('Could not update tag'));
        }

        return $tag;
    }
}

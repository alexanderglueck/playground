<?php

namespace App\Support;

use App\Models\ShareableLink;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Ramsey\Uuid\Uuid;

trait CanBeShared
{
    public function share(): string
    {
        $uuid = Uuid::uuid4()->getHex();

        $link = new ShareableLink([
            'active' => true,
            'uuid' => $uuid,
            'url' => route('shared.show', ['shareable_link' => $uuid])
        ]);

        return $this->shareableLinks()->save($link)->url;
    }

    public function shareableLinks(): MorphMany
    {
        return $this->morphMany(ShareableLink::class, 'shareable');
    }
}

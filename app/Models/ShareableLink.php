<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ShareableLink extends Model
{
    protected $fillable = [
        'active',
        'url',
        'uuid',
    ];

    protected $casts = [
        'active' => 'bool',
    ];

    public function shareable(): MorphTo
    {
        return $this->morphTo();
    }

    public function isActive(): bool
    {
        return (bool) $this->active;
    }
}

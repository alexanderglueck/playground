<?php

namespace App\Models;

use App\Models\Scopes\LimitNotesScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    protected $fillable = [
        'name',
        'content',
        'is_favorite'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new LimitNotesScope());
    }

    public function notebook(): BelongsTo
    {
        return $this->belongsTo(Notebook::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}

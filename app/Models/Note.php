<?php

namespace App\Models;

use App\Models\Scopes\LimitNotesScope;
use App\Support\CanBeFlashed;
use App\Support\Flashable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model implements Flashable
{
    use CanBeFlashed;

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

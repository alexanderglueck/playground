<?php

namespace App\Models;

use App\Models\Scopes\LimitNotebooksScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notebook extends Model
{
    protected $fillable = [
        'name',
        'is_favorite'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new LimitNotebooksScope());
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

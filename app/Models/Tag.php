<?php

namespace App\Models;

use App\Models\Scopes\LimitTagsScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new LimitTagsScope());
    }

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class);
    }

    public function pill(): string
    {
        $pills = [
            'primary', 'secondary', 'success', 'danger', 'warning', 'info'
        ];

        $sum = 0;
        for ($pos = 0; $pos < strlen($this->name); $pos++) {
            $byte = substr($this->name, $pos);
            $sum += ord($byte);
        }

        return $pills[$sum % count($pills)];
    }
}

<?php

namespace App\Models;

use App\Models\Scopes\LimitContactGroupsScope;
use App\Support\CanBeFlashed;
use App\Support\Flashable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ContactGroup extends Model implements Flashable
{
    use HasFactory, CanBeFlashed;

    protected $fillable = [
        'name'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new LimitContactGroupsScope());
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class)
            ->withTimestamps();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }
}

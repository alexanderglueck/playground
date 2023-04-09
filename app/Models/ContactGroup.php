<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ContactGroup extends Model
{
    use HasFactory;

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class)
            ->withTimestamps();
    }
}

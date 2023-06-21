<?php

namespace App\Models;

use App\Collections\CommentCollection;
use App\Support\CanBeFlashed;
use App\Support\Flashable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model implements Flashable
{
    use HasFactory, CanBeFlashed;

    protected $fillable = [
        'comment',
        'parent_id',
        'created_at',
        'updated_at',
        'contact_id'
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function newCollection(array $models = []): CommentCollection
    {
        return new CommentCollection($models);
    }

    public function hasShowRoute(): bool
    {
        return false;
    }

    public function getFlashName(): string
    {
        return '';
    }
}

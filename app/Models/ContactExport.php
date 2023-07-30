<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactExport extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'contact_group_id',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    public function contactGroup(): BelongsTo
    {
        return $this->belongsTo(ContactGroup::class);
    }
}

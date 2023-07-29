<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactImport extends Model
{
    use HasFactory;

    protected $fillable = [
        'started_at',
        'completed_at',
        'file_path'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];
}

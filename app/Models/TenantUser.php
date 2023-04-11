<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantUser extends Model
{
    use HasFactory;

    protected $connection = 'system';

    protected $table = 'tenant_user';

    protected $fillable = [
        'tenant', 'email'
    ];
}

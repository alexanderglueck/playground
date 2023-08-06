<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $connection = 'system';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gateway_id',
        'price',
        'slug'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean'
    ];

    public function scopeActive(Builder $builder)
    {
        return $builder->where('active', true);
    }

    public function scopeExcept(Builder $builder, $id)
    {
        return $builder->where('gateway_id', '!=', $id);
    }
}

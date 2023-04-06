<?php

namespace App\Models;

use App\Support\ViewType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class View extends Model
{
    use HasFactory;

    private static array $memoizedDefaultViewIds = [];
    private static array $memoizedFields = [];

    protected $casts = [
        'view_type' => ViewType::class
    ];

    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Field::class, 'field_view')
            ->withPivot([
                'row',
                'column'
            ])
            ->withTimestamps();
    }

    public static function getDefaultViewId(ViewType $viewType): int
    {
        return self::$memoizedDefaultViewIds[$viewType->value] ??= View::query()
            ->where('view_type', $viewType)
            ->where('is_default', '=', true)
            ->first()
            ->id;
    }
}

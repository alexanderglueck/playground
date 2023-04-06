<?php

namespace App\Models;

use App\Support\CustomFielded;
use App\Support\ViewType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    private static array $memoizedDefaultViewIds = [];
    private static array $memoizedFields = [];

    protected $casts = [
        'view_type' => ViewType::class
    ];

    public static function getDefaultViewId(ViewType $viewType): int
    {
        return self::$memoizedDefaultViewIds[$viewType->value] ??= View::query()
            ->where('view_type', $viewType)
            ->where('is_default', '=', true)
            ->first()
            ->id;
    }

    public static function fields(CustomFielded $customFielded): Collection
    {
        return self::$memoizedDefaultViewIds[$customFielded->view_id] ??= Field::query()
            ->select('fields.*')
            ->join('field_view', 'field_view.field_id', '=', 'fields.id')
            ->where('field_view.view_id', '=', $customFielded->view_id)
            ->get();
    }
}
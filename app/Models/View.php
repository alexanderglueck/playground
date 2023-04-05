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

    public static function getDefaultViewId(ViewType $viewType): int
    {
        return View::query()
            ->where('view_type', $viewType->value)
            ->where('is_default', '=', true)
            ->first()
            ->id;
    }

    public static function fields(CustomFielded $customFielded): Collection
    {
        $viewId = $customFielded->getViewId() ?? View::getDefaultViewId($customFielded->getViewType());

        return Field::query()
            ->select('fields.*')
            ->join('field_view', 'field_view.field_id', '=', 'fields.id')
            ->where('field_view.view_id', '=', $viewId)
            ->get();
    }
}

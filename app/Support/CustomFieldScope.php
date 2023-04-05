<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CustomFieldScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        /** @var Model|CustomFielded $model */

        $customTable = 'custom_' . $model->getViewType()->value;

        $builder->join(
            $customTable,
            $customTable . '.' . $model::$customTableKey,
            '=',
            $model->getTable() . '.' . $model->getKeyName()
        );
    }
}

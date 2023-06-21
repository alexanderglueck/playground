<?php

namespace App\Support;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class Layout
{
    public static function render(CustomFielded $model, LayoutMode $layoutMode): Htmlable
    {
        $fields = $model->fields()->groupBy('pivot.row')->sortKeys();

        $rows = [];

        foreach ($fields as $row) {
            $cols = [];
            foreach ($row->sortBy('pivot.column') as $field) {
                $cols[] = $field->render($layoutMode);
            }

            $rows[] = $cols;
        }

        return new HtmlString(Blade::render('support.layout', [
            'fields' => $rows
        ]));
    }
}

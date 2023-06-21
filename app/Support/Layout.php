<?php

namespace App\Support;

use App\Support\InputTypes\ContactGroup;
use App\Support\InputTypes\Country;
use App\Support\InputTypes\Date;
use App\Support\InputTypes\Email;
use App\Support\InputTypes\InputType;
use App\Support\InputTypes\Phone;
use App\Support\InputTypes\Section;
use App\Support\InputTypes\Text;
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
                $class = match ($field->field_type) {
                    'text' => new Text($field),
                    'date' => new Date($field),
                    'country' => new Country($field),
                    'phone' => new Phone($field),
                    'email' => new Email($field),
                    'section' => new Section($field),
                    'contact_group' => new ContactGroup($field),
                    default => new InputType($field)
                };

                $cols[] = $class->toHtmlElement($layoutMode);
            }

            $rows[] = $cols;
        }

        return new HtmlString(Blade::render('support.layout', [
            'fields' => $rows
        ]));
    }
}

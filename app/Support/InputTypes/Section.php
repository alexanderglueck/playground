<?php

namespace App\Support\InputTypes;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class Section extends InputType
{
    public function toHtmlElement(): HtmlString
    {
        return new HtmlString(Blade::render('support.input_types.section', [
            'value' => $this->field->pivot->text,
        ]));
    }
}

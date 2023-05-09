<?php

namespace App\Support\InputTypes;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class Date extends InputType
{
    public function toHtmlElement(): HtmlString
    {
        return new HtmlString(Blade::render('support.input_types.date', [
            'randomId' => $this->getRandomId(),
            'label' => $this->getNameForLabel(),
            'name' => $this->field->name,
            'value' => $this->field->value
        ]));
    }
}

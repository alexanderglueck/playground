<?php

namespace App\Support\InputTypes;

use App\Support\LayoutMode;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class Email extends InputType
{
    public function toHtmlElement(LayoutMode $layoutMode): HtmlString
    {
        return new HtmlString(Blade::render('support.input_types.email', [
            'randomId' => $this->getRandomId(),
            'label' => $this->getNameForLabel(),
            'name' => $this->field->isCustomField() ? $this->field->column : $this->field->name,
            'value' => $this->field->value,
            'layoutMode' => $layoutMode
        ]));
    }
}

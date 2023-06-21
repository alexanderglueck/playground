<?php

namespace App\Support\InputTypes;

use App\Support\LayoutMode;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class Section extends InputType
{
    public function toHtmlElement(LayoutMode $layoutMode): HtmlString
    {
        return new HtmlString(Blade::render('support.input_types.section', [
            'value' => $this->field->pivot->text,
        ]));
    }
}

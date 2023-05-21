<?php

namespace App\Support\InputTypes;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class Country extends InputType
{
    public function toHtmlElement(): HtmlString
    {
        $countries = \App\Models\Country::pluck('code');

        return new HtmlString(Blade::render('support.input_types.country', [
            'randomId' => $this->getRandomId(),
            'label' => $this->getNameForLabel(),
            'name' => $this->field->name,
            'value' => $this->field->value,
            'countries' => $countries
        ]));
    }
}

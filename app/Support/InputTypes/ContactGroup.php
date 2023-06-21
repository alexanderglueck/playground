<?php

namespace App\Support\InputTypes;

use App\Support\LayoutMode;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class ContactGroup extends InputType
{
    public function toHtmlElement(LayoutMode $layoutMode): HtmlString
    {
        $contactGroups = \App\Models\ContactGroup::all('id', 'name');

        return new HtmlString(Blade::render('support.input_types.contact_group', [
            'randomId' => $this->getRandomId(),
            'label' => $this->getNameForLabel(),
            'name' => $this->field->isCustomField() ? $this->field->column : $this->field->name,
            'value' => $this->field->value,
            'contactGroups' => $contactGroups,
            'layoutMode' => $layoutMode
        ]));
    }
}

<?php

namespace App\Support\InputTypes;

use App\Models\Field;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class InputType
{
    private string $randomId;

    public function __construct(protected readonly Field $field)
    {
        $this->randomId = Str::random(10);
    }

    public function toHtmlElement(): HtmlString
    {
        return new HtmlString($this->getNameForLabel() . ':' . e($this->field->value));
    }

    public function getNameForLabel(): string
    {
        return __('fields')[$this->field->name] ?? $this->field->name;
    }

    public function getRandomId(): string
    {
        return $this->randomId;
    }
}

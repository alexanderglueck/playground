<?php

namespace App\Models;

use App\Data\CustomFieldData;
use App\Support\CustomFielded;
use App\Support\InputTypes\ContactGroup;
use App\Support\InputTypes\Country;
use App\Support\InputTypes\Date;
use App\Support\InputTypes\Email;
use App\Support\InputTypes\InputType;
use App\Support\InputTypes\Phone;
use App\Support\InputTypes\Section;
use App\Support\InputTypes\Text;
use App\Support\LayoutMode;
use App\Support\ViewType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class Field extends Model
{
    use HasFactory;

    protected $casts = [
        'view_type' => ViewType::class
    ];

    protected $fillable = [
        'name',
        'field_type'
    ];

    public function isCustomField(): bool
    {
        return $this->is_custom === 1;
    }

    public function hasCustomValueGetter(): bool
    {
        return match ($this->field_type) {
            'contact_group' => true,
            default => false
        };
    }

    public function getValue(CustomFielded $model)
    {
        return match ($this->field_type) {
            'contact_group' => $this->getContactGroupValue($model),
            default => false
        };
    }

    public function getNameForLabel(): string
    {
        return __('fields')[$this->name] ?? $this->name;
    }

    public function render(LayoutMode $layoutMode): HtmlString
    {
        $class = match ($this->field_type) {
            'text' => new Text($this),
            'date' => new Date($this),
            'country' => new Country($this),
            'phone' => new Phone($this),
            'email' => new Email($this),
            'section' => new Section($this),
            'contact_group' => new ContactGroup($this),
            default => new InputType($this)
        };

        return $class->toHtmlElement($layoutMode);
    }

    private function getContactGroupValue(CustomFielded $model): Collection
    {
        return $model->contactGroups;
    }
}

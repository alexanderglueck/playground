<?php

namespace App\Services;

use App\Models\ContactGroup;
use App\Models\Country;
use App\Models\View;
use App\Support\ViewType;
use Illuminate\Validation\Rule;

class ViewValidationService
{
    public function getRules(ViewType $viewType, ?int $viewId): array
    {
        $view = View::findOrFail(
            $viewId ?: View::getDefaultViewId($viewType)
        );

        if ($view->view_type !== $viewType) {
            throw new \RuntimeException("View types don't match");
        }

        // If a viewId was provided, validate it to make sure
        // the view is stored when creating an entity.
        // If no viewId was provided, the default view should be applied.
        $fields = $viewId
            ? ['view' => ['nullable']]
            : [];

        foreach ($view->fields as $field) {
            $fields[$field->isCustomField() ? $field->column : $field->name] = match ($field->field_type) {
                'text' => ['nullable', 'max:255'],
                'date' => ['nullable', 'date'],
                'country' => ['nullable', Rule::exists(Country::class, 'code')],
                'phone' => ['nullable', 'max:255'],
                'contact_group' => ['nullable', 'array', Rule::exists(ContactGroup::class, 'id')],
                'email' => ['nullable', 'email', 'max:255'],
                'section' => null,
                default => throw new \RuntimeException('Unexpected type received')
            };
        }

        return array_filter($fields);
    }
}

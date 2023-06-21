<?php

namespace App\Http\Requests;

use App\Data\CustomFieldData;
use App\Support\ViewType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CustomFieldRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'field_type' => ['required'],
        ];
    }

    public function toData(): CustomFieldData
    {
        $validated = $this->validated();

        return new CustomFieldData(
            name: $validated['name'],
            fieldType: $validated['field_type']
        );
    }
}

<?php

namespace App\Http\Requests;

use App\Data\ContactGroupData;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactGroupRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
        ];
    }

    public function toData(): ContactGroupData
    {
        $validated = $this->validated();

        return new ContactGroupData(
            name: $validated['name'],
        );
    }
}

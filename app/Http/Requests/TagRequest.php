<?php

namespace App\Http\Requests;

use App\Data\TagData;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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

    public function toData(): TagData
    {
        $validated = $this->validated();

        return new TagData(
            name: $validated['name']
        );
    }
}

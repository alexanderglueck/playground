<?php

namespace App\Http\Requests;

use App\Data\NotebookData;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class NotebookRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'is_favorite' => ['nullable', 'integer'],
            'is_private' => ['nullable', 'integer'],
        ];
    }

    public function toData(): NotebookData
    {
        $validated = $this->validated();

        return new NotebookData(
            name: $validated['name'],
            isFavorite: isset($validated['is_favorite']),
            isPrivate: isset($validated['is_private'])
        );
    }
}

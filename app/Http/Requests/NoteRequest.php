<?php

namespace App\Http\Requests;

use App\Data\NotebookData;
use App\Data\NoteData;
use App\Models\Notebook;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NoteRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'content' => ['required'],
            'notebook' => ['required', Rule::exists(Notebook::class, 'id')],
            'tags' => ['nullable', 'array']
        ];
    }

    public function toData(): NoteData
    {
        $validated = $this->validated();

        return new NoteData(
            name: $validated['name'],
            content: $validated['content'],
            notebookId: $validated['notebook'],
            isFavorite: isset($validated['is_favorite']),
            tags: $this->has('tags') ? $validated['tags'] : []
        );
    }
}

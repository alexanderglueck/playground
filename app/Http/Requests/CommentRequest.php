<?php

namespace App\Http\Requests;

use App\Data\CommentData;
use App\Models\Comment;
use App\Models\Contact;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'comment' => ['required'],
            'parent_id' => ['sometimes', Rule::exists(Comment::class, 'id')],
            'contact_id' => ['sometimes', Rule::exists(Contact::class, 'id')]
        ];
    }

    public function toData(): CommentData
    {
        $validated = $this->validated();

        return new CommentData(
            comment: $validated['comment'] ?? null,
            parentId: $validated['parent_id'] ?? null,
            contactId: $validated['contact_id'] ?? null,
        );
    }
}

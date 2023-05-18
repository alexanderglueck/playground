<?php

namespace App\Services;

use App\Data\NoteData;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Collection;
use RuntimeException;

class NoteService
{
    public function getNotes(): Collection
    {
        return Note::all();
    }

    public function createNote(User $user, NoteData $data): Note
    {
        $fill = $data->toArray();
        // TODO Refactor to cleaner style
        unset($fill['tags'], $fill['notebook_id']);

        $note = new Note();
        $note->fill($fill);
        $note->notebook_id = $data->notebookId;
        $note->user_id = $user->id;

        if ( ! $note->save()) {
            throw new RuntimeException(__('Could not create note'));
        }

        $note->tags()->sync($data->tags);

        return $note;
    }

    public function updateNote(Note $note, NoteData $data): Note
    {
        $fill = $data->toArray();
        unset($fill['notebook_id'], $fill['tags']);

        $note->fill($fill);
        $note->notebook_id = $data->notebookId;

        if ( ! $note->save()) {
            throw new RuntimeException('Could not update note');
        }

        $note->tags()->sync($data->tags);

        return $note;
    }
}

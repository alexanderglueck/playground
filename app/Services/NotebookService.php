<?php

namespace App\Services;

use App\Data\NotebookData;
use App\Models\Notebook;
use App\Models\User;
use Illuminate\Support\Collection;
use RuntimeException;

class NotebookService
{
    public function getNotebooks(): Collection
    {
        return Notebook::all();
    }

    public function createNotebook(User $user, NotebookData $data): Notebook
    {
        $notebook = new Notebook();
        $notebook->fill($data->toArray());
        $notebook->user_id = $user->id;

        if ( ! $notebook->save()) {
            throw new RuntimeException(__('Could not create notebook'));
        }

        return $notebook;
    }

    public function updateNotebook(Notebook $notebook, NotebookData $notebookData): Notebook
    {
        $notebook->fill($notebookData->toArray());

        if ( ! $notebook->save()) {
            throw new RuntimeException(__('Could not update notebook'));
        }

        return $notebook;
    }
}

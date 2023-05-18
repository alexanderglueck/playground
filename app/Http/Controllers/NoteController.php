<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Services\NotebookService;
use App\Services\NoteService;
use App\Services\TagService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RuntimeException;

class NoteController extends Controller
{
    public function __construct(
        private readonly NoteService     $noteService,
        private readonly NotebookService $notebookService,
        private readonly TagService      $tagService
    )
    {
    }

    public function index(): View
    {
        $this->authorize('viewAny', Note::class);

        return view('note.index', [
            'notes' => $this->noteService->getNotes(),
            'notebooks' => $this->notebookService->getNotebooks(),
            'tags' => $this->tagService->getTags()
        ]);
    }

    public function create(Request $request): View
    {
        $this->authorize('create', Note::class);

        return view('note.create', [
            'notebookPreselect' => $request->get('notebook'),
            'notebooks' => $this->notebookService->getNotebooks(),
            'tags' => $this->tagService->getTags()
        ]);
    }

    public function store(NoteRequest $request): RedirectResponse
    {
        $this->authorize('create', Note::class);

        try {
            $this->noteService->createNote($request->user(), $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        return redirect()->route('notes.index');
    }

    public function show(Note $note): View
    {
        $this->authorize('view', $note);

        return view('note.show', [
            "note" => $note
        ]);
    }

    public function edit(Note $note): View
    {
        $this->authorize('update', $note);

        $note->loadMissing('tags');

        return view('note.edit', [
            "note" => $note,
            'notebooks' => $this->notebookService->getNotebooks(),
            'tags' => $this->tagService->getTags()
        ]);
    }

    public function update(NoteRequest $request, Note $note): RedirectResponse
    {
        $this->authorize('update', $note);

        try {
            $this->noteService->updateNote($note, $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        return redirect()->route('notes.show', [$note]);
    }

    public function destroy(Note $note): RedirectResponse
    {
        $this->authorize('delete', $note);

        if ( ! $note->delete()) {
            return redirect()->route('notes.show', [$note]);
        }
        return redirect()->route('notes.index');
    }
}

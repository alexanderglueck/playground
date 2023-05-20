<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotebookRequest;
use App\Models\Notebook;
use App\Services\NotebookService;
use App\Support\Flash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class NotebookController extends Controller
{
    public function __construct(private readonly NotebookService $notebookService)
    {
    }

    public function index(): View
    {
        $this->authorize('viewAny', Notebook::class);

        return view('notebook.index', [
            'notebooks' => $this->notebookService->getNotebooks()
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Notebook::class);

        return view('notebook.create');
    }

    public function store(NotebookRequest $request): RedirectResponse
    {
        $this->authorize('create', Notebook::class);

        try {
            $notebook = $this->notebookService->createNotebook($request->user(), $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        Flash::created($notebook);

        return redirect()->route('notebooks.index');
    }

    public function show(Notebook $notebook): View
    {
        $this->authorize('view', $notebook);

        return view('notebook.show', [
            "notebook" => $notebook
        ]);
    }

    public function edit(Notebook $notebook): View
    {
        $this->authorize('update', $notebook);

        return view('notebook.edit', [
            "notebook" => $notebook
        ]);
    }

    public function update(NotebookRequest $request, Notebook $notebook): RedirectResponse
    {
        $this->authorize('update', $notebook);

        try {
            $notebook = $this->notebookService->updateNotebook($notebook, $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        Flash::updated($notebook);

        return redirect()->route('notebooks.show', [$notebook]);
    }

    public function destroy(Notebook $notebook): RedirectResponse
    {
        $this->authorize('delete', $notebook);

        if ( ! $notebook->delete()) {
            return redirect()->route('notebooks.show', [$notebook]);
        }

        return redirect()->route('notebooks.index');
    }
}

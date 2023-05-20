<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use App\Services\TagService;
use App\Support\Flash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class TagController extends Controller
{
    public function __construct(private readonly TagService $tagService)
    {
    }

    public function index(): View
    {
        $this->authorize('viewAny', Tag::class);

        return view('tag.index', [
            'tags' => $this->tagService->getTags()
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Tag::class);

        return view('tag.create');
    }

    public function store(TagRequest $request): RedirectResponse
    {
        $this->authorize('create', Tag::class);

        try {
            $tag = $this->tagService->createTag($request->user(), $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        Flash::created($tag);

        return redirect()->route('tags.index');
    }

    public function show(Tag $tag): View
    {
        $this->authorize('view', $tag);

        return view('tag.show', [
            "tag" => $tag
        ]);
    }

    public function edit(Tag $tag): View
    {
        $this->authorize('update', $tag);

        return view('tag.edit', [
            'tag' => $tag
        ]);
    }

    public function update(TagRequest $request, Tag $tag): RedirectResponse
    {
        $this->authorize('update', $tag);

        try {
            $tag = $this->tagService->updateTag($tag, $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        Flash::updated($tag);

        return redirect()->route('tags.show', [$tag]);
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $this->authorize('delete', $tag);

        if ( ! $tag->delete()) {
            return redirect()->route('tags.show', [$tag]);
        }

        return redirect()->route('tags.index');
    }
}

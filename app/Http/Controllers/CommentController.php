<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use App\Support\Flash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RuntimeException;

class CommentController extends Controller
{
    public function __construct(private readonly CommentService $commentService)
    {
    }

    public function store(CommentRequest $request): RedirectResponse
    {
        $this->authorize('create', Comment::class);

        try {
            $comment = $this->commentService->createComment($request->user(), $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        Flash::created($comment);

        return redirect()->back();
    }

    public function edit(Request $request, Comment $comment): View
    {
        $this->authorize('update', $comment);

        return view('comment.edit', [
            'createButtonText' => __('Edit comment'),
            'comment' => $comment,
        ]);
    }

    public function update(CommentRequest $request, Comment $comment): RedirectResponse
    {
        $this->authorize('update', $comment);

        try {
            $comment = $this->commentService->updateComment($comment, $request->toData());
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        Flash::updated($comment);

        return redirect()->back();
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('dashboard');
    }
}

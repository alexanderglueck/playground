<?php

namespace App\Services;

use App\Data\CommentData;
use App\Models\Comment;
use App\Models\User;
use RuntimeException;

class CommentService
{
    public function createComment(User $user, CommentData $data): Comment
    {
        $comment = new Comment();
        $comment->fill($data->toArray());
        $comment->user_id = $user->id;

        if ( ! $comment->save()) {
            throw new RuntimeException(__('Could not create comment'));
        }

        return $comment;
    }

    public function updateComment(Comment $comment, CommentData $data): Comment
    {
        $comment->comment = $data->comment ?? '';

        if ( ! $comment->save()) {
            throw new RuntimeException(__('Could not update comment'));
        }

        return $comment;
    }
}

<li class="media">
    <div class="media-body">
        <strong class="mt-0">{{ $comment->user->name }}</strong>:

        <span class="float-right">
            <a href="{{ route('comments.edit', [$comment]) }}">
                {{ trans('Edit comment') }}
            </a>
        </span>
        <div class="clearfix"></div>

        {!! /* TODO Replace with Markdown */ nl2br(e($comment->comment)) !!}

        @include ('comment.create', ['parentId' => $comment->id])

        @if (isset($comments[$comment->id]))
            @include ('comment.list', ['collection' => $comments[$comment->id]])
        @endif
    </div>
</li>

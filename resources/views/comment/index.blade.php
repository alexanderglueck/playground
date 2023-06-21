<div class="card">
    <div class="card-header">
        {{ __('Comments') }}
    </div>
    <div class="card-body">
        @if (count($comments)>0)
            @include('comment.list', ['collection' => $comments['root']])
        @else
            <p>{{ __('No comments') }}</p>
        @endif

        @if (Auth::user()->hasPermissionTo('create-comments'))
            <hr>

            @include('comment.create')
        @endif
    </div>
</div>

<form class="form-horizontal" role="form" method="post" action="{{ route('comments.store') }}">
    @csrf

    @if (isset($parentId))
        <input name="parent_id" type="hidden" value="{{ $parentId }}"/>
        <label for="comment-{{ $parentId }}">{{ __('Comment') }}</label>
        <textarea id="comment-{{ $parentId }}" name="comment" class="form-control" rows="3">{{ old('comment', '') }}</textarea>

        @else
        <label for="comment">{{ __('Comment') }}</label>
        <textarea id="comment" name="comment" class="form-control" rows="3">{{ old('comment', '') }}</textarea>

    @endif

<input type="hidden" name="{{ $typeColumn }}" value="{{ $typeId }}" />

<div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Create comment') }}
            </button>
        </div>
    </div>
</form>

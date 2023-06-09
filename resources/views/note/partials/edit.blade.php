<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">
        {{ __('Name') }}
    </label>
    <input type="text" class="form-control" id="name" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $note->name) }}" >

    @error('name')
        <span class="help-block">
            <strong>{{ $message  }}</strong>
        </span>
    @enderror

</div>


<div class="form-group {{ $errors->has('notebook') ? ' has-error' : '' }}">
    <label for="notebook">
        {{ __('Notebook') }}
    </label>
    <select class="form-control" id="notebook" name="notebook">
        @foreach($notebooks as $notebook)
            <option {{ $notebook->id == old('notebook', $note->notebook_id) ? ' selected ' : '' }} value="{{ $notebook->id }}">{{ $notebook->name }}</option>
        @endforeach
    </select>

    @error('notebook')
        <span class="help-block">
            <strong>{{ $message  }}</strong>
        </span>
    @enderror
</div>

<div class="form-group {{ $errors->has('tags') ? ' has-error' : '' }}">
    <label for="tags">
        {{ __('Tags') }}
    </label>
    <select multiple class="form-control" id="tags" name="tags[]">
        @foreach($tags as $tag)
            <option {{ in_array($tag->id, old('tags', $note->tags->pluck('id')->toArray())) ? ' selected ' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>

    @error('tags')
        <span class="help-block">
            <strong>{{ $message  }}</strong>
        </span>
    @enderror
</div>


<div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
    <label for="content">
        {{ __('Content') }}
    </label>
    <textarea id="content" name="content" class="form-control editor" rows="3">{{ old('content', $note->content) }}</textarea>
    @error('content')
        <span class="help-block">
            <strong>{{ $message  }}</strong>
        </span>
    @enderror
</div>

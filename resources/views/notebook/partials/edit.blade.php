<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">
        {{ __('Name') }}
    </label>
    <input type="text" class="form-control" id="name" placeholder="{{ __('Name') }}" name="name"
           value="{{ old('name', $notebook->name) }}">

    @error('name')
    <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="checkbox">
    <label>
        <input value="1" name="is_favorite"
               type="checkbox" {{ old('is_favorite', $notebook->is_favorite) ? ' checked ' : '' }}>
        {{ __('Is favorite') }}
    </label>
    @error('is_favorite')
    <span class="help-block">
            <strong>{{ $message  }}</strong>
        </span>
    @enderror
</div>

<div class="checkbox">
    <label>
        <input value="1" name="is_private"
               type="checkbox" {{ old('is_private', $notebook->is_private) ? ' checked ' : '' }}>
        {{ __('Is private') }}
    </label>
    @error('is_private')
    <span class="help-block">
            <strong>{{ $message  }}</strong>
        </span>
    @enderror
</div>

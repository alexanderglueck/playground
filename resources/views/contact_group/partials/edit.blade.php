<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">
        {{ __('Name') }}
    </label>
    <input type="text" class="form-control" id="name" placeholder="{{ __('Name') }}" name="name"
           value="{{ old('name', $contactGroup->name) }}">

    @error('name')
    <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

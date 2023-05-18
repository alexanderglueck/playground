<label for="{{ $randomId }}">{{ $label }}</label>
<select id="{{ $randomId }}">
    @foreach ($countries as $country)
        <option value="{{ $country  }} "
                name="{{ $name }}" @selected($value == $country)
        >{{(__('countries')[$country] ?? $country) }}</option>
    @endforeach
</select>
@error($name)
    <span class="help-block"><strong>{{ $message }}</strong></span>
@enderror

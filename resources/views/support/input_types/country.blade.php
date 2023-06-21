@if($layoutMode == \App\Support\LayoutMode::EDIT)
<label for="{{ $randomId }}">{{ $label }}</label>
<select id="{{ $randomId }}" name="{{ $name }}">
    @foreach ($countries as $country)
        <option value="{{ $country  }} " @selected($value == $country)
        >{{(__('countries')[$country] ?? $country) }}</option>
    @endforeach
</select>
@error($name)
    <span class="help-block"><strong>{{ $message }}</strong></span>
@enderror
@endif

@if($layoutMode == \App\Support\LayoutMode::VIEW)
    <span>{{ $label }}: {{($value ? __('countries')[$value] ?? $value : '') }}</span>
@endif

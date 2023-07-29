@if($layoutMode == \App\Support\LayoutMode::EDIT)
<label for="{{ $randomId }}">{{ $label }}</label>
<input type="text" id="{{ $randomId }}" name="{{ $name }}" value="{{ $value }}"/>
@error($name)
<span class="help-block"><strong>{{ $message }}</strong></span>
@enderror
@endif

@if($layoutMode == \App\Support\LayoutMode::VIEW)
<span>{{ $label }}: {{ $value }}</span>
@endif

@if($layoutMode == \App\Support\LayoutMode::VALUE)
    <span>{{ $value }}</span>
@endif

@if($layoutMode == \App\Support\LayoutMode::RAW)
    {{ $value }}
@endif

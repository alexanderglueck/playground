@if($layoutMode == \App\Support\LayoutMode::EDIT)
<label for="{{ $randomId }}">{{ $label }}</label>
<input type="email" id="{{ $randomId }}" name="{{ $name }}" value="{{ $value }}" />
@error($name)
<span class="help-block"><strong>{{ $message }}</strong></span>
@enderror
@endif

@if($layoutMode == \App\Support\LayoutMode::VIEW)
    <span>{{ $label }}: @if($value) <a href="mailto:{{ $value }}">{{ $value }}</a>@endif</span>
@endif

@if($layoutMode == \App\Support\LayoutMode::VALUE)
    <span>@if($value) <a href="mailto:{{ $value }}">{{ $value }}</a>@endif</span>
@endif

@if($layoutMode == \App\Support\LayoutMode::RAW)
    @if($value){{ $value }}@endif
@endif

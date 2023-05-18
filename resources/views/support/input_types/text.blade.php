<label for="{{ $randomId }}">{{ $label }}</label>
<input type="text" id="{{ $randomId }}" name="{{ $name }}" value="{{ $value }}"/>
@error($name)
<span class="help-block"><strong>{{ $message }}</strong></span>
@enderror


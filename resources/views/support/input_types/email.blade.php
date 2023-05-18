<label for="{{ $randomId }}">{{ $label }}</label>
<input type="email" id="{{ $randomId }}" name="{{ $name }}" value="{{ $value }}" />
@error($name)
<span class="help-block"><strong>{{ $message }}</strong></span>
@enderror


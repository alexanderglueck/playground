@if($layoutMode == \App\Support\LayoutMode::EDIT)
<label for="{{ $randomId }}">{{ $label }}</label>
<select id="{{ $randomId }}" name="{{ $name }}[]" multiple>
    @foreach ($contactGroups as $contactGroup)
        <option value="{{ $contactGroup->id  }} " @selected(in_array($contactGroup->id, $value->pluck('id')->toArray() ?? []))
        >{{ $contactGroup->name }}</option>
    @endforeach
</select>
@error($name)
    <span class="help-block"><strong>{{ $message }}</strong></span>
@enderror
@endif

@if($layoutMode == \App\Support\LayoutMode::VIEW)
    <span>{{ $label }}: {{ $value->map(function(\App\Models\ContactGroup $contactGroup) { return $contactGroup->name;})->join(', ') }}</span>
@endif

@if($layoutMode == \App\Support\LayoutMode::VALUE)
    <span>{{ $value->map(function(\App\Models\ContactGroup $contactGroup) { return $contactGroup->name;})->join(', ') }}</span>
@endif

@if($layoutMode == \App\Support\LayoutMode::RAW)
{{ $value->map(function(\App\Models\ContactGroup $contactGroup) { return $contactGroup->name;})->join(', ') }}
@endif

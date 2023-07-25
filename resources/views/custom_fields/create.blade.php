<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create custom field') }}
        </h2>
    </x-slot>

    <x-panel>
        <form action="{{ route('custom_fields.store', ['viewType' => $viewType]) }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required />
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="field_type" class="form-label">{{ __('Type') }}</label>
                <select name="field_type" id="field_type" class="form-control @error('field_type') is-invalid @enderror" required>
                    <option @selected(old('field_type') == 'text') value="text">{{ __('Text') }}</option>
                    <option @selected(old('field_type') == 'email') value="email">{{ __('E-Mail') }}</option>
                    <option @selected(old('field_type') == 'phone') value="phone">{{ __('Phone') }}</option>
                    <option @selected(old('field_type') == 'date') value="date">{{ __('Date') }}</option>
                    <option @selected(old('field_type') == 'country') value="country">{{ __('Country') }}</option>
                    <option @selected(old('field_type') == 'section') value="section">{{ __('Section') }}</option>
                </select>
                @error('field_type')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </form>
    </x-panel>
</x-app-layout>

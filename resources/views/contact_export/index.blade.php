<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact export') }}
        </h2>
    </x-slot>

    <x-panel>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('contact_export.store') }}">
            @csrf

            <div>
                <label for="contactGroup">{{ __('Contact group') }}</label>
                <select name="contact_group" id="contactGroup">
                    @foreach($contactGroups as $contactGroup)
                        <option value="{{ $contactGroup->id }}">{{ $contactGroup->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit">{{ __('Export contacts') }}</button>
        </form>
    </x-panel>
</x-app-layout>

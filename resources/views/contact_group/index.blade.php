<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact groups') }}
        </h2>

        <a href="{{ route('contact_groups.create') }}">
            {{ __('Create contact group') }}
        </a>
    </x-slot>

    <x-panel>
        <ul>
            @foreach($contactGroups as $contactGroup)
                <li>
                    <a href="{{ route('contact_groups.show', [$contactGroup->id]) }}"
                       title="{{ __('View contact group') }}">
                        {{ $contactGroup->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </x-panel>
</x-app-layout>

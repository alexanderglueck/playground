<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    <x-panel>
        {{ \App\Support\Layout::render($contact) }}
    </x-panel>
</x-app-layout>
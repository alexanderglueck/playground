<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Custom fields') }}
        </h2>
    </x-slot>

    <x-panel>
        @foreach($viewTypes::cases() as $viewType)
            <p>
                <a href="{{ route('custom_fields.show', $viewType) }}">{{ $viewType->value }}</a>
            </p>
        @endforeach
    </x-panel>
</x-app-layout>

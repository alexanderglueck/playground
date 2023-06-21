<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notebooks') }}
        </h2>

        <a href="{{ route('notebooks.create') }}">
            {{ __('Create notebook') }}
        </a>
    </x-slot>

    <x-panel>
        <ul>
            @foreach($notebooks as $notebook)
                <li>
                    <a href="{{ route('notebooks.show', [$notebook->id]) }}"
                       title="{{ __('View notebook') }}">
                        {{ $notebook->name }}
                        @if($notebook->is_private)
                            ({{ __('Private') }})
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </x-panel>
</x-app-layout>

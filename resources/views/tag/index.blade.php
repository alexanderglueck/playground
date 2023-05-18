<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tags') }}
        </h2>

        <a href="{{ route('tags.create') }}">
            {{ __('Create tag') }}
        </a>
    </x-slot>

    <x-panel>
        <ul>
            @foreach($tags as $tag)
                <li>
                    <a href="{{ route('tags.show', [$tag->id]) }}" title="{{ __('View tag') }}">{{ $tag->name }}</a>
                </li>
            @endforeach
        </ul>
    </x-panel>
</x-app-layout>

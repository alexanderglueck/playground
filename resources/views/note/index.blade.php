<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <x-panel>
        <p>
            <a href="{{ route('notebooks.index') }}">{{ __('Notebooks') }}</a><br>
            <a href="{{ route('notebooks.create') }}">
                {{ __('Create notebook') }}
            </a>
        </p>

        <ul>
            @foreach($notebooks as $notebook)
                <li>
                    <a href="{{ route('notebooks.show', [$notebook->id]) }}"
                       title="{{ __('View notebook') }}">{{ $notebook->name }}</a>
                </li>
            @endforeach
        </ul>

        <hr>

        <p>
            <a href="{{ route('notes.index') }}">{{ __('Notes') }}</a><br>
            <a href="{{ route('notes.create') }}">
                {{ __('Create note') }}
            </a>
        </p>
        <ul>
            @foreach($notes as $note)
                <li>
                    <a href="{{ route('notes.show', [$note->id]) }}" title="{{ __('View note') }}">{{ $note->name }}</a>
                </li>
            @endforeach
        </ul>

        <hr>
        <p>
            <a href="{{ route('tags.index') }}">{{ __('Tags') }}</a><br>
            <a href="{{ route('tags.create') }}">
                {{ __('Create tag') }}
            </a>
        </p>
        <ul class="list-inline">
            @foreach($tags as $tag)
                <li class="list-inline-item">
                    <a class="badge badge-pill badge-{{ $tag->pill() }}" href="{{ route('tags.show', [$tag->id]) }}"
                       title="{{ __('View tag') }}">{{ $tag->name }}</a>
                </li>
            @endforeach
        </ul>
    </x-panel>

</x-app-layout>

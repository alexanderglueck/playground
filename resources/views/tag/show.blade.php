<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $tag->name }}
        </h2>

        <div>
        <a href="{{ route('tags.edit', [$tag->id]) }}">{{ __('Edit') }}</a>

        <form id="delete-form" class="confirm-delete d-inline inline" action="{{ route('tags.destroy', [$tag->id]) }}" method="POST" >
            @csrf
            @method('DELETE')

            <button class="btn btn-link p-0">{{ __('Delete') }}</button>
        </form>
        </div>
    </x-slot>

    <x-panel>
        <ul>
            @foreach($tag->notes as $note)
                <li>
                    <a href="{{ route('notes.show', [$note->id]) }}">{{ $note->name }}</a>
                </li>
            @endforeach
        </ul>
    </x-panel>
</x-app-layout>

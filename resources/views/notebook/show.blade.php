<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $notebook->name }}
        </h2>
        <div>
            <a href="{{ route('notes.create', ['notebook' => $notebook->id]) }}">{{ __('Create note') }}</a>

            <a href="{{ route('notebooks.edit', [$notebook->id]) }}">{{ __('Edit notebook') }}</a>

            <form id="delete-form" class="confirm-delete d-inline inline" action="{{ route('notebooks.destroy', [$notebook->id]) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-link btn p-0">{{ __('Delete') }}</button>
            </form>
        </div>
    </x-slot>

    <x-panel>
        <ul>
            @foreach($notebook->notes as $note)
                <li>
                    <a href="{{ route('notes.show', [$note->id]) }}" title="{{ __('View note') }}">{{ $note->name }}</a>
                </li>
            @endforeach
        </ul>
    </x-panel>
</x-app-layout>

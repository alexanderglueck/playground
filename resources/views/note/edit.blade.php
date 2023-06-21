<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit note') }}
        </h2>
    </x-slot>

    <x-panel>
        <form method="POST" action="{{ route('notes.update', [$note->id]) }}">
            @csrf
            @method('PUT')

            @include('note.partials.edit')

            <button type="submit" class="btn btn-default">
                {{ __('Edit note') }}
            </button>

        </form>
    </x-panel>
</x-app-layout>

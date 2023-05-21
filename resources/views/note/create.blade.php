<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create note') }}
        </h2>
    </x-slot>

    <x-panel>
        <form method="POST" action="{{ route('notes.store') }}">
            @csrf

            @include('note.partials.edit')

            <button type="submit" class="btn btn-default">
                Create note
            </button>

        </form>
    </x-panel>
</x-app-layout>

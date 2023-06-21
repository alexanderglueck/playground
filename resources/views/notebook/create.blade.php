<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create notebook') }}
        </h2>
    </x-slot>

    <x-panel>
        <form method="post" action="{{ route('notebooks.store') }}">
            @csrf

            @include('notebook.partials.edit')

            <button type="submit" class="btn btn-default">
                {{ __('Create notebook') }}
            </button>

        </form>
    </x-panel>
</x-app-layout>

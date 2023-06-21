<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create contact group') }}
        </h2>
    </x-slot>

    <x-panel>
        <form method="post" action="{{ route('contact_groups.store') }}">
            @csrf

            @include('contact_group.partials.edit')

            <button type="submit" class="btn btn-default">
                {{ __('Create contact group') }}
            </button>

        </form>
    </x-panel>
</x-app-layout>

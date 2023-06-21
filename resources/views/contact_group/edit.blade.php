<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit contact group') }}
        </h2>
    </x-slot>

    <x-panel>
        <form method="POST" action="{{ route('contact_groups.update', [$contactGroup->id]) }}">
            @csrf
            @method('PUT')

            @include('contact_group.partials.edit')

            <button type="submit" class="btn btn-default">
                {{ __('Edit contact group') }}
            </button>

        </form>
    </x-panel>
</x-app-layout>

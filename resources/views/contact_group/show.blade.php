<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $contactGroup->name }}
        </h2>
        <div>
            <a href="{{ route('contact_groups.edit', [$contactGroup]) }}">{{ __('Edit contact group') }}</a>

            <form id="delete-form" class="confirm-delete d-inline inline" action="{{ route('contact_groups.destroy', [$contactGroup->id]) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-link btn p-0">{{ __('Delete') }}</button>
            </form>
        </div>
    </x-slot>

    <x-panel>
        <ul>
           {{ $contactGroup->name }}
        </ul>
    </x-panel>
</x-app-layout>

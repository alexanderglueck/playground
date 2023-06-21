<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit contact') }}
        </h2>
    </x-slot>

    <x-panel>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('contacts.update', $contact) }}">
            @method('PUT')
            @include('contact.partials.edit')
            <input type="hidden" name="view" value="{{ $contact->view_id }}">
            <button type="submit">{{ __('Edit contact') }}</button>
        </form>
    </x-panel>
</x-app-layout>

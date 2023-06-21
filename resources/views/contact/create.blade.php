<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create contact') }}
        </h2>

        <div>
            <a href="{{ route('contacts.create') }}">{{ __('Default') }}</a>

            @foreach($views as $view)
                <a href="{{ route('contacts.create', ['view' => $view]) }}">{{ $view->name }}</a>
            @endforeach
        </div>
    </x-slot>

    <x-panel>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('contacts.store') }}">
            @include('contact.partials.edit')
            <input type="hidden" name="view" value="{{ $contact->view_id }}">
            <button type="submit">{{ __('Create contact') }}</button>
        </form>
    </x-panel>
</x-app-layout>

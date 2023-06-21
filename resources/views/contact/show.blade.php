<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contacts') }}
        </h2>

        <div>
            <a href="{{ route('contacts.edit', $contact) }}">{{ __('Edit contact') }}</a>

            <a href="{{ route('contacts.show', [$contact]) }}">{{ __('Default') }}</a>
            @foreach($views as $view)
                <a href="{{ route('contacts.show', ['contact' => $contact, 'view' => $view]) }}">{{ $view->name }}</a>
            @endforeach
        </div>
    </x-slot>

    <x-panel>
        {{ \App\Support\Layout::render($contact, \App\Support\LayoutMode::VIEW) }}
    </x-panel>
</x-app-layout>

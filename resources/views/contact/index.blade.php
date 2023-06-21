<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contacts') }}
        </h2>

        <a href="{{ route('contacts.create') }}">{{ __('Create contact') }}</a>
    </x-slot>

    <x-panel>
        <table>
            @foreach($contacts as $contact)
                <tr>
                    <td>
                        <a href="{{ route('contacts.show', $contact) }}" title="{{ __('View contact') }}">{{ __('Details') }}</a>
                    </td>
                    @foreach($contact->fields() as $field)
                        <td>{{ $field->render(\App\Support\LayoutMode::VIEW) }}</td>
                    @endforeach
                </tr>
            @endforeach

        </table>

    </x-panel>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contacts') }}
        </h2>

        <a href="{{ route('contacts.create') }}">{{ __('Create contact') }}</a>
    </x-slot>

    <x-panel>
        <table>
            <thead>
                <tr>
                    <th></th>
                    @foreach($fields as $field)
                        <th>{{ $field->getNameForLabel() }}</th>
                    @endforeach
                </tr>
            </thead>
            @foreach($contacts as $contact)
                <tr>
                    <td>
                        <a href="{{ route('contacts.show', $contact) }}" title="{{ __('View contact') }}">{{ __('Details') }}</a>
                    </td>
                    @foreach($fields as $field)
                        <td>{{  $contact->renderField($field, \App\Support\LayoutMode::VALUE) }}</td>
                    @endforeach
                </tr>
            @endforeach

        </table>

    </x-panel>
</x-app-layout>

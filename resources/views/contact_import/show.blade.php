<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact import') }}
        </h2>
    </x-slot>

    <x-panel>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('contact_import.update', $contactImport) }}">
            @csrf

            <div>
                <label><input type="checkbox" checked value="1" name="skip_header"> {{ __('Skip header row') }}</label>
            </div>

            <button type="submit">{{ __('Import contacts') }}</button>

            <table>
                <thead>
                <tr>
                    @foreach($headers as $header)
                        <th>
                            <label for="name-{{ $header }}">Mapping</label>
                            <select id="name-{{ $header }}" name="map[{{ $header }}]">
                            @foreach($fields as $field)
                                <option value="{{ $field->isCustomField() ? $field->column : $field->name }}">{{ $field->getNameForLabel() }}</option>
                            @endforeach
                            </select>
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>

                    <tr>
                        @foreach($headers as $header)
                            <td>{{ $header }}</td>
                        @endforeach
                    </tr>
                @foreach($rows as $row)
                    <tr>
                    @foreach($headers as $header)
                            <td>{{ $row[$header] }}</td>
                    @endforeach
                    </tr>
                @endforeach
                </tbody>

            </table>
        </form>




    </x-panel>
</x-app-layout>

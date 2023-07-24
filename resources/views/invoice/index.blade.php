<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    <x-panel>
        <a href="{{ route('invoices.create') }}">{{ __('Create invoice') }}</a>

        <ul>
            @foreach($invoices as $invoice)
                <li><a href="{{ route('invoices.show', $invoice) }}"
                       title="{{ __('View invoice') }}">{{ $invoice->number }}</a></li>
            @endforeach
        </ul>
    </x-panel>

</x-app-layout>

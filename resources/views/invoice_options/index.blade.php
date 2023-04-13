<x-app-layout>
    <x-panel>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Invoice Options') }}
            </h2>
        </x-slot>

        <a href="{{ route('invoice_options.create') }}">{{ __('Create invoice option') }}</a>

        <ul>
            @foreach($invoiceOptions as $invoiceOption)
                <li><a href="{{ route('invoice_options.show', $invoiceOption) }}"
                       title="{{ __('View invoice option') }}">{{ $invoiceOption->name }}</a></li>
            @endforeach
        </ul>
    </x-panel>
</x-app-layout>

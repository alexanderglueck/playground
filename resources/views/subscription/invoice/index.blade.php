<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    <x-panel>
        <table class="table">
            <thead>
            <tr>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Download') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                    <td>{{ $invoice->total() }}</td>
                    <td>
                        <a href="{{ route('subscription.invoices.show', $invoice->id) }}">
                            {{ __('Download') }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-panel>
</x-app-layout>

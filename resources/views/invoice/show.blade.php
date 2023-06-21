<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $invoice->number }}
        </h2>
    </x-slot>

    <x-panel>
       {{ $invoice }}
    </x-panel>

    <x-panel>
        <iframe style="width: 100%; height: 700px" src="{{ route('invoices.pdf.inline', $invoice) }}"></iframe>
    </x-panel>
</x-app-layout>

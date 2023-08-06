<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cancel subscription') }}
        </h2>
    </x-slot>

    <x-panel>
        <form action="{{ route('subscription.cancel.store') }}" method="post">
            @csrf

            <button type="submit" class="btn btn-primary">
                {{ __('Cancel subscription') }}
            </button>
        </form>
    </x-panel>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resume subscription') }}
        </h2>
    </x-slot>

    <x-panel>
        <form action="{{ route('subscription.resume.store') }}" method="post">
            @csrf

            <button type="submit" class="btn btn-primary">
                {{ __('Resume subscription') }}
            </button>
        </form>
    </x-panel>
</x-app-layout>

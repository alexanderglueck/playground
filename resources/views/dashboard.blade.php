<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-panel>
        {{ __("You're logged in!") }}

        <p>
            <a href="{{ route('custom_fields.index') }}">{{ __('Custom fields') }}</a><br>
            <a href="{{ route('contact_import.index') }}">{{ __('Contact import') }}</a><br>
            <a href="{{ route('contact_export.index') }}">{{ __('Contact export') }}</a><br>
            <a href="{{ route('processes.index') }}">{{ __('Processes') }}</a><br>
            <a href="{{ route('notifications.index') }}">{{ __('Notifications') }}</a><br>
            <a href="{{ route('view.index') }}">{{ __('Views') }}</a><br>
        </p>

        <p>
            <a href="{{ route('subscription.cancel.index') }}">{{ __('Cancel subscription') }}</a><br>
            <a href="{{ route('subscription.resume.index') }}">{{ __('Resume subscription') }}</a><br>
            <a href="{{ route('subscription.swap.index') }}">{{ __('Swap subscription') }}</a><br>
            <a href="{{ route('subscription.card.index') }}">{{ __('Update card') }}</a><br>
            <a href="{{ route('subscription.invoices.index') }}">{{ __('View invoices') }}</a><br>
        </p>
    </x-panel>
</x-app-layout>

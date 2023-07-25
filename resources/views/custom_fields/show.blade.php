<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Custom fields') }}
        </h2>

        <a href="{{ route('custom_fields.create', $viewType) }}">{{ __('Create custom field') }}</a>
    </x-slot>

    <x-panel>
        @if($fields->isEmpty())
            {{ __("You haven't created any custom fields yet.") }}
        @else
            @foreach($fields as $field)
                <form method="post" action="{{ route('custom_fields.destroy', [$viewType, $field]) }}">
                    @csrf
                    @method('DELETE')

                    {{ $field->name }}

                    <button class="btn btn-danger-outline">{{ __('Delete') }}</button>
                </form>
            @endforeach
        @endif
    </x-panel>

</x-app-layout>

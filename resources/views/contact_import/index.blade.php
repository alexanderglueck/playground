<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact import') }}
        </h2>
    </x-slot>

    <x-panel>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('contact_import.store') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-input-label for="upload" :value="__('File')" />
                <x-text-input id="upload" class="block mt-1 w-full" type="file" name="upload" required />
                <x-input-error :messages="$errors->get('upload')" class="mt-2" />
            </div>

            <button type="submit">{{ __('Import contacts') }}</button>
        </form>
    </x-panel>
</x-app-layout>

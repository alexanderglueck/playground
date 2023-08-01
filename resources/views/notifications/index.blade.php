<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <x-panel>
        @foreach($notifications as $notification)
            <div>{{ $notification->created_at->diffForHumans() }}
           @switch($notification->type)
               @case(\App\Notifications\ContactExportFinished::class)
                    {{ __('Contact export finished') }}
                <a href="{{ asset($notification->data['file_path']) }}">{{ __('Download') }}</a>
               @break

               @case(\App\Notifications\ContactImportFinished::class)
                   {{ __('Contact import finished') }}
               @break
           @endswitch
            </div>
        @endforeach
    </x-panel>
</x-app-layout>

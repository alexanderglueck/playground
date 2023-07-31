<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Processes') }}
        </h2>
    </x-slot>

    <x-panel>
        <h3>{{ __('Contact imports') }}</h3>
        <p>{{ __('Without column mapping') }}</p>
        <ul>
            @foreach($contactImports->whereNull('started_at') as $contactImport)
                <li>
                    <a href="{{ route('contact_import.show', $contactImport) }}">{{ $contactImport->created_at->diffForHumans() }}</a>
                </li>
            @endforeach
        </ul>
        <p>{{ __('Currently being processed') }}</p>
        <ul>
            @foreach($contactImports->whereNull('completed_at')->whereNotNull('started_at') as $contactImport)
                <li>{{ $contactImport->created_at->diffForHumans() }}</li>
            @endforeach
        </ul>
        <p>{{ __('Completed') }}</p>
        <ul>
            @foreach($contactImports->whereNotNull('completed_at')->whereNotNull('started_at') as $contactImport)
                <li>{{ $contactImport->created_at->diffForHumans() }}</li>
            @endforeach
        </ul>

        <h3>{{ __('Contact exports') }}</h3>
        <p>{{ __('Queued') }}</p>
        <ul>
            @foreach($contactExports->whereNull('started_at') as $contactExport)
                <li>
                    <a href="{{ route('contact_import.show', $contactExport) }}">{{ $contactExport->created_at->diffForHumans() }}</a>
                </li>
            @endforeach
        </ul>
        <p>{{ __('Currently being processed') }}</p>
        <ul>
            @foreach($contactExports->whereNull('completed_at')->whereNotNull('started_at') as $contactExport)
                <li>{{ $contactExport->created_at->diffForHumans() }}</li>
            @endforeach
        </ul>
        <p>{{ __('Completed') }}</p>
        <ul>
            @foreach($contactExports->whereNotNull('completed_at')->whereNotNull('started_at') as $contactExport)
                <li>{{ $contactExport->created_at->diffForHumans() }} <a
                        href="{{ asset($contactExport->file_path) }}">{{ $contactExport->file_path }}</a></li>
            @endforeach
        </ul>
    </x-panel>
</x-app-layout>

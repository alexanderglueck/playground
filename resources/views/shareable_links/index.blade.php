<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shared Resources') }}
        </h2>
    </x-slot>
    <x-panel>

        <ul>
            @foreach($shareableLinks as $shareableLink)
                <li>
                    <a href="{{ $shareableLink->url }}"
                       title="{{ __('View share') }}">{{ $shareableLink->shareable->getFlashName() }} ({{ __('Shared :time_ago', ['time_ago' => $shareableLink->created_at->diffForHumans()]) }})</a>
                    <form action="{{ route('shared.destroy', $shareableLink) }}" method="post" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">{{ __('Delete') }}</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </x-panel>
</x-app-layout>

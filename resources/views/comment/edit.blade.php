<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit comment') }}
        </h2>

        <form action="{{ route('comments.destroy', $comment) }}" method="post" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit">{{ __('Delete comment') }}</button>
        </form>
    </x-slot>

    <x-panel>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('comments.update', $comment) }}">
            @csrf
            @method('PUT')

            <label for="comment">{{ __('Comment') }}</label>
            <textarea id="comment" name="comment" class="form-control" rows="3">{{ old('comment', $comment->comment) }}</textarea>

            <button type="submit">{{ __('Edit comment') }}</button>
        </form>
    </x-panel>
</x-app-layout>

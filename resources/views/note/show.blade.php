<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $note->name }}
        </h2>

        <div>
            <a href="{{ route('notes.edit', [$note->id]) }}">Edit</a>

            <form id="delete-form" class="confirm-delete d-inline inline"
                  action="{{ route('notes.destroy', [$note->id]) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-link p-0">Delete</button>
            </form>
        </div>

    </x-slot>

    <x-panel>
        <ul class="list-inline">
            @foreach($note->tags as $tag)
                <li class="list-inline-item">
                    <a class="badge badge-pill badge-{{ $tag->pill() }}" href="{{ route('tags.show', [$tag->id]) }}">
                        {{ $tag->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        {{ $note->content }}
        {{--        {!! app(\App\Markdown::class)->toHtml($note->content) !!}--}}
    </x-panel>
</x-app-layout>

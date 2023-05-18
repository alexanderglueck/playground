<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create tag') }}
        </h2>
    </x-slot>

    <x-panel>
        <form method="POST" action="{{ route('tags.store') }}">
            @csrf

            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="tag">
                    Tag
                </label>
                <input type="text" class="form-control" id="tag" placeholder="Tag" name="name"
                       value="{{ old('name') }}">

                @if($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

            </div>

            <button type="submit" class="btn btn-default">
                {{ __('Create tag') }}
            </button>

        </form>
    </x-panel>
</x-app-layout>

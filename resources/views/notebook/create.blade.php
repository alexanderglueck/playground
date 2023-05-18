<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create notebooks') }}
        </h2>
    </x-slot>

    <x-panel>
        <form method="post" action="{{ route('notebooks.store') }}">
            @csrf

            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">
                    Name
                </label>
                <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                       value="{{ old('name') }}" >

                @if($errors->has('name'))
                    <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif

            </div>

            <div class="checkbox">
                <label>
                    <input value="1" name="is_favorite" type="checkbox" {{ old('is_favorite', 0) ? ' checked ' : '' }}>
                    Is favorite
                </label>
            </div>

            <button type="submit" class="btn btn-default">
                Create notebook
            </button>

        </form>
    </x-panel>
</x-app-layout>

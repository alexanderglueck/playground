<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create note') }}
        </h2>
    </x-slot>

    <x-panel>
        <form method="POST" action="{{ route('notes.store') }}">
            @csrf

            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">
                    Name
                </label>
                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}">

                @if($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif

            </div>


            <div class="form-group {{ $errors->has('notebook') ? ' has-error' : '' }}">
                <label for="notebook">
                    Notebook
                </label>
                <select class="form-control" id="notebook" name="notebook">
                    @foreach($notebooks as $notebook)
                        <option {{ $notebook->id == old('notebook', $notebookPreselect) ? ' selected ' : '' }} value="{{ $notebook->id }}">{{ $notebook->name }}</option>
                    @endforeach
                </select>

                @if($errors->has('notebook'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('notebook') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('tags') ? ' has-error' : '' }}">
                <label for="tags">
                    Tags
                </label>
                <select multiple class="form-control" id="tags" name="tags[]">
                    @foreach($tags as $tag)
                        <option {{ in_array($tag->id, old('tags', [])) ? ' selected ' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>

                @if($errors->has('tags'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                @endif
            </div>


            <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                <label for="content">
                    Content
                </label>
                <textarea id="content" name="content" class="form-control" rows="3">{{ old('content') }}</textarea>
                @if($errors->has('content'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                @endif
            </div>

            <button type="submit" class="btn btn-default">
                Create note
            </button>

        </form>
    </x-panel>
</x-app-layout>
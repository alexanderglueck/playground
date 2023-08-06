@if ($errors->any())
    <div class="alert alert-danger mb-3">
        <p class="mb-0">{{ __('Validation error overview') }}</p>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

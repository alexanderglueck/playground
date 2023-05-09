@foreach ($fields as $row)
    <div class="row">
        @foreach ($row as $field)
            <span class='col'>{{ $field }}</span>
        @endforeach
    </div>
@endforeach

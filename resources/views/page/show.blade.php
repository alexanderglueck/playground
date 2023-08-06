@extends('layouts.public')

@section('content')
    <div class="row">
        <div class="col-sm-8">
            {{ \Illuminate\Mail\Markdown::parse($content) }}
        </div>
    </div>
@endsection

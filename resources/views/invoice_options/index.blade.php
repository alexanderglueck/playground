@extends('layouts.app')

@section('content')

    <a href="{{ route('invoice_options.create') }}">{{ __('Create invoice option') }}</a>

    <ul>
        @foreach($invoiceOptions as $invoiceOption)
            <li><a href="{{ route('invoice_options.show', $invoiceOption) }}"
                   title="{{ __('View invoice option') }}">{{ $invoiceOption->name }}</a></li>
        @endforeach
    </ul>

@endsection

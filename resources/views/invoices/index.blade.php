@extends('layouts.app')

@section('content')

    <a href="{{ route('invoices.create') }}">{{ __('Create invoice') }}</a>

    <ul>
        @foreach($invoices as $invoice)
            <li><a href="{{ route('invoices.show', $invoice) }}" title="{{ __('View invoice') }}">{{ $invoice->number }}</a></li>
        @endforeach
    </ul>

@endsection

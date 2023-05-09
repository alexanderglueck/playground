<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
<h1>Invoice {{ $invoice->number }}</h1>

<ul>
    @foreach($invoice->invoiceItems as $invoiceItem)
        <li>{{ $invoiceItem->quantity }} x {{ $invoiceItem->description }} {{ $invoiceItem->price_per_unit }} (Tax {{ $invoiceItem->tax }})</li>
    @endforeach
</ul>

<p>Sum: {{ $invoice->sum() }}<br>
Gross Sum: {{ $invoice->sumGross() }}</p>
</body>
</html>

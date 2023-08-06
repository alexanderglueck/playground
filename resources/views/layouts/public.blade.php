<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="robots" content="noindex,nofollow"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"
            defer></script>
    @vite(['resources/js/app.js'])
</head>
<body>

<nav class="navbar bg-dark mb-4" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="{{ config('app.url') }}">{{ config('app.name') }}</a>
    </div>
</nav>
<main class="container">
    @include('flash::message')

    @yield('content')
</main>

<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item">
                <a href="{{ route('page.privacy_policy') }}"
                   class="nav-link px-2 text-body-secondary">{{ __('Privacy Policy') }}</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('page.terms_of_service') }}"
                   class="nav-link px-2 text-body-secondary">{{ __('Terms of Service') }}</a>
            </li>
        </ul>
        <p class="text-center text-body-secondary">© {{ date('Y') }} {{ config('app.name') }}</p>
    </footer>
</div>
</body>
</html>

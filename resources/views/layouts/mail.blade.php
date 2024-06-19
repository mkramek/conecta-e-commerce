<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" value="{{ csrf_token() }}">
    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">

    @vite(['resources/sass/app.scss'])
    @wireUiStyles
</head>
<body>
<header class="bg-zinc-600 text-white px-6 py-3">
    <x-logo />
    <h1 class="text-2xl text-inherit">@yield('title')</h1>
</header>
<section class="px-6 py-4">
    @yield('body')
</section>
<footer class="bg-zinc-600 text-white px-6 py-3">
    @yield('footer')
</footer>
</body>
</html>

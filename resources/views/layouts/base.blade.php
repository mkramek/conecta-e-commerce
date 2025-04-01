<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" value="{{ csrf_token() }}">
    @hasSection('meta_title')
        <title>@yield('meta_title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    @hasSection('meta_desc')
        <meta name="description" content="@yield('meta_desc')">
    @endif
    @hasSection('meta_keywords')
        <meta name="keywords" content="@yield('meta_keywords')">
    @endif
    @hasSection('meta_author')
        <meta name="author" content="@yield('meta_author')">
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">

    @wireUiScripts
    @livewireStyles
    @livewireScripts
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <x-notifications position="top-end" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    @if (Request::path() === app()->getLocale())
        <livewire:carousel />
    @endif
    <livewire:header />
    @yield('body')
    <livewire:footer />
    <livewire:wire-elements-modal />
</body>

</html>

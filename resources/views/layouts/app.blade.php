@extends('layouts.base')

@section('body')
    <main class="min-h-[calc(100vh-26rem)]">
        @yield('content')
        @isset($slot)
            {{ $slot }}
        @endisset
    </main>
@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Coins Master') }}</title>
    <link rel="shortcut icon" href="{{asset('images/logo.ico')}}" type="image/x-icon">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles
    <style>
        [x-cloak] {
            display: none !important;
        }

        #alert {
            font-size: 11pt !important;
            transition: 2s;
        }

        .roll-in-right {
            animation: roll-in-right .3s ease both
        }

        @keyframes roll-in-right {
            0% {
                transform: translateX(800px) rotate(540deg);
                opacity: 0
            }

            100% {
                transform: translateX(0) rotate(0deg);
                opacity: 1
            }
        }
    </style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body>
    @include('layouts.nav')
    @include('layouts.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
        @yield('content')
        {{-- Footer --}}
        {{-- @include('layouts.footer')--}}
    </main>

    @yield('scripts')
    @livewireScripts
</body>

</html>
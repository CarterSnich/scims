<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Senior Citizen Information Management System')</title>

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    {{-- font --}}
    <link rel="preload" href="{{ asset('fonts/nunito-v25-latin-regular.woff2') }}" as="font" type="font/woff2" crossorigin>

    {{-- compiled frontend --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- style.css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- administrator sidebar --}}
    <link rel="stylesheet" href="{{ asset('css/administrator-sidebar.css') }}">

    <style>
        body {
            background-image: url(/images/bg.webp);
            background-blend-mode: overlay;
            background-size: cover;
            background-repeat: no-repeat;
        }

        main {
            overflow: hidden;
        }

        #main-wrapper {
            min-height: auto;
            overflow: auto;
            width: 100%;
        }
    </style>

    @yield('style')

</head>

<body class="d-flex flex-column bg-dark text-light">
    <x-brand-bar />

    <main class="d-flex w-100 flex-grow-1">
        <x-side-bar />

        <div id="main-wrapper" class="p-3">
            @yield('content')
        </div>
    </main>

    {{-- toast --}}
    <div id="toasters" class="position-fixed bottom-0 start-0 ps-3 pb-4">

        @if (session()->has('toast'))
            <div class="toast align-items-center text-white bg-{{ session('toast')['type'] }} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('toast')['message'] }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif

    </div>

    {{-- compiled js --}}
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.toast').toast('show')

        })
    </script>

    @yield('script')


</body>

</html>

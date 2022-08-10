<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Senior Citizen Information Management System</title>

    {{-- compiled frontend --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- style.css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        form#login-form {
            width: 512px;
        }
    </style>


</head>

<body class="bg-dark text-light">
    @error('invalid-credentials')
        <x-popup-alert :message="$message" type="danger" />
    @enderror

    <x-brand-bar />

    <form id="login-form" class="border border-light p-3 rounded mx-auto mt-5" method="POST" action="/user/authenticate" novalidate>
        @csrf
        <h2 class="mb-3 text-center h2">Administrator Login</h2>
        <div class="mb-3">
            <label for="login-email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="login-email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="login-password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="login-password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    {{-- jquery 3.6.0 minified --}}
    <script src="{{ asset('js/jquery-3.6.0.slim.min.js') }}"></script>

    {{-- compiled js --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- page script --}}
    <script defer>
        (function() {
            'use strict'

            $('#login-form').on('submit', function(event) {
                if (!this.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                this.classList.add('was-validated')
            })

        })()
    </script>

</body>

</html>

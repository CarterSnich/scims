<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="font" content="{{ asset('fonts/Roboto/Roboto-Regular.ttf') }}">
    <meta name="logo" content="{{ asset('images/logo.png') }}">
    <meta name="form" content="{{ asset('images/scims-application-form.png') }}">

    <meta name="citizen" content="{{ json_encode($citizen) }}">
    <meta name="citizen_id" content="{{ $citizen_id }}">
    <meta name="fullname" content="{{ $fullname }}">
    <meta name="age" content="{{ $age }}">
    <meta name="educational_attainment" content="{{ $educational_attainment }}">
    <meta name="barangay" content="{{ json_encode($barangay) }}">
    <meta name="picture" content="{{ asset("storage/pictures/{$citizen->picture}") }}">

    <title>Senior Citizen ID #{{ $citizen_id }} {{ $fullname }}</title>

    <script src="{{ asset('js/jspdf.umd.min.js') }}" defer></script>
    <script src="{{ asset('js/print-citizen.js') }}" defer></script>
    <style>
        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        iframe {
            width: 100%;
            height: 100vh;
            border: none;
            box-sizing: border-box;
            display: block
        }
    </style>
</head>

<body>
    <iframe></iframe>

</body>

</html>

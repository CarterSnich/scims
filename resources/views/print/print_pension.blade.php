<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="font" content="{{ asset('fonts/Roboto/Roboto-Regular.ttf') }}">
    <meta name="logo" content="{{ asset('images/logo.png') }}">
    <meta name="form" content="{{ asset('images/social-pension-form.jpg') }}">

    <meta name="pension" content="{{ json_encode($pension) }}">
    <meta name="fullname" content="{{ $fullname }}">
    <meta name="barangay" content="{{ json_encode($barangay) }}">
    <meta name="picture" content="{{ asset("storage/pension-pictures/{$pension->picture}") }}">

    <title>Social Pension | {{ $fullname }}</title>

    <script src="{{ asset('js/jspdf.umd.min.js') }}" defer></script>
    <script src="{{ asset('js/print-pension.js') }}" defer></script>
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

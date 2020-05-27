<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config("app.name", "Subscript") }}</title>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.7/css/unicons.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,900&display=swap" rel="stylesheet">
        <link href="{{ mix("css/app.css") }}" rel="stylesheet">
    </head>
    <body class="bg-gray-50">
        <div id="app">
            @yield("content")
        </div>
        <script src="{{ mix("js/app.js") }}"></script>
        @stack("scripts")
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>
        @vite('resources/js/app.js')
    </head>
    <body>
    <h1 class="text-3xl bg-blue-100">
        {{ env('APP_NAME') }}
    </h1>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name', 'Laravel Project'))</title>
        @vite('resources/js/app.js')
    </head>
    <body>
        @if(session('message'))
            <div class="p-5 bg-green-300 text-green-700 text-center">
                {{ session('message')  }}
            </div>
        @endif

        @auth
            {{ auth()->user()->email }}

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Выйти</button>
            </form>
        @elseguest
            <a href="{{ route('login') }}">Войти</a>
        @endauth

        @yield('content')
    </body>
</html>

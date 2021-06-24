<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>{{ $title ? $title : '' }}</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <body class="font-sans antialiased bg-gray-100">
        <div id="app">
            @include('partials/modules/header')
            <div class="max-w-screen-xl px-4 pt-12 mx-auto sm:px-6 lg:px-8">
                <main>
                    {{ $slot }}
                </main>
            </div>
            @include('partials/modules/footer')
        </div>
    </body>

</html>
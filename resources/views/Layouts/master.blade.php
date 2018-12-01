<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">
            
            <link rel="stylesheet" href="{{asset('css/app.css')}}">
            <title>{{config('app.name')}}</title>
            <script src="{{ asset('js/app.js') }}" defer></script>

            <!-- Fonts -->
            <link rel="dns-prefetch" href="//fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        @include('Layouts.navbar')
        <div class="container">
            @include('Layouts.messages')
            @yield('content')
        </div>
    </body>

    </html>



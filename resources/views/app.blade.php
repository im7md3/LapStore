<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,800;1,300;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{asset('js/noty/noty.css')}}">
        <style>
            body{
                font-family: 'Open Sans', sans-serif; !important;
            }
        </style>
        <!-- Styles --> 
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{asset('js/noty/noty.min.js')}}"></script><script src="https://js.stripe.com/v3/"></script>

    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>

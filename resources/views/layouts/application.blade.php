<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield("title")</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.css')}}">
    </head>
    <body>
        @include("components.header")
        @yield("content")
        @include("components.footer")
    </body>
</html>

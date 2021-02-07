<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>
        <script src="{{ mix('/js/app.js') }}" defer></script>
    </head>

    <body class="hold-transition">
        @yield('content')
    </body>
</html>

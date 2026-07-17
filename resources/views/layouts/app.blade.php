<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts and Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles and Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])
    @yield('ext_css')
    <style>
    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .page-header {
        margin-top: 0px;
    }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.partials.nav')

        <div class="container">
        @yield('content')
        </div>
    </div>

    @yield('ext_js')
    @yield('script')
    <script type="module">
        var header = $('h2.page-header').contents();
        let str = '';
        let mainText = header.filter(function () {
            // return type of text
                return this.nodeType === 3;
            })[0];
        str += mainText.data.trim();

        if (mainText.nextSibling) {
            // next siblings should be a small tag text
            str += " - "+mainText.nextSibling.innerText;
        }
        $('title').prepend(str+" - ");
    </script>
</body>
</html>

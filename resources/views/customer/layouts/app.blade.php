<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') :: Customer</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="tw--wrapper">
    <div class="w-5xl mx-auto" id="app">
        <div class="content-wrapper">
            @yield('content')
        </div>
        <footer class="main-footer mt-4">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.18
            </div>
            <p>Copyright &copy; 2014-2019 <a href="https://github.com/kzamanbd">DraftScripts</a>.</p>
        </footer>
    </div>
</body>

</html>

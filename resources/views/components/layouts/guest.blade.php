<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="bg-light dark:bg-slate-700 dark:text-gray-300">
            <div class="flex min-h-screen items-center justify-center overflow-hidden p-6">
                <div class="login-card">
                    <div
                        class="rounded-md bg-white px-8 py-6 text-gray-600 shadow-md dark:bg-gray-700 dark:text-gray-200">
                        <div class="my-4 flex items-center justify-center space-x-2">
                            <x-application-logo class="size-9 fill-current text-black dark:text-white" />
                            <p class="text-3xl font-semibold">{{ config('app.name', 'Laravel') }}</p>
                        </div>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">
        <div class="tw--wrapper" x-data="themeConfig" :class="appConfig">
            <!-- Loading dialog -->
            <div class="loading">
                <div class="loading-box">
                    <div class="loading-box1"></div>
                    <div class="loading-box2"></div>
                </div>
            </div>

            <x-layouts.vertical-menu />

            <!-- start main content -->
            <div class="tw--container">
                <x-layouts.header />

                <main class="tw--content">
                    <!-- Start Breadcrumb -->
                    <nav class="breadcrumb">
                        <div class="left-link">
                            <button @click="toggleSidebar" type="button" class="toggle-sidebar" aria-label="Menu">
                                <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="22"
                                    width="22" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h8m-8 6h16"></path>
                                </svg>
                            </button>
                            <h5 class="breadcrumb-title">{{ $title }}</h5>
                        </div>
                        {{ $header ?? '' }}
                    </nav>
                    <!-- End Breadcrumb -->

                    {{ $slot }}
                </main>

                <footer class="footer" :class="footerType">
                    <span class="footer-text">
                        <span id="footer-year"></span>
                        <a :href="appLink" class="hover:underline" x-html="appName">UI</a>
                        <span class="hidden lg:flex"> All Rights Reserved.</span>
                    </span>
                    <ul class="footer-button">
                        <li>
                            <a href="#" class="mr-4 hover:underline lg:mr-6">About</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline lg:mr-6">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline lg:mr-6">Licensing</a>
                        </li>
                        <li>
                            <a :href="repoLink" class="hover:underline" target="_blank"> Github </a>
                        </li>
                    </ul>
                </footer>
            </div>

            <x-layouts.search />
            <x-layouts.theme-customizer />
        </div>

    </body>

</html>

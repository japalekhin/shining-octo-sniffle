<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Shining Octo Sniffle</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="manifest" href="/site.webmanifest">
    <link rel="apple-touch-icon" href="/icon.png">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="theme-color" content="#fafafa">
</head>

<body class="min-h-screen">
    <div id="app" class="min-h-screen flex flex-col">
        {{-- Main site menu --}}
        <header class="flex flex-column items-center sticky top-0 h-16 bg-indigo-800 text-white z-40 shadow-lg">
            <nav class="flex flex-row items-center container px-4 md:px-16 mx-auto">
                <a href="{{ url('/') }}">
                    <div class="relative text-2xl font-black">
                        <i class="fas fa-basketball-ball text-red-500"></i>
                        NBA Stats
                    </div>
                </a>
                <a href="/reports" class="inline-block text-lg pl-6 py-4">View Reports</a>
                <a href="/export" class="inline-block text-lg pl-6 py-4">Export Data</a>
                <div class="hidden md:flex flex-row items-center ml-auto">
                    <a class="cursor-pointer bg-green-600 text-white px-6 py-2 text-lg font-bold rounded">This is a
                        CTA</a>
                </div>
            </nav>
        </header>

        {{-- Site content --}}
        <div id="divSiteContent" class="flex-grow flex flex-col">
            @yield('content')
        </div>

        {{-- Site footer --}}
        <footer id="ftrSiteFooter" class="flex flex-column bg-gray-800 items-center justify-center py-6 mt-8">
            <div class="text-white">
                Copyright <a href="https://jap.alekhin.io">Japa Alekhin Llemos</a> 2021. All Rights Reserved.
            </div>
        </footer>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="/css/logo.css">
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/recipe.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://kit.fontawesome.com/96256907d4.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
                <header class="header bg-black w-full fixed z-50">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        @include('components.header')
                    </div>
                </header>

            <!-- Page Content -->
            <main class="main pt-16 pb-20">
                {{-- @include('components.comment') --}}
                {{ $slot }}
            </main>

            {{-- フッター --}}
            <footer class="z-50">
                @include('components.footer_navigation')
            </footer>
        </div>
        
        
        <script src="/js/footer.js"></script>
        <script src="/js/recipe.js"></script>
        <script src="/js/dashbord.js"></script>
        <script src="/js/new_recipe.js"></script>
        <script src="/js/admin.js"></script>
    </body>
</html>

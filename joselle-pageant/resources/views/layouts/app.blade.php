<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Joselle Martinez | Official Pageant Portfolio')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']);
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
</head>

<body
    class="bg-pageant-dark text-pageant-light antialiased flex flex-col min-h-screen selection:bg-pageant-pink selection:text-white {{ request()->routeIs('home') ? 'overflow-hidden' : '' }}">
    <nav
        class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-8 py-5 bg-theme-dark/80 backdrop-blur-md border-b border-theme-purple/30">

        <a href="{{ route('home') }}"
            class="font-brand text-4xl text-theme-light hover:text-theme-pink transition-colors">
            Joselle
        </a>

        <div class="space-x-8 text-white text-sm font-semibold tracking-widest uppercase">
            <a href="{{ route('home') }}" class="hover:text-theme-pink transition">Home</a>
            <a href="{{ route('journey') }}" class="hover:text-theme-pink transition">Journey</a>
            <a href="{{ route('advocacy') }}" class="hover:text-theme-pink transition">Advocacy</a>
            <a href="{{ route('gallery') }}" class="hover:text-theme-pink transition">Gallery</a>
            <a href="{{ route('support') }}" class="hover:text-theme-pink transition">Support</a>

        </div>
    </nav>

    <main class="flex-grow relative">
        @yield('content')
    </main>
    <footer class="w-full bg-theme-dark border-t border-theme-light/10 pt-12 pb-8 px-8 relative z-50">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-center items-center gap-6">

            <div class="text-center md:text-left">
                <span class="font-brand text-2xl text-theme-light block mb-2">Joselle</span>
                <p class="font-sans text-xs tracking-widest uppercase text-theme-light/50">
                    &copy; 2026 All Rights Reserved.
                </p>
            </div>

        </div>
    </footer>
    @stack('scripts')
</body>

</html>

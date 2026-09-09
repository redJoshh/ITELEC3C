<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', "Archer's Fitness Gym") }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-archer-dark text-white min-h-screen flex flex-col">
    <nav class="bg-archer-charcoal border-b-2 border-archer-neon shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-archer-neon drop-shadow-md"> <img
                            src="{{ asset('images/archer-logo.png') }}" alt="Archers Fitness Logo"
                            class="h-12 w-auto object-contain drop-shadow-md"> </a>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('home') }}"
                            class="{{ request()->routeIs('home') ? 'text-archer-neon font-bold border-b-2 border-archer-neon' : 'text-gray-300 hover:text-archer-hazard' }} inline-flex items-center px-1 pt-1 text-sm font-medium transition duration-150">
                            Home
                        </a>
                        <a href="{{ route('about') }}"
                            class="{{ request()->routeIs('about') ? 'text-archer-neon font-bold border-b-2 border-archer-neon' : 'text-gray-300 hover:text-archer-hazard' }} inline-flex items-center px-1 pt-1 text-sm font-medium transition duration-150">
                            About
                        </a>
                        <a href="{{ route('services') }}"
                            class="{{ request()->routeIs('services') ? 'text-archer-neon font-bold border-b-2 border-archer-neon' : 'text-gray-300 hover:text-archer-hazard' }} inline-flex items-center px-1 pt-1 text-sm font-medium transition duration-150">
                            Services
                        </a>
                        <a href="{{ route('home-workouts', ['target' => 'default']) }}"
                            class="{{ request()->routeIs('home-workouts') ? 'text-archer-neon font-bold border-b-2 border-archer-neon' : 'text-gray-300 hover:text-archer-hazard' }} inline-flex items-center px-1 pt-1 text-sm font-medium transition duration-150">
                            Free Workouts
                        </a>
                        <a href="{{ route('contact') }}"
                            class="{{ request()->routeIs('contact') ? 'text-archer-neon font-bold border-b-2 border-archer-neon' : 'text-gray-300 hover:text-archer-hazard' }} inline-flex items-center px-1 pt-1 text-sm font-medium transition duration-150">
                            Contact
                        </a>
                    </div>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-sm font-medium text-gray-300 hover:text-archer-neon transition">Member Portal</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-gray-300 hover:text-archer-neon transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="bg-archer-neon hover:bg-green-400 text-archer-dark px-4 py-2 rounded-md text-sm font-extrabold transition shadow-[0_0_10px_rgba(57,255,20,0.5)]">Join
                                Now</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <main class="flex-grow container mx-auto px-6 py-12">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-archer-charcoal text-center p-4 border-t-2 border-archer-neon mt-auto">
        <p class="text-gray-400 text-sm">© {{ date('Y') }} Archer's Fitness Gym Malabon. Open Daily 6:00 AM - 10:00
            PM.
        </p>
    </footer>
</body>

</html>

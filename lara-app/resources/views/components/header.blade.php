<header class="bg-blue-900 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{ url('/') }}">Workopia</a>
        </h1>
        <!-- Desktop Nav -->
        <nav class="hidden md:flex items-center space-x-4">
            <x-nav-link url="/" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link url="/jobs" :active="request()->is('jobs') && !request()->is('jobs/saved')">Jobs</x-nav-link>
            <x-nav-link url="/jobs/saved" :active="request()->is('jobs/saved')">Saved Jobs</x-nav-link>
            <x-nav-link url="/login" :active="request()->is('login')">Login</x-nav-link>
            <x-nav-link url="/register" :active="request()->is('register')">Register</x-nav-link>
            <x-nav-link url="/dashboard" :active="request()->is('dashboard')" icon="gauge">Dashboard</x-nav-link>
            <x-button-link url="/jobs/create" icon="edit" bgClass="bg-yellow-500" textClass="text-black">
                Create Job
            </x-button-link>
        </nav>

        <!-- Mobile Menu -->
        <nav id="mobile-menu" class="hidden md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2">
            <x-nav-link url="/jobs" :active="request()->is('jobs') && !request()->is('jobs/saved')" :mobile="true">Jobs</x-nav-link>
            <x-nav-link url="/jobs/saved" :active="request()->is('jobs/saved')" :mobile="true">Saved Jobs</x-nav-link>
            <x-nav-link url="/login" :active="request()->is('login')" :mobile="true">Login</x-nav-link>
            <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">Register</x-nav-link>
            <x-nav-link url="/dashboard" :active="request()->is('dashboard')" :mobile="true">Dashboard</x-nav-link>
            <x-button-link url="/jobs/create" icon="edit" bgClass="bg-yellow-500" textClass="text-black"
                :block="true">
                Create Job
            </x-button-link>
        </nav>
</header>

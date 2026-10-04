<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="<https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js>"></script>
    <title>{{ $title ?? 'Workopia | Find and List Jobs' }}</title>
</head>

<body class="bg-white-100">
    <x-header />
    @if (request()->is('/'))
        <x-hero />
        <x-top-banner />
    @endif
    <main class="container mx-auto p-4 mt-4">
        <!-- Display alert messages -->
        @if (session('success'))
            <x-alert type="success" message="{{ session('success') }}" />
        @endif

        @if (session('error'))
            <x-alert type="error" message="{{ session('error') }}" />
        @endif
        {{ $slot }}
    </main>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'Workopia | Find and List Jobs' }}</title>
</head>

<body class="bg-white-100">
    <x-header />
    @if (request()->is('/'))
        <x-hero />
        <x-top-banner />
    @endif
    <main class="container mx-auto p-4 mt-4">

        {{ $slot }}
    </main>

</body>

</html>

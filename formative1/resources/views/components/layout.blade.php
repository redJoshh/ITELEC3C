<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $title }} </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <header class="bg-danger text-warning p-4 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="mb-0 fw-bold"> Student Portal</h2>
            <nav class="d-flex justify-content-md-between gap-3 ">
                <a href="{{ route('slot-home') }}" class="text-white text-decoration-none me-3 hover-warning">Home</a>
                <a href="{{ route('slot-profile') }}" class="text-white text-decoration-none">Profile</a>
                <a href="{{ route('slot-subjects') }}"
                    class="text-white text-decoration-none me-3 hover-warning">Subjects</a>
                <a href="{{ route('slot-contact') }}" class="text-white text-decoration-none">Contact </a>
            </nav>
        </div>
    </header>
    <main class="flex-grow-1">
        <h1 class="pb-2 my-4 mx-2">{{ $heading }}</h1>
        <div class="bg-white mx-2 p-4 rounded shadow-sm border
            border-secondary">
            {{ $slot }}
        </div>
    </main>

    <footer class="d-flex justify-content-center align-items-center  bg-danger text-white p-4">
        <span>Laravel Blade Activity 2026</span>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
</body>

</html>

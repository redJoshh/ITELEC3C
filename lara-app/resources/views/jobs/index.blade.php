<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Listings</title>
</head>

<body>
    <h1>{{ $title }}</h1>
    {{-- @if (!empty($jobs))
        <ul>
            @foreach ($jobs as $job)
                <li>{{ $job['title'] }} - {{ $job['location'] }}</li>
            @endforeach

        </ul>
    @else
        <p>No jobs available.</p>
    @endif --}}
    <ul>
        @forelse ($jobs as $job)
            @if ($job['title'] == 'Web Developer')
                @break;
            @endif
            <li>{{ $loop->iteration }}- {{ $job['title'] }} - {{ $job['location'] }}</li>
        @empty
            <p>No jobs available.</p>
        @endforelse
    </ul>
</body>

</html>

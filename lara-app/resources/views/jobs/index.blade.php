@extends('layout')

@section('content')
    <h1>Job Listings</h1>
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
            <li>{{ $loop->iteration }}- {{ $job }}</li>
        @empty
            <p>No jobs available.</p>
        @endforelse
    </ul>
@endsection

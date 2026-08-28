<x-layout>
    <x-slot:title>Student Portal - Subjects</x-slot:title>
    <x-slot:heading>Student's Subjects</x-slot:heading>

    @forelse($subjects as $subject)
        <li>{{ $loop->iteration }}. {{ $subject['title'] }}</li>
    @empty
        <h2>No subjects available.</h2>
    @endforelse
</x-layout>

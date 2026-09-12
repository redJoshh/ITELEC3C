<x-app-layout>

    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-white leading-tight uppercase tracking-widest">Choose your <span
                class="text-archer-neon">Trainer</span></h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-8">

            <div class="w-full lg:w-1/3">
                <div
                    class="bg-archer-charcoal shadow-2xl sm:rounded-lg border border-archer-neon p-6 relative overflow-hidden ">
                    <h3 class="text-xl font-bold text-white uppercase mb-6">Schedule Session</h3>
                    @if (session('success'))
                        <div
                            class="bg-green-900/50 border border-archer-neon text-black p-3 mb-6 rounded text-sm text-white font-bold">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('trainer.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <x-input-label for="trainer_name" value="Select Trainer"
                                class="text-gray-400 uppercase tracking-wide text-xs font-bold" />
                            <select name="trainer_name" id="trainer_name"
                                class="mt-1 block w-full bg-archer-dark border-gray-600 text-white focus:border-archer-neon focus:ring-archer-neon rounded-md shadow-sm">
                                <option value="" disabled selected>Choose a trainer</option>
                                @foreach ($trainers as $busseng => $specialization)
                                    <option value="{{ $busseng }}">
                                        {{ $busseng }} - {{ $specialization }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="booking_date" value="Date"
                                class="text-gray-400 uppercase tracking-wide text-xs font-bold" />
                            <x-text-input id="booking_date" name="booking_date" type="date"
                                class="mt-1 block w-full bg-archer-dark border-gray-600 text-white focus:border-archer-neon focus:ring-archer-neon" />
                        </div>
                        <div>
                            <x-input-label for="booking_time" value="Time"
                                class="text-gray-400 uppercase tracking-wide text-xs font-bold" />
                            <x-text-input id="booking_time" name="booking_time" type="time"
                                class="mt-1 block w-full bg-archer-dark border-gray-600 text-white focus:border-archer-neon focus:ring-archer-neon" />
                        </div>
                        <button type="submit"
                            class="w-full bg-archer-neon hover:bg-green-400 text-archer-dark font-extrabold py-3 px-4 rounded transition  mt-4 uppercase tracking-wide">
                            Confirm Booking
                        </button>
                    </form>
                </div>

            </div>
            <div class="w-full lg:w-2/3">
                <div class="bg-archer-charcoal shadow-2xl sm:rounded-lg border border-archer-neon p-6">
                    <h3 class="text-xl font-bold text-white uppercase mb-6">Your Bookings</h3>

                    @forelse ($bookings as $booking)
                        <div class="border-b border-gray-700 py-3 text-white">
                            <p class="font-bold">{{ $booking->trainer_name }}</p>
                            <p class="text-sm text-gray-400">
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                                at {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}
                            </p>
                            <span class="text-xs uppercase text-archer-neon">{{ $booking->status }}</span>
                        </div>
                    @empty
                        <p class="text-gray-400">No bookings yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

</x-app-layout>

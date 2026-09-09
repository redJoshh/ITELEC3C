<x-guest-layout>
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="text-center mb-16" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white uppercase tracking-tight">What We Can Help You With
            </h1>
            <div class="h-1 w-24 bg-archer-neon mx-auto mt-4 rounded"></div>
            <p class="mt-6 text-gray-300 text-lg max-w-2xl mx-auto">
                Whether you are looking for open access to the strength or structured guidance to break through a limit,
                we have a plan built for your goals.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-archer-charcoal border border-gray-700 rounded-xl overflow-hidden shadow-lg flex flex-col transition hover:border-archer-neon hover:-translate-y-2 duration-300"
                data-aos="fade-up" data-aos-delay="100">
                <div class="h-48 bg-archer-dark relative">
                    <img src="{{ asset('images/guest-home-image-8.png') }}" alt="Open Gym Area"
                        class="w-full h-full object-cover opacity-60">

                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <h3 class="text-2xl font-bold text-white mb-2 uppercase">Open Gym Access</h3>
                    <p class="text-gray-400 mb-6 flex-grow">
                        Full access to our state-of-the-art facility from 6:00 AM to 10:00 PM daily. No waiting for
                        squat racks, just you and the iron.
                    </p>
                    <ul class="space-y-3 mb-8 text-gray-300">
                        <li class="flex items-center"><span class="text-archer-neon mr-2">✓</span> Unrestricted strength
                            trainings</li>
                        <li class="flex items-center"><span class="text-archer-neon mr-2">✓</span> Free weights &
                            machines</li>
                        <li class="flex items-center"><span class="text-archer-neon mr-2">✓</span> Lockers & Keycard
                            access
                        </li>
                    </ul>
                    <a href="{{ route('register') }}"
                        class="mt-auto block text-center border-2 border-archer-neon text-archer-neon hover:bg-archer-neon hover:text-archer-dark font-extrabold py-3 rounded transition uppercase">
                        View Rates
                    </a>
                </div>
            </div>
            <div class="bg-archer-charcoal border border-gray-700 rounded-xl overflow-hidden shadow-lg flex flex-col transition hover:border-archer-neon hover:-translate-y-2 duration-300"
                data-aos="fade-up" data-aos-delay="200">
                <div class="h-48 bg-archer-dark relative">
                    <img src="{{ asset('images/guest-home-image-9.png') }}" alt="Open Gym Area"
                        class="w-full h-full object-cover object-middle opacity-60">

                </div>
                <div class="p-8 flex grow  flex-col">
                    <h3 class="text-2xl font-bold text-white mb-2 uppercase">1-on-1 Coaching</h3>
                    <p class="text-gray-400 mb-6 flex grow">
                        Work directly with our elite trainers. We design targeted hypertrophy or strength programs
                        focusing on progressive overload and precise lifting mechanics.
                    </p>
                    <ul class="space-y-3 mb-8 text-gray-300">
                        <li class="flex items-center"><span class="text-archer-neon mr-2">✓</span> Customized workout
                            splits</li>
                        <li class="flex items-center"><span class="text-archer-neon mr-2">✓</span> Form correction &
                            spotting</li>
                        <li class="flex items-center"><span class="text-archer-neon mr-2">✓</span> Bi-weekly progress
                            checks</li>
                    </ul>
                    <a href="{{ route('register') }}"
                        class="mt-auto block text-center border-2 border-archer-neon text-archer-neon hover:bg-archer-neon hover:text-archer-dark font-extrabold py-3 rounded transition uppercase">
                        Book a Session
                    </a>
                </div>
            </div>

        </div>
    </div>

</x-guest-layout>

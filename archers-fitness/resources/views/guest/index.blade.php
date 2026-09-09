<x-guest-layout>
    <div class="relative bg-archer-dark overflow-hidden rounded-xl border border-gray-800 shadow-2xl mb-16"
        data-aos="flip-right">
        <img src="{{ asset('images/guest-home-image-1.png') }}" alt="Archers Fitness Gym Floor"
            class="absolute inset-0 w-full h-full bg-black/70 object-cover opacity-30">
        <div
            class="relative z-10 px-6 py-24 sm:px-12 sm:py-32 lg:px-16 text-center lg:text-left flex flex-col lg:flex-row items-center justify-between">
            <div class="max-w-2xl" data-aos="flip-right" data-aos-delay="200">
                <h1 class="text-5xl sm:text-6xl font-extrabold text-white tracking-tight mb-4 uppercase">
                    Commit to be <span class="text-archer-neon">Fit</span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-300 mb-8">
                    State-of-the-art equipment, expert trainers, and a community built on discipline.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 lg:justify-start justify-center">
                    <a href="{{ route('register') }}"
                        class="bg-archer-neon hover:bg-green-400 text-archer-dark font-extrabold py-3 px-8 rounded-md transition  text-center">
                        Start a membership now!
                    </a>
                    <a href="{{ route('home-workouts', ['target' => 'upper-body']) }}"
                        class="border border-archer-neon text-archer-neon hover:bg-archer-neon hover:text-archer-dark font-bold py-3 px-8 rounded-md transition text-center">
                        Not ready to commit? Try out free workouts you can do at home!
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-16">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-extrabold text-white uppercase">Why Choose <span
                    class="text-archer-neon">Archers?</span></h2>
            <div class="h-1 w-24 bg-archer-neon mx-auto mt-4 rounded"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-archer-charcoal border border-gray-700 rounded-lg overflow-hidden shadow-lg transition hover:border-archer-neon"
                data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('images/guest-home-image-4.png') }}" alt="Heavy Weights"
                    class="w-full h-48 object-cover opacity-80">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2 uppercase">Top of the line Equipment</h3>
                    <p class="text-gray-400">Everything you need from power racks to isolation machines for serious
                        muscle growth.</p>
                </div>
            </div>


            <div class="bg-archer-charcoal border border-gray-700 rounded-lg overflow-hidden shadow-lg transition hover:border-archer-neon"
                data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('images/guest-home-image-2.png') }}" alt="Turf Training"
                    class="w-full h-48 object-cover opacity-80">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2 uppercase">Functional Turf</h3>
                    <p class="text-gray-400">Dedicated area for functional training and heavy lifting.</p>
                </div>
            </div>


            <div class="bg-archer-charcoal border border-gray-700 rounded-lg overflow-hidden shadow-lg transition hover:border-archer-neon"
                data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('images/guest-home-image-3.png') }}" alt="People-Focused Trainers"
                    class="w-full h-48 object-cover object-top opacity-80">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2 uppercase">People-Focused</h3>
                    <p class="text-gray-400">Trainers on stand-by to help you with your sets and achieve your fitness
                        goals.</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

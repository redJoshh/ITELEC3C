<x-guest-layout>
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white uppercase tracking-tight">Free <span
                    class="text-archer-neon">Workouts</span></h1>
            <div class="h-1 w-24 bg-archer-neon mx-auto mt-4 rounded"></div>
            <p class="mt-6 text-gray-300 text-lg max-w-2xl mx-auto">
                Still having doubts committing to us? We still want to support you and give you some basics! Select a
                target area below for a quick routine you can do anywhere, or check out our featured full-body guide.
            </p>
        </div>
        <div class="flex flex-wrap justify-center gap-4 mb-10" data-aos="fade-up">
            <a href="{{ route('home-workouts', ['target' => 'upper-body']) }}"
                class="px-6 py-2 rounded-full border border-archer-neon {{ request()->is('home-workouts/upper-body') ? 'bg-archer-neon text-archer-dark font-bold ' : 'text-archer-neon hover:bg-archer-neon hover:text-archer-dark font-medium transition' }}">Upper
                Body</a>
            <a href="{{ route('home-workouts', ['target' => 'lower-body']) }}"
                class="px-6 py-2 rounded-full border border-archer-neon {{ request()->is('home-workouts/lower-body') ? 'bg-archer-neon text-archer-dark font-bold ' : 'text-archer-neon hover:bg-archer-neon hover:text-archer-dark font-medium transition' }}">Lower
                Body</a>
            <a href="{{ route('home-workouts', ['target' => 'core']) }}"
                class="px-6 py-2 rounded-full border border-archer-neon {{ request()->is('home-workouts/core') ? 'bg-archer-neon text-archer-dark font-bold ' : 'text-archer-neon hover:bg-archer-neon hover:text-archer-dark font-medium transition' }}">Core</a>
        </div>

        <div class="bg-archer-charcoal border border-gray-700 rounded-xl p-8 text-center max-w-3xl mx-auto mb-20 shadow-2xl transition-all duration-300 hover:border-archer-neon"
            data-aos="fade-up" data-aos-delay="100">

            @if (strtolower($focusArea) === 'default')
                <h2 class="text-3xl font-bold text-white mb-4 uppercase">
                    <span class="text-archer-neon">Select a Target</span>
                </h2>
            @else
                <h2 class="text-3xl font-bold text-white mb-4 uppercase">Target: <span
                        class="text-archer-neon">{{ $focusArea }}</span>
                </h2>
            @endif


            <ul class="text-xl text-gray-300 leading-relaxed mb-8">
                @foreach ($routine as $exercise)
                    <li class="mb-2">{{ $exercise }}</li>
                @endforeach
            </ul>
            <div
                class="bg-archer-dark p-5 rounded-lg border-l-4 border-archer-neon text-left flex items-start shadow-inner">

                <p class="text-gray-400 text-sm leading-relaxed">
                    <strong class="text-white uppercase tracking-wide">Trainer's Note:</strong> Remember, strength
                    training is nothing without the proper diet. Even with bodyweight
                    routines, nutrition dictates your results. Make sure you are hitting your daily macros like a
                    solid
                    150g of protein and keeping up with your creatine intake to fuel muscle recovery and endurance.
                </p>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center bg-archer-dark p-8 md:p-12 rounded-2xl border border-gray-800 shadow-2xl"
            data-aos="fade-up" data-aos-delay="200">
            <div>
                <h2 class="text-3xl font-bold text-white uppercase mb-4 border-l-4 border-archer-neon pl-4">The Beginner
                    Blueprint</h2>
                <p class="text-gray-300 text-lg mb-6 leading-relaxed">
                    If you are just starting out or want a balanced, full-body session, follow this simple blueprint. It
                    covers all the fundamental movement patterns: squatting, pushing, pulling, and core stabilization.
                </p>
                <ul class="space-y-4 text-gray-400 mb-8 lg:mb-0">
                    <li class="flex items-center"><span class="text-archer-neon font-bold text-xl mr-3">01</span> Start
                        with light cardio to prep the joints.</li>
                    <li class="flex items-center"><span class="text-archer-neon font-bold text-xl mr-3">02</span> Focus
                        strictly on form over speed.</li>
                    <li class="flex items-center"><span class="text-archer-neon font-bold text-xl mr-3">03</span> Rest
                        60-90 seconds between sets.</li>
                </ul>
            </div>


            <div class="flex justify-center lg:justify-end">
                <img src="{{ asset('images/guest-home-image-10.png') }}" alt="Archer's Fitness Simple Beginner Workout"
                    class="rounded-xl max-w-full h-auto border border-gray-700 hover:border-archer-neon transition duration-500">
            </div>
        </div>
    </div>
</x-guest-layout>

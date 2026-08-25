@extends ('layouts.app');

@section('title', 'Journey | Joselle')

@section('content')
    <section class="relative flex flex-col md:flex-row bg-theme-dark w-full">
        <div class="w-full md:w-1/2 h-[50vh] md:h-screen sticky top-0 overflow-hidden z-10">

            <img src="{{ asset('images/journey-1.jpeg') }}"
                class="journey-media absolute inset-0 w-full h-full object-cover object-center opacity-100 z-20">


            <img src="{{ asset('images/journey-2.jpg') }}"
                class="journey-media absolute inset-0 w-full h-full object-cover object-top opacity-0 z-10">



            <img src="{{ asset('images/journey-3.jpg') }}"
                class="journey-media absolute inset-0 w-full h-full object-cover object-center opacity-0 z-10">


            <div
                class="hidden md:block absolute inset-0 bg-gradient-to-r from-transparent via-theme-dark/20 to-theme-dark z-30 pointer-events-none">
            </div>
            <div
                class="block md:hidden absolute inset-0 bg-gradient-to-t from-theme-dark to-transparent z-30 pointer-events-none">
            </div>
        </div>
        <div class="w-full md:w-1/2 relative z-20 px-8 py-16 md:py-0 md:pl-16 lg:pl-24">


            <div class="hidden md:block h-[30vh]"></div>


            <!-- Chapter 1 -->
            <div class="chapter min-h-[70vh] md:min-h-screen flex flex-col justify-center pr-8 md:pr-16 max-w-xl">
                <h3 class="font-sans text-theme-pink tracking-[0.2em] uppercase text-xs font-bold">Chapter I</h3>
                <h2 class="font-brand text-5xl md:text-7xl text-theme-light mt-4">The Student</h2>
                <p class="font-sans text-theme-light/80 text-sm md:text-base leading-relaxed mt-6">
                    Before the stage lights, Joselle was just a veterinary student who enjoyed watching pageantry. She
                    enjoyed being an inspiration while tending care to animals, but she never imagined that she would
                    one day be the one inspiring others on stage. Her journey began with a simple desire to make a
                    difference, and it was through her dedication to both her studies and her community that she found
                    her true calling.
                </p>
            </div>

            <!-- Chapter 2 -->
            <div class="chapter min-h-[70vh] md:min-h-screen flex flex-col justify-center pr-8 md:pr-16 max-w-xl">
                <h3 class="font-sans text-theme-pink tracking-[0.2em] uppercase text-xs font-bold">Chapter II</h3>
                <h2 class="font-brand text-5xl md:text-7xl text-theme-light mt-4">The Advocate</h2>
                <p class="font-sans text-theme-light/80 text-sm md:text-base leading-relaxed mt-6">
                    Being present with the different social issues, Joselle realized that pageantry was a step, an
                    initiative in making a positive change in the community. She realized that this was an opportunity,
                    an opportunity to use her glamour and voice to advocate for the causes she believed in. She became a
                    passionate advocate for mental health awareness, using her platform to educate and inspire others to
                    take action.
                </p>
            </div>

            <!-- Chapter 3 -->
            <div class="chapter min-h-[70vh] md:min-h-screen flex flex-col justify-center pr-8 md:pr-16 max-w-xl">
                <h3 class="font-sans text-theme-pink tracking-[0.2em] uppercase text-xs font-bold">Chapter III</h3>
                <h2 class="font-brand text-5xl md:text-7xl text-theme-light mt-4">The Stage</h2>
                <p class="font-sans text-theme-light/80 text-sm md:text-base leading-relaxed mt-6">
                    The stage has been set! With the support of her family, mentors, and friends, Joselle has stepped
                    into the world of pageantry with grace and determination. She has embraced the challenges and
                    triumphs that come with competing, and she continues to inspire others with her poise, confidence,
                    and authenticity. Her journey is a testament to the power of perseverance, passion, and purpose. She
                    became Ms. CVMAS 2025 and the Ms. DLSAU Ambassador 2026 at the De La Salle Araneta University. The
                    future is bright for Joselle, and she is excited to continue her journey, making a difference one
                    step at a time.
                </p>

                <div class="pt-10">
                    <a href="{{ route('advocacy') }}"
                        class="inline-flex items-center justify-center px-8 py-3 bg-theme-dark border border-theme-pink text-theme-light font-sans text-xs tracking-widest uppercase hover:bg-theme-pink hover:text-white transition-all duration-300">
                        Read her advocacy &rarr;
                    </a>
                </div>
            </div>

            <div class="h-[20vh]"></div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (!window.gsap || !window.ScrollTrigger) return;


            const chapters = window.gsap.utils.toArray('.chapter');
            const journeyMedia = window.gsap.utils.toArray('.journey-media');


            const crossfadeMedia = (activeIndex) => {
                journeyMedia.forEach((img, i) => {
                    window.gsap.to(img, {
                        opacity: i === activeIndex ? 1 : 0,
                        duration: 0.8,
                        ease: "power2.inOut",
                        zIndex: i === activeIndex ? 20 : 10
                    });
                });
            };


            chapters.forEach((chapter, index) => {
                window.ScrollTrigger.create({
                    trigger: chapter,
                    start: "top center",

                    end: "bottom center",

                    onEnter: () => crossfadeMedia(index),

                    onEnterBack: () => crossfadeMedia(index),
                });
            });
        });
    </script>
@endpush

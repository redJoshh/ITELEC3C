@extends ('layouts.app')

@section('title', 'Gallery | Joselle')

@section('content')
    <section class="h-screen flex flex-col items-center justify-center px-4 bg-theme-dark relative z-10">
        <h1 class="intro-title opacity-0 font-heading italic text-5xl md:text-7xl text-theme-pink drop-shadow-md">
            The Collection
        </h1>
        <p class="intro-subtitle opacity-0 mt-4 font-sans text-theme-light/70 uppercase tracking-[0.2em] text-xs">
            Scroll to Explore
        </p>

    </section>
    <section id="gallery-wrapper" class="relative overflow-hidden bg-theme-dark">


        <div id="gallery-track" class="flex h-screen w-max items-center gap-16 md:gap-32 px-[10vw] md:px-[20vw]">

            <!-- Gallery Item 1 -->
            <div class="shrink-0 relative">
                <div
                    class="relative h-[75vh] md:h-[85vh] aspect-[3/4] md:aspect-[4/5] overflow-hidden group shadow-2xl rounded-[3rem]">
                    <img src="{{ asset('images/gallery-1.jpg') }}"
                        class="w-full h-full object-cover object-center grayscale group-hover:grayscale-0 transition-all duration-1000"
                        alt="Joselle Portrait 1">
                    <div
                        class="absolute bottom-8 left-8 bg-theme-dark/90 backdrop-blur px-6 py-3 border-l-2 border-theme-pink transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <h3 class="font-brand text-3xl text-theme-light">Empathetic</h3>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 2 -->
            <div class="shrink-0 relative">
                <div
                    class="relative h-[75vh] md:h-[85vh] aspect-[3/4] md:aspect-[4/5] overflow-hidden group shadow-2xl rounded-[3rem]">
                    <img src="{{ asset('images/gallery-2.jpg') }}"
                        class="w-full h-full object-cover object-center grayscale group-hover:grayscale-0 transition-all duration-1000"
                        alt="Joselle Portrait 2">
                    <div
                        class="absolute bottom-8 left-8 bg-theme-dark/90 backdrop-blur px-6 py-3 border-l-2 border-theme-pink transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <h3 class="font-brand text-3xl text-theme-light">Ambitious</h3>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 3 -->
            <div class="shrink-0 relative">
                <div
                    class="relative h-[75vh] md:h-[85vh] aspect-[3/4] md:aspect-[4/5] overflow-hidden group shadow-2xl rounded-[3rem]">
                    <img src="{{ asset('images/gallery-3.jpg') }}"
                        class="w-full h-full object-cover object-center grayscale group-hover:grayscale-0 transition-all duration-1000"
                        alt="Joselle Portrait 3">
                    <div
                        class="absolute bottom-8 left-8 bg-theme-dark/90 backdrop-blur px-6 py-3 border-l-2 border-theme-pink transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <h3 class="font-brand text-3xl text-theme-light">Compassionate</h3>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 4 -->
            <div class="shrink-0 relative">
                <div
                    class="relative h-[75vh] md:h-[85vh] aspect-[3/4] md:aspect-[4/5] overflow-hidden group shadow-2xl rounded-[3rem]">
                    <img src="{{ asset('images/gallery-4.jpg') }}"
                        class="w-full h-full object-cover object-center grayscale group-hover:grayscale-0 transition-all duration-1000"
                        alt="Joselle Portrait 4">
                    <div
                        class="absolute bottom-8 left-8 bg-theme-dark/90 backdrop-blur px-6 py-3 border-l-2 border-theme-pink transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <h3 class="font-brand text-3xl text-theme-light">Sentimental</h3>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 5 -->
            <div class="shrink-0 relative">
                <div
                    class="relative h-[75vh] md:h-[85vh] aspect-[3/4] md:aspect-[4/5] overflow-hidden group shadow-2xl rounded-[3rem]">
                    <img src="{{ asset('images/gallery-5.png') }}"
                        class="w-full h-full object-cover object-center grayscale group-hover:grayscale-0 transition-all duration-1000"
                        alt="Joselle Portrait 5">
                    <div
                        class="absolute bottom-8 left-8 bg-theme-dark/90 backdrop-blur px-6 py-3 border-l-2 border-theme-pink transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <h3 class="font-brand text-3xl text-theme-light">Resilient</h3>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="py-24 flex items-center justify-center bg-theme-dark">
        <a href="{{ route('support') }}"
            class="font-sans uppercase tracking-widest text-sm text-theme-light hover:text-theme-pink transition-colors">
            Send her your support! &rarr;
        </a>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.gsap && window.ScrollTrigger) {

                // 1. The Intro Reveal Animation
                const introTl = window.gsap.timeline({
                    defaults: {
                        ease: 'power3.out'
                    }
                });

                introTl.fromTo('.intro-title', {
                        opacity: 0,
                        y: 40
                    }, {
                        opacity: 1,
                        y: 0,
                        duration: 1.2,
                        delay: 0.2
                    })
                    .fromTo('.intro-subtitle', {
                            opacity: 0,
                            y: 20
                        }, {
                            opacity: 1,
                            y: 0,
                            duration: 1
                        },
                        "-=0.8"
                    )
                    .fromTo('.intro-line', {
                            opacity: 0,
                            scaleY: 0
                        }, {
                            opacity: 0.5,
                            scaleY: 1,
                            duration: 1.2
                        },
                        "-=0.6"
                    );


                const track = document.getElementById('gallery-track');

                window.gsap.to(track, {
                    x: () => -(track.scrollWidth - window.innerWidth) + "px",
                    ease: "none",
                    scrollTrigger: {
                        trigger: "#gallery-wrapper",
                        pin: true,
                        scrub: 1,
                        end: () => "+=" + track.offsetWidth,
                        invalidateOnRefresh: true
                    }
                });
            }
        });
    </script>
@endpush

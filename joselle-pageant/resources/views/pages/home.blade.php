@extends('layouts.app')
@section('title', 'Joselle Martinez | Official Pageant Portfolio')
@section('content')
    <section class="relative h-screen w-full flex items-center  overflow-hidden bg-theme-dark">
        <div id="scene" class="absolute right-0 top-0 w-full md:w-1/2 h-full z-0">
            <div data-depth="0.1" class=" absolute inset-0 w-full h-full scale-105">
                <img src="{{ asset('images/home_background.jpg') }}" alt="Joselle Martinez"
                    class="w-full h-full object-cover object-middle">
                <div
                    class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-theme-dark via-theme-dark/80 md:via-theme-dark/40 to-transparent">
                </div>
            </div>
        </div>

        <div class="relative z-20 w-full md:w-1/2 px-8 md:pl-16 lg:pl-24">
            <div class="max-w-xl space-y-6 text-left">

                <h1
                    class="font-brand text-6xl md:text-8xl text-theme-light leading-tight opacity-0 home-title drop-shadow-lg">
                    Faith<br>
                    <span class="text-theme-pink">in the Future</span>
                </h1>

                <p
                    class="home-sub font-sans text-theme-light/90 text-sm md:text-base leading-relaxed opacity-0 home-text font-medium drop-shadow-md">
                    Advocate, Ambassador, and Leader. Journey through the elegance, purpose, and dedication that defines
                    true pageantry.
                </p>

                <div class="opacity-0 home-btn pt-6 flex items-center space-x-6">
                    <a href="{{ route('journey') }}"
                        class="inline-flex items-center justify-center px-8 py-3 bg-theme-dark border border-theme-pink text-theme-light font-sans text-xs tracking-widest uppercase hover:bg-theme-pink hover:text-white transition-all duration-300">
                        Discover Her Story
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            if (window.gsap) {
                const homeTimeline = window.gsap.timeline({
                    defaults: {
                        ease: 'power3.out'
                    }
                });

                homeTimeline.to('.home-sub', {
                        opacity: 1,
                        y: -10,
                        duration: 1,
                        delay: 0.2
                    })
                    .to('.home-title', {
                        opacity: 1,
                        scale: 1.05,
                        duration: 1.2
                    }, "-=0.6")
                    .to('.home-text', {
                        opacity: 1,
                        y: -5,
                        duration: 1
                    }, "-=0.8")
                    .to('.home-btn', {
                        opacity: 1,
                        y: -5,
                        duration: 1
                    }, "-=0.8");
            }


            const scene = document.getElementById('scene');
            if (scene && window.Parallax) {
                new window.Parallax(scene);
            }
        });
    </script>
@endpush

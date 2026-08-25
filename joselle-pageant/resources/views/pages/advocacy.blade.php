@extends ('layouts.app');

@section('title', 'Advocacy | Joselle')

@section('content')
    <section class="relative h-screen w-full overflow-hidden flex items-center bg-theme-dark">
        <div class="absolute left-0 top-0 w-full md:w-1/2 h-full z-20 overflow-hidden">
            <div id="advocacy-scene" class="absolute inset-0 w-full h-full pointer-events-none">

                <div data-depth="0.15" class="absolute inset-0 w-full h-full object-middle scale-100">
                    <img src="{{ asset('images/advocacy_picture.jpg') }}" alt="Joselle Advocacy"
                        class="advocacy-main-img w-full h-full object-cover object-center md:object-[50%_20%] opacity-0" />
                </div>
            </div>


            <div
                class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-l from-theme-dark via-theme-dark/80 md:via-theme-dark/30 to-transparent z-10">
            </div>
        </div>
        <div class="absolute right-0 top-0 w-full md:w-1/2 h-full z-0 overflow-hidden">
            <div class="advocacy-bg absolute inset-0 opacity-0">
                <img src="{{ asset('images/advocacy_background-1.jpeg') }}"
                    class="w-full h-full object-cover grayscale opacity-25">
            </div>
            <div class="advocacy-bg absolute inset-0 opacity-0">
                <img src="{{ asset('images/advocacy_background-2.jpeg') }}"
                    class="w-full h-full object-cover grayscale opacity-25">
            </div>
            <div class="advocacy-bg absolute inset-0 opacity-0">
                <img src="{{ asset('images/advocacy_background-3.jpeg') }}"
                    class="w-full h-full object-cover grayscale opacity-25">
            </div>
            <div class="absolute inset-0 bg-theme-dark/80"></div>
        </div>

        <div
            class="relative mt-[3rem] z-30 w-full md:w-1/2 ml-auto px-8 md:pr-16 lg:pr-24 flex flex-col justify-center h-full text-right pointer-events-auto">
            <div class="max-w-xl ml-auto space-y-6">

                <h2 class="font-heading italic text-2xl md:text-3xl text-theme-pink opacity-0 text-reveal">
                    PAWS for THOUGHT
                </h2>

                <h1
                    class="font-brand text-6xl md:text-8xl text-theme-light leading-tight opacity-0 text-reveal drop-shadow-lg">
                    Compassion<br>
                    <span class="text-white">That Heals</span>
                </h1>

                <p
                    class="font-sans text-theme-light/90 text-sm md:text-base leading-relaxed opacity-0 text-reveal drop-shadow-md">
                    Literally paying homage to the paws of our fur friends, but this time I urge all to Pause and listen.
                    As a veterinary medicine student, I have seen how animals respond to patience, gentleness, and care.
                    They do not ask for perfection, only presence. And in that simple truth, I realized that the same
                    compassion that heals animals can also heal people, especially the youth.
                    This is the heart of my advocacy: supporting students’ mental well-being by teaching empathy through
                    responsible animal care. In schools, PAWS for THOUGHT can be implemented through safe partnerships with
                    local shelters through animal-assisted wellness sessions which would inspire students like us.
                    Today, I invite everyone to take a PAWS for THOUGHT.
                    PAWS to reflect.
                    PAWS to care.
                    And PAWS to act.
                    Because when we teach compassion for animals, we nurture kinder, healthier, and more empathetic young
                    minds.
                </p>

                <div class="opacity-0 text-reveal py-6 flex justify-end">
                    <a href="{{ route('gallery') }}"
                        class="inline-flex items-center justify-center px-8 py-3 bg-theme-dark border border-theme-pink text-theme-light font-sans text-xs tracking-widest uppercase hover:bg-theme-pink hover:text-white transition-all duration-300">
                        View The Gallery
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {


            const scene = document.getElementById('advocacy-scene');
            if (scene && window.Parallax) {
                new window.Parallax(scene, {
                    relativeInput: true,
                    hoverOnly: true
                });
            }

            if (!window.gsap) return;

            const advocacyTimeline = window.gsap.timeline({
                defaults: {
                    ease: 'power3.out'
                }
            });


            advocacyTimeline.fromTo('.advocacy-main-img', {
                    opacity: 0,
                    scale: 1.15
                }, {
                    opacity: 1,
                    scale: 1,
                    duration: 1.8
                })

                .fromTo('.text-reveal', {
                        opacity: 0,
                        x: 40
                    }, {
                        opacity: 1,
                        x: 0,
                        duration: 1,
                        stagger: 0.15
                    },
                    "-=1.2"
                );


            const advocacyBGs = document.querySelectorAll('.advocacy-bg');
            if (advocacyBGs.length > 0) {
                const backgroundTimeline = window.gsap.timeline({
                    repeat: -1
                });

                advocacyBGs.forEach((bg, index) => {
                    const img = bg.querySelector('img');
                    const startTime = index * 4;

                    backgroundTimeline.to(bg, {
                            opacity: 1,
                            duration: 2,
                            ease: "none"
                        }, startTime)
                        .fromTo(img, {
                                scale: 1
                            }, {
                                scale: 1.15,
                                duration: 6,
                                ease: "none"
                            },
                            startTime
                        )
                        .to(bg, {
                            opacity: 0,
                            duration: 2,
                            ease: "none"
                        }, startTime + 4);
                });
            }
        });
    </script>
@endpush

@extends('layouts.app')
@section('title', 'Joselle | Support Her!')
@section('content')
    <section class="relative min-h-screen flex flex-col md: flex-row bg-theme-dark w-full pt-20 md:pt-0">
        <div class="w-full md:w-1/2 flex flex-col justify-center px-8 py-12 md:pl-16 lg:pl-24">
            <h3 class="font-sans text-theme-pink tracking-[0.2em] uppercase text-xs font-bold mb-4">Support Joselle</h3>
            <h1 class="font-brand text-5xl md:text-7xl text-theme-light leading-tight">
                Stand With<br>
                <span class="text-white">Joselle</span>
            </h1>
            <p class="font-sans text-theme-light/80 text-sm md:text-base leading-relaxed mt-6 max-w-md">
                Whether it is an encouraging word for the upcoming pageant or a pledge to support the PAWS for THOUGHT
                advocacy, your voice matters. Leave a message here.
            </p>
        </div>
        <div class="w-full md:w-1/2 flex items-center justify-center px-8 pb-20 md:py-0 md:pr-16 lg:pr-24">
            <div class="w-full max-w-md bg-theme-dark/50 border border-theme-light/10 p-8 shadow-2xl backdrop-blur-sm">


                @if (session('success'))
                    <div class="mb-6 p-4 border border-green-500/50 bg-green-500/10 text-green-400 font-sans text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('support.submit') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name"
                            class="block font-sans text-xs tracking-widest uppercase text-theme-light/70 mb-2">Your
                            Name</label>
                        <input type="text" name="name" id="name" required
                            class="w-full bg-transparent border-b border-theme-light/20 text-theme-light py-2 focus:outline-none focus:border-theme-pink transition-colors">
                    </div>

                    <div>
                        <label for="message"
                            class="block font-sans text-xs tracking-widest uppercase text-theme-light/70 mb-2">Support
                            Message</label>
                        <textarea name="message" id="message" rows="4" required
                            class="w-full bg-transparent border-b border-theme-light/20 text-theme-light py-2 focus:outline-none focus:border-theme-pink transition-colors resize-none"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full inline-flex items-center justify-center px-8 py-4 bg-theme-pink text-white font-sans text-xs tracking-widest uppercase hover:bg-white hover:text-theme-dark transition-all duration-300">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-graduate font-bold text-2xl text-white leading-tight uppercase tracking-widest">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-archer-charcoal overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700">
                <div class="p-8 border-b border-gray-800">
                    <h3 class="text-3xl font-bold uppercase mb-3 font-graduate text-white">
                        {{ $post->title }}
                    </h3>
                    <div class="flex items-center gap-3 text-sm text-gray-400">
                        <span class="text-archer-neon font-bold">{{ $post->user->name }}</span>

                        <span>{{ $post->created_at->format('F d, Y') }}</span>
                    </div>
                </div>

                <div class="p-8 pt-0">
                    <p class="text-gray-300 font-playfair leading-relaxed whitespace-pre-line">
                        {{ $post->body }}
                    </p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('dashboard') }}"
                    class="text-archer-neon hover:text-white uppercase text-sm font-bold">
                    Back to Dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>

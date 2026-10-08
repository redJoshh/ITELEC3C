<x-app-layout>
    <x-slot name="header">
        <h2 class="font-graduate font-bold text-2xl text-white leading-tight uppercase tracking-widest">
            {{ __('Create a Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div
                    class="bg-archer-dark font-graduate border-l-4 border-archer-neon text-white p-4 mb-8 rounded shadow-lg flex justify-between items-center">
                    <p class="font-bold tracking-wide">{{ session('success') }}</p>
                    <button onclick="this.parentElement.style.display='none'"
                        class="text-archer-neon hover:text-white font-bold text-xl">&times;</button>
                </div>
            @endif
            @if ($errors->any())
                <div
                    class="bg-archer-dark font-graduate border-l-4 border-red-500 text-white p-4 mb-8 rounded shadow-lg">
                    <p class="font-bold uppercase tracking-wide mb-2">Invalid inputs! Please fix the following:</p>
                    <ul class="list-disc list-inside text-sm text-gray-300 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-archer-charcoal overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700 p-8">
                <h3
                    class="text-2xl font-bold uppercase mb-2 font-graduate text-white border-l-4 border-archer-neon pl-3">
                    Share Your Progress
                </h3>
                <p class="text-gray-400 font-playfair mb-6">
                    Submit a workout log, testimonial, or update for the Archers Fitness community.
                </p>

                <form action="{{ route('posts.submit') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="title"
                            class="block text-sm font-bold text-gray-300 mb-2 uppercase tracking-wide">
                            Title
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full bg-archer-dark border border-gray-600 rounded-md py-3 px-4 text-white focus:outline-none focus:border-archer-neon focus:ring-1 focus:ring-archer-neon transition"
                            placeholder="e.g., My First Month Progress">
                    </div>

                    <div>
                        <label for="body"
                            class="block text-sm font-bold text-gray-300 mb-2 uppercase tracking-wide">
                            Your Story
                        </label>
                        <textarea id="body" name="body" rows="8"
                            class="w-full bg-archer-dark border border-gray-600 rounded-md py-3 px-4 text-white focus:outline-none focus:border-archer-neon focus:ring-1 focus:ring-archer-neon transition"
                            placeholder="Tell us about your journey...">{{ old('body') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-archer-neon hover:bg-green-400 text-archer-dark font-extrabold py-3 px-4 rounded uppercase text-sm transition">
                        Submit Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

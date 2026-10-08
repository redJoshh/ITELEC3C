<x-app-layout>
    <x-slot name="header">
        <h2 class="font-graduate font-bold text-2xl text-white leading-tight uppercase tracking-widest">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-archer-charcoal overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700 p-8">
                <h3
                    class="text-2xl font-bold uppercase mb-6 font-graduate text-white border-l-4 border-archer-neon pl-3">
                    Editing: <span class="text-archer-neon">{{ $post->title }}</span>
                </h3>
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
                <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="title"
                            class="block text-sm font-bold text-gray-300 mb-2 uppercase tracking-wide">
                            Title
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                            class="w-full bg-archer-dark border border-gray-600 rounded-md py-3 px-4 text-white focus:outline-none focus:border-archer-neon focus:ring-1 focus:ring-archer-neon transition">
                    </div>

                    <div>
                        <label for="body"
                            class="block text-sm font-bold text-gray-300 mb-2 uppercase tracking-wide">
                            Content
                        </label>
                        <textarea id="body" name="body" rows="8"
                            class="w-full bg-archer-dark border border-gray-600 rounded-md py-3 px-4 text-white focus:outline-none focus:border-archer-neon focus:ring-1 focus:ring-archer-neon transition">{{ old('body', $post->body) }}</textarea>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex-1 text-center bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded uppercase text-sm transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="flex-1 bg-archer-neon hover:bg-green-400 text-archer-dark font-extrabold py-3 px-4 rounded uppercase text-sm transition">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

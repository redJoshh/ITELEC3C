<x-app-layout>
    <x-slot name="header">
        <h2 class="font-graduate font-bold text-2xl text-white leading-tight uppercase tracking-widest">
            {{ __('Add New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">



            <div class="bg-archer-charcoal overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700 p-8">
                <h3
                    class="text-2xl font-bold uppercase mb-6 font-graduate text-white border-l-4 border-archer-neon pl-3">
                    New Post
                </h3>

                <form action="{{ route('admin.posts.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-300 mb-2 uppercase tracking-wide">
                            Title
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full bg-archer-dark border border-gray-600 rounded-md py-3 px-4 text-white focus:outline-none focus:border-archer-neon focus:ring-1 focus:ring-archer-neon transition"
                            placeholder="e.g., Push-Pull or Upper-Lower">
                    </div>

                    <div>
                        <label for="body"
                            class="block text-sm font-bold text-gray-300 mb-2 uppercase tracking-wide">
                            Content
                        </label>
                        <textarea id="body" name="body" rows="8"
                            class="w-full bg-archer-dark border border-gray-600 rounded-md py-3 px-4 text-white focus:outline-none focus:border-archer-neon focus:ring-1 focus:ring-archer-neon transition"
                            placeholder="Write the full post content here..."></textarea>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex-1 text-center bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded uppercase text-sm transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="flex-1 bg-archer-neon hover:bg-green-400 text-archer-dark font-extrabold py-3 px-4 rounded uppercase text-sm transition">
                            Publish Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

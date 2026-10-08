<x-app-layout>
    <x-slot name="header">
        <h2 class="font-graduate font-bold text-2xl text-white leading-tight uppercase tracking-widest">
            {{ __('Admin Dashboard') }}</h2>
    </x-slot>

    <div x-data="{ confirmingDelete: false, deleteId: null }" class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    class="bg-archer-dark font-graduate border-l-4 border-archer-neon text-white p-4 mb-8 rounded shadow-lg flex justify-between items-center">
                    <p class="font-bold tracking-wide">{{ session('success') }}</p>
                    <button onclick="this.parentElement.style.display='none'"
                        class="text-archer-neon hover:text-white font-bold text-xl">&times;</button>
                </div>
            @elseif (session('error'))
                <div
                    class="bg-archer-dark font-graduate border-l-4 border-red-500 text-white p-4 mb-8 rounded shadow-lg flex justify-between items-center">
                    <p class="font-bold tracking-wide">{{ session('error') }}</p>
                    <button onclick="this.parentElement.style.display='none'"
                        class="text-red-500 hover:text-white font-bold text-xl">&times;</button>
                </div>
            @endif

            <div class="bg-archer-charcoal overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700 mb-8">
                <div
                    class="p-6 text-white border-b border-gray-800 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h3 class="text-3xl font-bold uppercase mb-2 font-graduate">
                            Welcome, <span class="text-archer-neon">{{ Auth::user()->name }}</span>
                        </h3>
                        <p class="text-gray-400 font-playfair">Manage fitness posts and content here. Post your workout
                            routine and more!</p>
                    </div>

                    <div class="mt-4 md:mt-0 bg-archer-dark px-6 py-4 rounded-lg border border-archer-neon text-center">
                        <p class="text-sm text-gray-400 uppercase tracking-wide mb-1">Total Posts</p>
                        <p class="text-2xl font-extrabold text-archer-neon font-graduate">{{ $posts->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-archer-charcoal shadow-lg sm:rounded-lg border border-archer-neon p-6">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-xl font-graduate font-bold text-white uppercase border-l-4 border-archer-neon pl-3">
                        All Posts
                    </h4>
                    <a href="{{ route('admin.posts.create') }}"
                        class="bg-archer-neon hover:bg-green-400 text-archer-dark font-extrabold py-2 px-6 rounded text-sm uppercase transition">
                        + Add Post
                    </a>

                </div>

                @if ($posts->isEmpty())
                    <p class="text-gray-400 font-playfair text-center py-8">No posts yet. Create the first one.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-700 text-gray-400 uppercase text-xs tracking-wide">
                                    <th class="py-3 pr-4">Title</th>
                                    <th class="py-3 pr-4">Author</th>
                                    <th class="py-3 pr-4">Posted</th>
                                    <th class="py-3 pr-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr class="border-b border-gray-800 text-white">
                                        <td class="py-3 pr-4 font-semibold">{{ $post->title }}</td>
                                        <td class="py-3 pr-4 text-gray-400">{{ $post->user->name }}</td>
                                        <td class="py-3 pr-4 text-gray-400">{{ $post->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="py-3 pr-4 text-right space-x-3">
                                            <a href="{{ route('admin.posts.edit', $post) }}"
                                                class="text-archer-neon hover:text-white uppercase text-xs font-bold">Edit</a>
                                            <button @click="confirmingDelete = true; deleteId = {{ $post->id }}"
                                                class="text-red-500 hover:text-red-300 uppercase text-xs font-bold">
                                                Archive
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 flex justify-center">
                        {{ $posts->links() }}
                    </div>
                    <a href="{{ route('admin.posts.archived') }}"
                        class="text-gray-400 hover:text-red-400 uppercase text-sm font-bold">
                        View Archived Posts
                    </a>
                @endif
            </div>

        </div>

        <div x-show="confirmingDelete" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray bg-opacity-80 backdrop-blur-sm px-4"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100">
            <div class="bg-archer-charcoal border border-red-500 rounded-xl w-full max-w-md overflow-hidden"
                @click.away="confirmingDelete = false">
                <div class="bg-archer-dark p-6 border-b border-gray-800">
                    <h3 class="text-xl font-extrabold text-white uppercase tracking-wide">Archive Post?</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-400 font-playfair mb-6">This action cannot be undone.</p>
                    <form :action="'/admin/posts/' + deleteId" method="POST" class="flex gap-4">
                        @csrf
                        @method('DELETE')
                        <button type="button" @click="confirmingDelete = false"
                            class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded uppercase text-sm transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded uppercase text-sm transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

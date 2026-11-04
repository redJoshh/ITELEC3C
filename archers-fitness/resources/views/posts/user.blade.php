<x-app-layout>
    <x-slot name="header">
        <h2 class="font-graduate font-bold text-2xl text-white leading-tight uppercase tracking-widest">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="py-12 relative">
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

            <div class="bg-archer-charcoal shadow-lg sm:rounded-lg border border-archer-neon p-6">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-xl font-graduate font-bold text-white uppercase border-l-4 border-archer-neon pl-3">
                        Your Posts
                    </h4>
                    <a href="{{ route('posts.create') }}"
                        class="bg-archer-neon hover:bg-green-400 text-archer-dark font-extrabold py-2 px-6 rounded text-sm uppercase transition">
                        + New Post
                    </a>
                </div>

                @if ($posts->isEmpty())
                    <p class="text-gray-400 font-playfair text-center py-8">You haven't posted anything yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-700 text-gray-400 uppercase text-xs tracking-wide">
                                    <th class="py-3 pr-4">Image</th>
                                    <th class="py-3 pr-4">Title</th>
                                    <th class="py-3 pr-4">Posted</th>
                                    <th class="py-3 pr-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr class="border-b border-gray-800 text-white">
                                        <td class="py-3 pr-4">
                                            @if ($post->image_path)
                                                <img src="{{ asset('storage/' . $post->image_path) }}"
                                                    alt="{{ $post->title }}"
                                                    class="h-12 w-16 object-cover rounded border border-gray-700">
                                            @else
                                                <div
                                                    class="h-12 w-16 flex items-center justify-center rounded border border-gray-700 bg-archer-dark text-xs text-gray-500">
                                                    None
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-3 pr-4 font-semibold">
                                            <a href="{{ route('posts.show', $post->id) }}"
                                                class="hover:text-archer-neon transition">
                                                {{ $post->title }}
                                            </a>
                                        </td>
                                        <td class="py-3 pr-4 text-gray-400">{{ $post->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="py-3 pr-4 text-right">
                                            <div class="flex items-center justify-end gap-3">
                                                <a href="{{ route('posts.show', $post->id) }}"
                                                    class="text-gray-300 hover:text-white uppercase text-xs font-bold">View</a>
                                                <a href="{{ route('posts.edit', $post->id) }}"
                                                    class="text-archer-neon hover:text-white uppercase text-xs font-bold">Edit</a>

                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                    onsubmit="return confirm('Delete this post? This cannot be undone from your account.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:text-red-300 uppercase text-xs font-bold">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

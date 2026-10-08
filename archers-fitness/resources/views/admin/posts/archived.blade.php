<x-app-layout>
    <x-slot name="header">
        <h2 class="font-graduate font-bold text-2xl text-white leading-tight uppercase tracking-widest">
            {{ __('Trashed Posts') }}
        </h2>
    </x-slot>

    <div x-data="{ confirmingForceDelete: false, deleteId: null }" class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    class="bg-archer-dark font-graduate border-l-4 border-archer-neon text-white p-4 mb-8 rounded shadow-lg flex justify-between items-center">
                    <p class="font-bold tracking-wide">{{ session('success') }}</p>
                    <button onclick="this.parentElement.style.display='none'"
                        class="text-archer-neon hover:text-white font-bold text-xl">&times;</button>
                </div>
            @endif

            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-graduate font-bold text-white uppercase border-l-4 border-red-500 pl-3">
                    Deleted Posts
                </h3>
                <a href="{{ route('admin.dashboard') }}"
                    class="text-archer-neon hover:text-white uppercase text-sm font-bold">
                    &larr; Back to Dashboard
                </a>
            </div>

            <div class="bg-archer-charcoal shadow-lg sm:rounded-lg border border-gray-700 p-6">
                @if ($posts->isEmpty())
                    <p class="text-gray-400 font-playfair text-center py-8">No deleted posts.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-700 text-gray-400 uppercase text-xs tracking-wide">
                                    <th class="py-3 pr-4">Title</th>
                                    <th class="py-3 pr-4">Author</th>
                                    <th class="py-3 pr-4">Deleted On</th>
                                    <th class="py-3 pr-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr class="border-b border-gray-800 text-white">
                                        <td class="py-3 pr-4 font-semibold">{{ $post->title }}</td>
                                        <td class="py-3 pr-4 text-gray-400">{{ $post->user->name }}</td>
                                        <td class="py-3 pr-4 text-gray-400">{{ $post->deleted_at->format('M d, Y') }}
                                        </td>
                                        <td class="py-3 pr-4 text-right space-x-3">
                                            <form action="{{ route('admin.posts.restore', $post->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="text-archer-neon hover:text-white uppercase text-xs font-bold">
                                                    Restore
                                                </button>
                                            </form>
                                            <button
                                                @click="confirmingForceDelete = true; deleteId = {{ $post->id }}"
                                                class="text-red-500 hover:text-red-300 uppercase text-xs font-bold">
                                                Delete Forever
                                            </button>
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

        <!-- Permanent delete confirmation modal -->
        <div x-show="confirmingForceDelete" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray bg-opacity-80 backdrop-blur-sm px-4"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100">
            <div class="bg-archer-charcoal border border-red-500 rounded-xl w-full max-w-md overflow-hidden"
                @click.away="confirmingForceDelete = false">
                <div class="bg-archer-dark p-6 border-b border-gray-800">
                    <h3 class="text-xl font-extrabold text-white uppercase tracking-wide">Permanently Delete?</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-400 font-playfair mb-6">
                        This cannot be undone. The post will be <span class="text-red-500 font-bold">permanently
                            removed</span> from the database.
                    </p>
                    <form :action="'/admin/posts/' + deleteId + '/force-delete'" method="POST" class="flex gap-4">
                        @csrf
                        @method('DELETE')
                        <button type="button" @click="confirmingForceDelete = false"
                            class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded uppercase text-sm transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded uppercase text-sm transition">
                            Delete Forever
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

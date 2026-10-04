<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} {{ $userRole }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b bg-white hover:bg-gray-50">

                            {{-- ID --}}
                            <td class="px-6 py-4">
                                {{ $product->id }}
                            </td>

                            {{-- Name --}}
                            <td class="px-6 py-4">
                                <input type="text" value="{{ $product->name }}"
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 focus:border-blue-500 focus:ring-blue-500"
                                    readonly id="name-{{ $product->id }}">
                            </td>

                            {{-- Description --}}
                            <td class="px-6 py-4">
                                <input type="text" value="{{ $product->description }}"
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 focus:border-blue-500 focus:ring-blue-500"
                                    readonly id="description-{{ $product->id }}">
                            </td>

                            {{-- Price --}}
                            <td class="px-6 py-4">
                                <input type="number" step="0.01" value="{{ $product->price }}"
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 focus:border-blue-500 focus:ring-blue-500"
                                    readonly id="price-{{ $product->id }}">
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">

                                    {{-- Edit --}}
                                    <button type="button" onclick="enableEdit({{ $product->id }})"
                                        id="edit-btn-{{ $product->id }}"
                                        class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                                        Edit
                                    </button>

                                    {{-- Save --}}
                                    <form action="{{ route('products.update', $product->id) }}" method="POST"
                                        id="form-{{ $product->id }}" class="hidden">

                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="name" id="form-name-{{ $product->id }}">

                                        <input type="hidden" name="description"
                                            id="form-description-{{ $product->id }}">

                                        <input type="hidden" name="price" id="form-price-{{ $product->id }}">

                                        <button type="button" onclick="saveEdit({{ $product->id }})"
                                            class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700">
                                            Save
                                        </button>
                                    </form>

                                    {{-- Delete --}}
                                    <form action="{{ route('products.delete', $product->id) }}" method="POST"
                                        class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50">
                        <td colspan="5" class="px-6 py-4">
                            <a href="{{ route('products.create') }}"
                                class="inline-flex items-center rounded-lg bg-green-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300">

                                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4">
                                    </path>
                                </svg>

                                Create Product
                            </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <script>
            function enableEdit(id) {
                // Get the input fields
                const name = document.getElementById('name-' + id);
                const description = document.getElementById('description-' + id);
                const price = document.getElementById('price-' + id);

                // Make them editable
                name.removeAttribute('readonly');
                description.removeAttribute('readonly');
                price.removeAttribute('readonly');

                // Change background to indicate editing
                name.classList.remove('bg-gray-50');
                description.classList.remove('bg-gray-50');
                price.classList.remove('bg-gray-50');

                name.classList.add('bg-white');
                description.classList.add('bg-white');
                price.classList.add('bg-white');

                // Hide Edit button
                document.getElementById('edit-btn-' + id).classList.add('hidden');

                // Show Save button
                document.getElementById('form-' + id).classList.remove('hidden');
            }

            function saveEdit(id) {
                // Get values from the editable inputs
                document.getElementById('form-name-' + id).value =
                    document.getElementById('name-' + id).value;

                document.getElementById('form-description-' + id).value =
                    document.getElementById('description-' + id).value;

                document.getElementById('form-price-' + id).value =
                    document.getElementById('price-' + id).value;

                // Submit the form
                document.getElementById('form-' + id).submit();
            }
        </script>
    </div>
</x-app-layout>

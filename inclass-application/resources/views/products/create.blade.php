<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">

            <div class="rounded-lg bg-white p-6 shadow-sm">

                <form action="{{ route('products.store') }}" method="POST">

                    @csrf

                    {{-- Name --}}
                    <div class="mb-5">
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-900">
                            Product Name
                        </label>

                        <input type="text" name="name" id="name" required
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter product name">
                    </div>

                    {{-- Description --}}
                    <div class="mb-5">
                        <label for="description" class="mb-2 block text-sm font-medium text-gray-900">
                            Description
                        </label>

                        <textarea name="description" id="description" rows="4" required
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter product description"></textarea>
                    </div>

                    {{-- Price --}}
                    <div class="mb-5">
                        <label for="price" class="mb-2 block text-sm font-medium text-gray-900">
                            Price
                        </label>

                        <input type="number" name="price" id="price" step="0.01" min="0" required
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="0.00">
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-3">

                        <button type="submit"
                            class="rounded-lg bg-green-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-700">
                            Create Product
                        </button>

                        <a href="{{ route('products.index') }}"
                            class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-medium text-gray-800 hover:bg-gray-300">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>

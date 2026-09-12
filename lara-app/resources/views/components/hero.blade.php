@props([
    'title' => 'Find Your Dream Job',
])

<section class="relative bg-cover bg-center bg-no-repeat h-80 flex items-center justify-center"
    style="background-image: url('{{ asset('images/hero.jpg') }}');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/60 z-0 pointer-events-none"></div>

    <div class="container mx-auto text-center relative z-10 px-4">
        <h2 class="text-4xl md:text-5xl text-white font-bold mb-8">
            {{ $title }}
        </h2>
        <form class="flex flex-col md:flex-row justify-center items-center gap-2">
            <input type="text" name="keywords" placeholder="Keywords"
                class="w-full md:w-72 px-4 py-3 bg-white text-gray-800 rounded focus:outline-none" />
            <input type="text" name="location" placeholder="Location"
                class="w-full md:w-72 px-4 py-3 bg-white text-gray-800 rounded focus:outline-none" />
            <button type="submit"
                class="w-full md:w-auto bg-blue-700 hover:bg-blue-600 text-white px-6 py-3 rounded focus:outline-none font-semibold">
                <i class="fa fa-search mr-1"></i> Search
            </button>
        </form>
    </div>
</section>

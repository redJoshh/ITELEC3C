<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create a new product">
    <title>Create Product</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <main class="relative isolate min-h-screen overflow-hidden px-5 py-8 sm:px-8 lg:px-12">
        <div
            class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-80 bg-[radial-gradient(circle_at_top_right,_rgba(14,165,233,0.18),_transparent_62%),linear-gradient(to_bottom,_#e0f2fe,_transparent)]">
        </div>

        <div class="mx-auto max-w-6xl">
            <header class="mb-8 flex items-center justify-between gap-4">
                <a href="{{ url('/products') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-sky-700">
                    <span aria-hidden="true" class="text-lg">&larr;</span>
                    Products
                </a>
                <span
                    class="rounded-full border border-sky-200 bg-white/70 px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] text-sky-700">Catalog</span>
            </header>

            <div class="grid gap-8 lg:grid-cols-[0.8fr_1.6fr] lg:items-start">
                <section class="pt-2 lg:pt-10">
                    <p class="mb-3 text-sm font-bold uppercase tracking-[0.2em] text-sky-600">New listing</p>
                    <h1 class="max-w-md text-4xl font-semibold tracking-tight text-slate-950 sm:text-5xl">Create a
                        product people will remember.</h1>
                    <p class="mt-5 max-w-md text-base leading-7 text-slate-600">Add the essential details now and keep
                        your catalog ready for its next customer.</p>
                    <div class="mt-10 hidden border-l-2 border-sky-300 pl-5 text-sm leading-6 text-slate-500 lg:block">
                        <p class="font-semibold text-slate-700">A clear start makes a better catalog.</p>
                        <p class="mt-1">Use a concise name, a recognizable category, and an accurate price.</p>
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 sm:p-8">
                    <div class="mb-8 border-b border-slate-200 pb-6">
                        <h2 class="text-xl font-semibold text-slate-950">Product details</h2>
                        <p class="mt-1 text-sm text-slate-500">Fill in the information for this catalog item.</p>
                    </div>

                    <form action="#" method="get" class="space-y-6">
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Product
                                    name</label>
                                <input id="name" name="name" type="text"
                                    placeholder="e.g. Everyday Canvas Tote" required
                                    class="block w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100">
                            </div>

                            <div>
                                <label for="sku"
                                    class="mb-2 block text-sm font-semibold text-slate-700">SKU</label>
                                <input id="sku" name="sku" type="text" placeholder="e.g. BAG-001"
                                    class="block w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100">
                            </div>

                            <div>
                                <label for="category"
                                    class="mb-2 block text-sm font-semibold text-slate-700">Category</label>
                                <select id="category" name="category"
                                    class="block w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100">
                                    <option value="">Choose a category</option>
                                    <option>Apparel</option>
                                    <option>Accessories</option>
                                    <option>Home</option>
                                    <option>Electronics</option>
                                </select>
                            </div>

                            <div>
                                <label for="price"
                                    class="mb-2 block text-sm font-semibold text-slate-700">Price</label>
                                <div class="relative">
                                    <span
                                        class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-sm text-slate-500">$</span>
                                    <input id="price" name="price" type="number" min="0" step="0.01"
                                        placeholder="0.00" required
                                        class="block w-full rounded-lg border border-slate-300 bg-slate-50 py-3 pl-8 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100">
                                </div>
                            </div>

                            <div>
                                <label for="stock" class="mb-2 block text-sm font-semibold text-slate-700">Stock
                                    quantity</label>
                                <input id="stock" name="stock" type="number" min="0" placeholder="0"
                                    required
                                    class="block w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="description"
                                    class="mb-2 block text-sm font-semibold text-slate-700">Description <span
                                        class="font-normal text-slate-400">(optional)</span></label>
                                <textarea id="description" name="description" rows="4" placeholder="Describe what makes this product useful..."
                                    class="block w-full resize-none rounded-lg border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100"></textarea>
                            </div>
                        </div>

                        <div
                            class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">
                            <a href="{{ url('/products') }}"
                                class="inline-flex items-center justify-center rounded-lg px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">Cancel</a>
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-lg bg-sky-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-sky-600/20 transition hover:bg-sky-700 focus:outline-none focus:ring-4 focus:ring-sky-200">Create
                                product</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>
</body>

</html>

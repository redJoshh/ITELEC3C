<x-guest-layout>
    <div class="max-w-4xl mx-auto" data-aos="fade-up">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-white uppercase">Get In <span class="text-archer-neon">Touch</span>
            </h2>
            <div class="h-1 w-24 bg-archer-neon mx-auto mt-4 rounded"></div>
            <p class="mt-4 text-gray-400">Have questions about memberships, personal training, or our facilities? Feel
                free to reach out to us!</p>
        </div>

        <div class="bg-archer-charcoal border boder-gray-700 rounded-xl p-8 shadow-2xl">
            @if (session('success'))
                <div class="bg-archer-turf border-l-4 border-archer-neon text-white p-4 mb-6 rounded shadow-lg"
                    data-aos="fade-down">
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name"
                            class="block text-sm font-bold text-gray-300 mb-2 uppercase tracking-wide">Full Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name"
                            class="w-full bg-archer-dark border border-gray-600 rounded-md py-3 px-4 text-white focus:outline-none focus:border-archer-neon focus:ring-1 focus:ring-archer-neon transition"
                            placeholder="John Doe" required>
                    </div>
                    <div>
                        <label for="fbLink"
                            class="block text-sm font-bold text-gray-300 mb-2 uppercase tracking-wide">Facebook Profile
                            Link</label>
                        <input type="text" id="fbLink" name="fbLink"
                            class="w-full bg-archer-dark border border-gray-600 rounded-md py-3 px-4 text-white focus:outline-none focus:border-archer-neon focus:ring-1 focus:ring-archer-neon transition"
                            placeholder="https://www.facebook.com/redJoshh">
                    </div>
                </div>

                <div>
                    <label for="message"
                        class="block text-sm font-bold text-gray-300 mb-2 uppercase tracking-wide">Your Message <span
                            class="text-red-500">*</span></label>
                    <textarea id="message" name="message" rows="5"
                        class="w-full bg-archer-dark border border-gray-600 rounded-md py-3 px-4 text-white focus:outline-none focus:border-archer-neon focus:ring-1 focus:ring-archer-neon transition"
                        placeholder="How can we help you?" required></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-archer-neon hover:bg-green-400 text-archer-dark font-extrabold py-3 px-8 rounded-md transition text-lg uppercase tracking-wide">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>

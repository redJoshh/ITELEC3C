<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-white leading-tight uppercase tracking-widest">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div x-data="{ showModal: false, planType: 'standard' }" class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-archer-dark border-l-4 border-archer-neon text-white p-4 mb-8 rounded shadow-lg flex justify-between items-center"
                    data-aos="fade-down">
                    <p class="font-bold tracking-wide">{{ session('success') }}</p>
                    <button onclick="this.parentElement.style.display='none'"
                        class="text-archer-neon hover:text-white font-bold text-xl">&times;</button>
                </div>
            @elseif(session('error'))
                <div class="bg-archer-dark border-l-4 border-red-500 text-red p-4 mb-8 rounded shadow-lg flex justify-between items-center"
                    data-aos="fade-down">
                    <p class="font-bold tracking-wide">{{ session('error') }}</p>
                    <button onclick="this.parentElement.style.display='none'"
                        class="text-red-500 hover:text-white font-bold text-xl">&times;</button>
                </div>
            @endif

            <div class="bg-archer-charcoal overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700 mb-8"
                data-aos="fade-down">
                <div
                    class="p-6 text-white border-b border-gray-800 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h3 class="text-3xl font-bold uppercase mb-2">Welcome, <span
                                class="text-archer-neon">{{ Auth::user()->name }}</span></h3>
                        <p class="text-gray-400">Let's get your training journey started.</p>
                    </div>


                    @if (Auth::user()->membership)
                        <div
                            class="mt-4 md:mt-0 bg-archer-dark px-6 py-4 rounded-lg border border-archer-neon text-center ">
                            <p class="text-sm text-gray-400 uppercase tracking-wide mb-1">Status</p>
                            <p class="text-lg font-extrabold text-archer-neon uppercase mb-1">Membership:
                                {{ Auth::user()->membership->status }}</p>
                            <p class="text-xs text-white uppercase">{{ Auth::user()->membership->plan }} -
                                {{ Auth::user()->membership->billing }}</p>
                        </div>
                    @else
                        <div
                            class="mt-4 md:mt-0 bg-archer-dark px-6 py-4 rounded-lg border border-red-500 text-center ">
                            <p class="text-sm text-gray-400 uppercase tracking-wide mb-1">Status</p>
                            <p class="text-lg font-extrabold text-red-500 uppercase mb-3">No Active Plan</p>
                            <button @click="showModal = true"
                                class="bg-archer-neon hover:bg-green-400 text-archer-dark font-extrabold py-2 px-4 rounded text-sm uppercase transition w-full ">
                                Apply Now
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            @if (Auth::user()->membership && Auth::user()->membership->status == 'active')
                <div class="bg-archer-charcoal shadow-lg sm:rounded-lg border border-archer-neon p-6 "
                    data-aos="fade-up">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-xl font-bold text-white uppercase border-l-4 border-archer-neon pl-3">Today's
                            Agenda</h4>
                        <span
                            class="text-xs font-bold text-archer-dark bg-archer-neon uppercase tracking-widest px-3 py-1 rounded">Metrics
                            Unlocked</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Book a Trainer CTA -->
                        <div
                            class="bg-archer-dark p-5 rounded-lg border border-gray-800 text-center shadow-inner md:col-span-2 flex flex-col justify-center items-center">
                            <h5 class="text-lg font-bold text-white uppercase mb-2">Ready to work out?</h5>
                            <p class="text-sm text-gray-400 mb-5">Work 1-on-1 with our elite coaches to smash your
                                goals.</p>
                            <a href="{{ url('/book-trainer') }}"
                                class="bg-archer-neon hover:bg-green-400 text-archer-dark font-extrabold py-2 px-8 rounded uppercase transition  w-full sm:w-auto">
                                Book a Trainer
                            </a>
                        </div>


                        <div
                            class="bg-archer-dark p-5 rounded-lg border border-gray-800 text-center shadow-inner flex flex-col justify-center">
                            <p class="text-sm text-gray-400 uppercase tracking-wide font-bold mb-2">Height</p>
                            <p class="text-2xl font-extrabold text-white">
                                {{ Auth::user()->height ? Auth::user()->height . ' cm' : 'N/A' }}</p>
                            <a href="{{ route('profile.edit') }}"
                                class="text-xs text-archer-neon hover:text-white uppercase mt-2 inline-block">Update
                                &rarr;</a>
                        </div>


                        <div
                            class="bg-archer-dark p-5 rounded-lg border border-gray-800 text-center shadow-inner flex flex-col justify-center">
                            <p class="text-sm text-gray-400 uppercase tracking-wide font-bold mb-2">Weight</p>
                            <p class="text-2xl font-extrabold text-white">
                                {{ Auth::user()->weight ? Auth::user()->weight . ' kg' : 'N/A' }}</p>
                            <a href="{{ route('profile.edit') }}"
                                class="text-xs text-archer-neon hover:text-white uppercase mt-2 inline-block">Update
                                &rarr;</a>
                        </div>

                    </div>
                </div>
            @elseif(
                !Auth::user()->membership ||
                    Auth::user()->membership->status == 'inactive' ||
                    Auth::user()->membership->status == 'pending')
                <div
                    class="bg-archer-charcoal shadow-lg sm:rounded-lg border border-gray-700 p-6 opacity-50 select-none">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-xl font-bold text-white uppercase border-l-4 border-gray-500 pl-3">Unlock soon
                        </h4>
                        <span
                            class="text-xs font-bold text-gray-400 uppercase tracking-widest border border-gray-600 px-2 py-1 rounded shadow">Members
                            Only</span>
                    </div>
                    <p class="text-gray-400 text-sm">Your height, weight, and booking a trainer feature will appear here
                        once
                        you apply for a membership.</p>
                </div>
            @endif

        </div>



        <div x-show="showModal" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray bg-opacity-80 backdrop-blur-sm px-4"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

            <div class="bg-archer-charcoal border border-archer-neon rounded-xl w-full max-w-lg overflow-hidden"
                @click.away="showModal = false">

                <div class="bg-archer-dark p-6 border-b border-gray-800 flex justify-between items-center">
                    <h3 class="text-2xl font-extrabold text-white uppercase tracking-wide">Membership <span
                            class="text-archer-neon">Application</span></h3>
                    <button @click="showModal = false"
                        class="text-gray-400 hover:text-white text-2xl font-bold">&times;</button>
                </div>

                <div class="p-6">
                    <form action="{{ route('membership.apply') }}" method="POST" class="space-y-6">
                        @csrf


                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2 uppercase tracking-wide">Select
                                Plan</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="plan" value="standard" x-model="planType"
                                        class="peer sr-only">
                                    <div
                                        class="text-center p-3 rounded border border-gray-600 peer-checked:border-archer-neon peer-checked:bg-archer-neon/10 peer-checked:text-archer-neon text-gray-400 transition font-bold uppercase">
                                        Standard
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="plan" value="student" x-model="planType"
                                        class="peer sr-only">
                                    <div
                                        class="text-center p-3 rounded border border-gray-600 peer-checked:border-archer-neon peer-checked:bg-archer-neon/10 peer-checked:text-archer-neon text-gray-400 transition font-bold uppercase">
                                        Student
                                    </div>
                                </label>
                            </div>
                        </div>


                        <div x-show="planType === 'student'" x-collapse>
                            <label for="student_id"
                                class="block text-sm font-bold text-archer-neon mb-2 uppercase tracking-wide">Student ID
                                Number</label>
                            <input type="text" id="student_id" name="student_id"
                                class="w-full bg-archer-dark border border-archer-neon rounded-md py-3 px-4 text-white focus:outline-none focus:ring-1 focus:ring-archer-neon transition"
                                placeholder="e.g., 2023186440">
                            <p class="text-xs text-gray-500 mt-2">*Valid university ID required upon first physical
                                visit.</p>
                        </div>


                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2 uppercase tracking-wide">Billing
                                Cycle</label>
                            <select name="billing"
                                class="w-full bg-archer-dark border border-gray-600 rounded-md py-3 px-4 text-white focus:outline-none focus:border-archer-neon focus:ring-1 focus:ring-archer-neon transition">
                                <option value="monthly">Monthly (Cancel Anytime)</option>
                                <option value="yearly">Yearly (Save 15%)</option>
                            </select>
                        </div>


                        <button type="submit"
                            class="w-full bg-archer-neon hover:bg-green-400 text-archer-dark font-extrabold py-3 px-8 rounded-md transition  text-lg uppercase tracking-wide mt-4">
                            Submit Application
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

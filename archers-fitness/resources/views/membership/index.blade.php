<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-white leading-tight uppercase tracking-widest">
            Manage <span class="text-archer-neon">Membership</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-archer-charcoal shadow-2xl sm:rounded-lg border border-gray-700 p-8">

                <div class="flex flex-col md:flex-row justify-between items-center border-gray-700  ">
                    <div>
                        <h3 class="text-2xl font-bold text-white uppercase tracking-wide">Current Plan</h3>
                        <p class="text-gray-400 text-sm mt-1">Review your Archers Fitness subscription details.</p>
                        <div class="{{ $membership->status === 'inactive' ? 'hidden' : '' }}">
                            <form action="{{ route('membership.cancel') }}" method="POST"
                                onsubmit="return confirm('Are you absolutely sure you want to cancel your Archers Fitness membership? ');">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    class="text-sm text-red-500 hover:text-red-400 hover:underline font-bold uppercase tracking-widest transition">
                                    Cancel Membership
                                </button>
                            </form>
                        </div>
                    </div>

                    @if ($membership->status == 'Pending')
                        <div class="mt-4 md:mt-0 bg-archer-dark px-6 py-3 rounded border'border-yellow-500 ">
                            <p class="text-xs text-gray-400 uppercase tracking-widest text-center font-bold mb-1">Status
                            </p>
                            <p class="text-lg font-extrabold uppercase text-yellow">
                                {{ $membership->status }}
                            </p>
                        </div>
                    @elseif($membership->status == 'active')
                        <div class="mt-4 md:mt-0 bg-archer-dark px-6 py-3 rounded border border-archer-neon ">
                            <p class="text-xs text-gray-400 uppercase tracking-widest text-center font-bold mb-1">Status
                            </p>
                            <p class="text-lg font-extrabold uppercase text-archer-neon">
                                {{ $membership->status }}
                            </p>
                        </div>
                    @else
                        <div class="mt-4 md:mt-0 bg-archer-dark px-6 py-3 rounded border border-red ">
                            <p class="text-xs text-gray-400 uppercase tracking-widest text-center font-bold mb-1">Status
                            </p>
                            <p class="text-lg font-extrabold uppercase 'text-red">
                                {{ $membership->status }}
                            </p>
                        </div>
                    @endif

                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-7">

                <div class="space-y-6">
                    <div class="bg-archer-dark p-5 rounded border border-gray-800">
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-widest mb-1">Tier</p>
                        <p class="text-xl text-white font-extrabold uppercase">{{ $membership->plan }}</p>

                        @if ($membership->plan === 'student')
                            <div class="mt-3 pt-3 border-t border-gray-700">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-widest mb-1">Student ID</p>
                                <p class="text-sm text-archer-neon font-mono">{{ $membership->student_id }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="bg-archer-dark p-5 rounded border border-gray-800">
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-widest mb-1">Billing Cycle</p>
                        <p class="text-xl text-white font-extrabold uppercase">{{ $membership->billing }}</p>
                    </div>
                </div>


                <div
                    class="bg-archer-dark p-6 rounded-lg border border-archer-neon shadow-inner flex flex-col justify-center items-center text-center relative overflow-hidden">


                    <p class="text-sm text-gray-400 uppercase tracking-widest font-bold mb-2">Amount Due</p>
                    <h4 class="text-5xl font-black text-white mb-2">
                        ₱{{ number_format($cost) }}
                    </h4>
                    <p class="text-xs text-archer-neon uppercase font-bold tracking-wider">
                        / {{ $membership->billing === 'monthly' ? 'Month' : 'Year' }}
                    </p>

                    @if ($membership->status === 'pending')
                        <p class="text-xs text-gray-400 mt-6 px-4">
                            Please proceed to the front desk with your payment
                            {{ $membership->plan === 'student' ? 'and University ID ' : '' }}to activate your account.
                        </p>
                    @endif
                </div>
            </div>

        </div>
</x-app-layout>

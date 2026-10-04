<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'FitForge') }} | Stronger Every Day</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-950 text-white antialiased">
        <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(251,146,60,0.26),_transparent_30%),linear-gradient(135deg,#020617_0%,#111827_50%,#020617_100%)]">
            <header class="mx-auto max-w-7xl px-6 py-6 lg:px-8">
                <nav class="flex items-center justify-between rounded-full border border-white/10 bg-white/5 px-5 py-3 backdrop-blur-md">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-lg font-black text-slate-950">F</div>
                        <div>
                            <p class="text-sm font-semibold tracking-[0.28em] text-orange-300">FITFORGE</p>
                        </div>
                    </div>

                    <div class="hidden items-center gap-8 text-sm text-slate-300 md:flex">
                        <a href="#programs" class="transition hover:text-white">Programs</a>
                        <a href="#coaches" class="transition hover:text-white">Coaches</a>
                        <a href="#results" class="transition hover:text-white">Results</a>
                        <a href="#pricing" class="transition hover:text-white">Pricing</a>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="#pricing" class="hidden rounded-full border border-white/10 px-4 py-2 text-sm text-slate-200 transition hover:border-orange-400 hover:text-white md:inline-flex">Join Now</a>
                        <a href="#" class="rounded-full bg-orange-500 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-orange-400">Book a Trial</a>
                    </div>
                </nav>
            </header>

            <main class="mx-auto max-w-7xl px-6 pb-20 pt-8 lg:px-8">
                <section class="grid items-center gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:py-14">
                    <div>
                        <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-sm text-orange-200">
                            <span class="h-2 w-2 rounded-full bg-orange-400"></span>
                            New season starts this Monday
                        </div>

                        <h1 class="max-w-xl text-5xl font-black leading-[0.95] tracking-tight text-white md:text-6xl">
                            Build a stronger,
                            <span class="text-orange-400">fitter</span>
                            life.
                        </h1>

                        <p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">
                            Personalized training, expert coaching, and a community that keeps you moving forward every single day.
                        </p>

                        <div class="mt-8 flex flex-wrap items-center gap-4">
                            <a href="#pricing" class="rounded-full bg-orange-500 px-6 py-3 font-semibold text-slate-950 transition hover:bg-orange-400">Start Your Journey</a>
                            <a href="#programs" class="rounded-full border border-white/15 bg-white/5 px-6 py-3 font-semibold text-white transition hover:border-orange-400 hover:text-orange-200">View Programs</a>
                        </div>

                        <div class="mt-10 flex flex-wrap items-center gap-8 text-sm text-slate-300">
                            <div>
                                <p class="text-3xl font-black text-white">12k+</p>
                                <p>Active members</p>
                            </div>
                            <div>
                                <p class="text-3xl font-black text-white">94%</p>
                                <p>Goal completion</p>
                            </div>
                            <div>
                                <p class="text-3xl font-black text-white">4.9/5</p>
                                <p>Client rating</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -left-6 top-10 h-40 w-40 rounded-full bg-orange-500/20 blur-3xl"></div>
                        <div class="absolute -right-4 bottom-12 h-52 w-52 rounded-full bg-cyan-500/15 blur-3xl"></div>

                        <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 p-5 shadow-2xl shadow-orange-500/10 backdrop-blur-xl">
                            <div class="rounded-[1.5rem] bg-slate-900 p-5">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-slate-400">Today’s workout</p>
                                        <h2 class="mt-2 text-2xl font-bold text-white">Strength Circuit</h2>
                                    </div>
                                    <div class="rounded-full bg-orange-500/15 px-3 py-1 text-sm font-semibold text-orange-300">45 min</div>
                                </div>

                                <div class="mt-6 space-y-4">
                                    <div class="flex items-center justify-between rounded-2xl bg-slate-800 p-4">
                                        <div>
                                            <p class="text-sm text-slate-400">Set 1</p>
                                            <p class="mt-1 text-lg font-semibold text-white">Deadlift</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-slate-400">4 rounds</p>
                                            <p class="mt-1 text-lg font-bold text-orange-400">8 reps</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between rounded-2xl bg-slate-800 p-4">
                                        <div>
                                            <p class="text-sm text-slate-400">Set 2</p>
                                            <p class="mt-1 text-lg font-semibold text-white">Burpees</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-slate-400">3 rounds</p>
                                            <p class="mt-1 text-lg font-bold text-orange-400">12 reps</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between rounded-2xl bg-slate-800 p-4">
                                        <div>
                                            <p class="text-sm text-slate-400">Set 3</p>
                                            <p class="mt-1 text-lg font-semibold text-white">Plank Hold</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-slate-400">2 rounds</p>
                                            <p class="mt-1 text-lg font-bold text-orange-400">60 sec</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 rounded-2xl bg-gradient-to-r from-orange-500 to-amber-400 p-[1px]">
                                    <div class="rounded-2xl bg-slate-900 px-4 py-3 text-center">
                                        <p class="text-sm text-slate-400">Performance score</p>
                                        <p class="mt-1 text-2xl font-black text-white">87% <span class="text-orange-400">+12%</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="programs" class="mt-20">
                    <div class="mb-8 flex items-end justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-orange-300">Programs</p>
                            <h2 class="mt-3 text-3xl font-black text-white md:text-4xl">Choose your path to progress</h2>
                        </div>
                        <a href="#" class="text-sm font-semibold text-orange-300 transition hover:text-orange-200">See all plans</a>
                    </div>

                    <div class="grid gap-6 md:grid-cols-3">
                        <article class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6">
                            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-500/15 text-2xl">???</div>
                            <h3 class="text-2xl font-bold text-white">Strength</h3>
                            <p class="mt-3 text-slate-300">Progressive lifting programs designed to build muscle, boost power, and improve performance.</p>
                            <ul class="mt-5 space-y-2 text-sm text-slate-300">
                                <li>• 4-day custom plan</li>
                                <li>• Form analysis</li>
                                <li>• Nutrition guidance</li>
                            </ul>
                            <a href="#" class="mt-6 inline-flex rounded-full border border-orange-400/40 px-4 py-2 text-sm font-semibold text-orange-200 transition hover:bg-orange-500 hover:text-slate-950">Get started</a>
                        </article>

                        <article class="rounded-[1.75rem] border border-orange-500/30 bg-gradient-to-b from-orange-500/15 to-white/5 p-6">
                            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-500 text-2xl">??</div>
                            <h3 class="text-2xl font-bold text-white">Fat Loss</h3>
                            <p class="mt-3 text-slate-300">High-energy conditioning workouts that help you burn fat while preserving strength and stamina.</p>
                            <ul class="mt-5 space-y-2 text-sm text-slate-300">
                                <li>• HIIT & cardio mix</li>
                                <li>• Weekly check-ins</li>
                                <li>• Habit tracking</li>
                            </ul>
                            <a href="#" class="mt-6 inline-flex rounded-full bg-orange-500 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-orange-400">Get started</a>
                        </article>

                        <article class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6">
                            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-500/15 text-2xl">?</div>
                            <h3 class="text-2xl font-bold text-white">Performance</h3>
                            <p class="mt-3 text-slate-300">Athlete-focused conditioning for speed, endurance, mobility, and long-term resilience.</p>
                            <ul class="mt-5 space-y-2 text-sm text-slate-300">
                                <li>• Mobility sessions</li>
                                <li>• Recovery planning</li>
                                <li>• Competition prep</li>
                            </ul>
                            <a href="#" class="mt-6 inline-flex rounded-full border border-white/15 px-4 py-2 text-sm font-semibold text-white transition hover:border-cyan-400 hover:text-cyan-200">Get started</a>
                        </article>
                    </div>
                </section>

                <section id="results" class="mt-20 grid gap-6 md:grid-cols-3">
                    <div class="rounded-[1.75rem] border border-white/10 bg-slate-900/80 p-6">
                        <p class="text-sm uppercase tracking-[0.2em] text-orange-300">Weight loss</p>
                        <p class="mt-4 text-4xl font-black text-white">18kg</p>
                        <p class="mt-2 text-slate-300">Average transformation in 12 weeks</p>
                    </div>
                    <div class="rounded-[1.75rem] border border-white/10 bg-slate-900/80 p-6">
                        <p class="text-sm uppercase tracking-[0.2em] text-orange-300">Strength gain</p>
                        <p class="mt-4 text-4xl font-black text-white">+42%</p>
                        <p class="mt-2 text-slate-300">Power and endurance improvements</p>
                    </div>
                    <div class="rounded-[1.75rem] border border-white/10 bg-slate-900/80 p-6">
                        <p class="text-sm uppercase tracking-[0.2em] text-orange-300">Retention</p>
                        <p class="mt-4 text-4xl font-black text-white">91%</p>
                        <p class="mt-2 text-slate-300">Members staying consistent beyond 6 months</p>
                    </div>
                </section>

                <section id="coaches" class="mt-20 rounded-[2rem] border border-white/10 bg-gradient-to-r from-slate-900 to-slate-800 p-8">
                    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-xl">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-orange-300">Coaches</p>
                            <h2 class="mt-3 text-3xl font-black text-white md:text-4xl">Expert guidance from real performance coaches</h2>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-3">
                            <div class="rounded-2xl bg-white/5 p-4 text-center">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-orange-500 text-2xl">A</div>
                                <p class="mt-4 font-semibold text-white">Ava</p>
                                <p class="text-sm text-slate-300">Strength Coach</p>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-4 text-center">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-cyan-500 text-2xl">M</div>
                                <p class="mt-4 font-semibold text-white">Milo</p>
                                <p class="text-sm text-slate-300">Conditioning Coach</p>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-4 text-center">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-amber-400 text-2xl text-slate-950">K</div>
                                <p class="mt-4 font-semibold text-white">Kai</p>
                                <p class="text-sm text-slate-300">Recovery Coach</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="pricing" class="mt-20 pb-10">
                    <div class="rounded-[2rem] border border-orange-400/20 bg-gradient-to-r from-orange-500/20 via-slate-900 to-slate-900 p-8 text-center shadow-2xl shadow-orange-500/10">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-orange-300">Membership</p>
                        <h2 class="mt-4 text-3xl font-black text-white md:text-5xl">Train with confidence.</h2>
                        <p class="mx-auto mt-4 max-w-2xl text-slate-300">From first-time gym goers to serious athletes, we build a plan around your goals and pace.</p>
                        <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                            <div class="rounded-full bg-white/5 px-6 py-3 text-3xl font-black text-white">?2,499 <span class="text-lg text-slate-300">/mo</span></div>
                            <a href="#" class="rounded-full bg-orange-500 px-7 py-3 text-base font-bold text-slate-950 transition hover:bg-orange-400">Claim Your Free Trial</a>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'StumbleLearn') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-stone-50 text-slate-950">
    <main class="min-h-screen">
        <section class="relative overflow-hidden border-b border-slate-200 bg-white">
            <div class="absolute inset-x-0 top-0 h-2 bg-emerald-600"></div>
            <div class="mx-auto grid min-h-[92vh] max-w-7xl grid-cols-1 items-center gap-12 px-6 py-20 lg:grid-cols-[1.05fr_0.95fr] lg:px-8">
                <div>
                    <div class="mb-8 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-800">
                        Focused learning for course-based study
                    </div>

                    <h1 class="max-w-4xl text-5xl font-bold tracking-normal text-slate-950 sm:text-6xl">
                        StumbleLearn
                    </h1>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-600">
                        Pick your course, choose a subject, and review one useful concept at a time. Save what matters, skip what does not, and track what you understand.
                    </p>

                    <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                        @auth
                            <a href="{{ route('learn') }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-emerald-700">
                                Continue learning
                            </a>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-50">
                                View dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-emerald-700">
                                Create account
                            </a>
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-50">
                                Sign in
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-950 p-6 text-white shadow-xl">
                    <div class="flex items-center justify-between border-b border-white/10 pb-4">
                        <div>
                            <p class="text-sm text-emerald-300">Today&apos;s card</p>
                            <h2 class="mt-1 text-2xl font-semibold">Big-O Basics</h2>
                        </div>
                        <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-medium">DSA</span>
                    </div>
                    <p class="mt-6 text-base leading-7 text-slate-300">
                        Big-O describes how runtime grows with input size. It lets you compare algorithms by growth pattern, not by machine speed.
                    </p>
                    <div class="mt-8 grid grid-cols-3 gap-3 text-center text-sm">
                        <div class="rounded-lg bg-white/10 p-4">
                            <div class="text-lg font-bold">Save</div>
                            <div class="mt-1 text-slate-400">Review later</div>
                        </div>
                        <div class="rounded-lg bg-white/10 p-4">
                            <div class="text-lg font-bold">Skip</div>
                            <div class="mt-1 text-slate-400">Hide it</div>
                        </div>
                        <div class="rounded-lg bg-emerald-500 p-4 text-emerald-950">
                            <div class="text-lg font-bold">+10</div>
                            <div class="mt-1 font-medium">Understood</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

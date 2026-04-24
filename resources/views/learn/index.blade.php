<x-app-layout>
    <div class="bg-stone-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Learn</p>
                    <h1 class="mt-2 text-3xl font-bold text-slate-950">Choose a course</h1>
                    <p class="mt-2 max-w-2xl text-slate-600">Start with your program, then pick a reusable subject like DSA, Web Development, or Software Engineering.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                @forelse($courses as $course)
                    <a class="group rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-300 hover:shadow-md"
                       href="{{ route('learn.course', $course->slug) }}">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-xl font-semibold text-slate-950">{{ $course->name }}</div>
                                <div class="mt-1 text-sm text-slate-500">{{ $course->slug }}</div>
                            </div>
                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 group-hover:bg-emerald-100">
                                Open
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="rounded-xl border border-slate-200 bg-white p-8 text-slate-600">
                        No courses are available yet. Add courses from the admin panel to begin.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

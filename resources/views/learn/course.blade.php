<x-app-layout>
    <div class="bg-stone-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <a class="text-sm font-medium text-slate-600 hover:text-emerald-700" href="{{ route('learn') }}">Back to courses</a>
                <div class="mt-4 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">{{ $course->name }}</p>
                        <h1 class="mt-2 text-3xl font-bold text-slate-950">Choose a subject</h1>
                        <p class="mt-2 max-w-2xl text-slate-600">Subjects are shared across programs, so one DSA subject can serve BCA, BIT, BICTE, and any future course.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                @forelse($subjects as $subject)
                    <a class="group rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-300 hover:shadow-md"
                       href="{{ route('learn.subject', [$course->slug, $subject->slug]) }}">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-xl font-semibold text-slate-950">{{ $subject->name }}</div>
                                <div class="mt-1 text-sm text-slate-500">{{ $subject->posts_count }} published posts</div>
                            </div>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 group-hover:bg-emerald-50 group-hover:text-emerald-700">
                                Study
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="rounded-xl border border-slate-200 bg-white p-8 text-slate-600">
                        No subjects are attached to this course yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

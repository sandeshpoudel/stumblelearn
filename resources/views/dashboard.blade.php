<x-app-layout>
    <div class="bg-stone-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-center">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Dashboard</p>
                        <h1 class="mt-2 text-3xl font-bold text-slate-950">Welcome back, {{ Auth::user()->name }}</h1>
                        <p class="mt-2 max-w-2xl text-slate-600">
                            Your current learning status across saved, ignored, and understood posts.
                        </p>
                    </div>
                    <a href="{{ route('learn') }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-700">
                        Continue learning
                    </a>
                </div>

                <div class="mt-8">
                    <div class="mb-2 flex items-center justify-between text-sm">
                        <span class="font-medium text-slate-700">Overall completion</span>
                        <span class="font-semibold text-slate-950">{{ $completionPercent }}%</span>
                    </div>
                    <div class="h-3 overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-emerald-600" style="width: {{ $completionPercent }}%"></div>
                    </div>
                    <p class="mt-2 text-sm text-slate-500">
                        {{ $understoodCount }} of {{ $totalPublishedPosts }} published posts marked understood.
                    </p>
                </div>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
                <a href="{{ route('progress') }}" class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm hover:border-emerald-300">
                    <div class="text-sm font-medium text-slate-500">Points</div>
                    <div class="mt-2 text-3xl font-bold text-slate-950">{{ $totalPoints }}</div>
                </a>
                <a href="{{ route('progress') }}" class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm hover:border-emerald-300">
                    <div class="text-sm font-medium text-slate-500">Understood</div>
                    <div class="mt-2 text-3xl font-bold text-slate-950">{{ $understoodCount }}</div>
                </a>
                <a href="{{ route('saved') }}" class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm hover:border-emerald-300">
                    <div class="text-sm font-medium text-slate-500">Saved</div>
                    <div class="mt-2 text-3xl font-bold text-slate-950">{{ $savedCount }}</div>
                </a>
                <a href="{{ route('ignored') }}" class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm hover:border-emerald-300">
                    <div class="text-sm font-medium text-slate-500">Ignored</div>
                    <div class="mt-2 text-3xl font-bold text-slate-950">{{ $ignoredCount }}</div>
                </a>
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="text-sm font-medium text-slate-500">Active days</div>
                    <div class="mt-2 text-3xl font-bold text-slate-950">{{ $activeDays }}</div>
                </div>
            </div>

            <div class="mt-6 grid gap-6 lg:grid-cols-[1fr_1fr]">
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-5 flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-slate-950">Recent progress</h2>
                            <p class="mt-1 text-sm text-slate-500">Latest posts you marked understood.</p>
                        </div>
                        <a href="{{ route('progress') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">View all</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($recentUnderstood as $post)
                            @php
                                $subject = $post->subjects->first();
                                $course = $subject?->courses->first();
                            @endphp
                            <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                                <div class="text-sm font-semibold text-slate-950">{{ $post->title }}</div>
                                <div class="mt-1 text-xs text-slate-500">
                                    {{ $subject?->name ?? 'General' }} · {{ $post->pivot->points ?? 0 }} points
                                </div>
                                @if($course && $subject)
                                    <a href="{{ route('learn.subject', [$course->slug, $subject->slug]) }}" class="mt-3 inline-flex text-sm font-semibold text-emerald-700 hover:text-emerald-800">
                                        Continue topic
                                    </a>
                                @endif
                            </div>
                        @empty
                            <div class="rounded-xl border border-slate-100 bg-slate-50 p-5">
                                <div class="font-semibold text-slate-950">No progress yet</div>
                                <p class="mt-1 text-sm text-slate-600">Mark a post as understood to start building your progress history.</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-5 flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-slate-950">Saved for later</h2>
                            <p class="mt-1 text-sm text-slate-500">Quick access to concepts you saved.</p>
                        </div>
                        <a href="{{ route('saved') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">View all</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($recentSaved as $post)
                            @php
                                $subject = $post->subjects->first();
                                $course = $subject?->courses->first();
                            @endphp
                            <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                                <div class="text-sm font-semibold text-slate-950">{{ $post->title }}</div>
                                <div class="mt-1 text-xs text-slate-500">{{ $subject?->name ?? 'General' }}</div>
                                @if($course && $subject)
                                    <a href="{{ route('learn.subject', [$course->slug, $subject->slug]) }}" class="mt-3 inline-flex text-sm font-semibold text-emerald-700 hover:text-emerald-800">
                                        Review now
                                    </a>
                                @endif
                            </div>
                        @empty
                            <div class="rounded-xl border border-slate-100 bg-slate-50 p-5">
                                <div class="font-semibold text-slate-950">Nothing saved yet</div>
                                <p class="mt-1 text-sm text-slate-600">Use Save on any study card to build your review list.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>

            <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-5 flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-950">Continue by course</h2>
                        <p class="mt-1 text-sm text-slate-500">Jump back into available subjects.</p>
                    </div>
                    <a href="{{ route('learn') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">Browse all courses</a>
                </div>

                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                    @forelse($suggestedCourses as $course)
                        <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                            <div class="font-semibold text-slate-950">{{ $course->name }}</div>
                            <div class="mt-3 space-y-2">
                                @forelse($course->subjects->take(3) as $subject)
                                    <a href="{{ route('learn.subject', [$course->slug, $subject->slug]) }}" class="flex items-center justify-between rounded-lg bg-white px-3 py-2 text-sm hover:bg-emerald-50">
                                        <span class="font-medium text-slate-700">{{ $subject->name }}</span>
                                        <span class="text-xs text-slate-500">{{ $subject->posts_count }}</span>
                                    </a>
                                @empty
                                    <p class="text-sm text-slate-500">No subjects attached yet.</p>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <div class="rounded-xl border border-slate-100 bg-slate-50 p-5 text-sm text-slate-600">
                            No courses are available yet.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="bg-stone-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Library</p>
                    <h1 class="mt-2 text-3xl font-bold text-slate-950">Ignored posts</h1>
                    <p class="mt-2 text-slate-600">Posts hidden from your study feed. You can restore them anytime.</p>
                </div>
                <a class="text-sm font-medium text-slate-600 hover:text-emerald-700" href="{{ route('learn') }}">Back to learn</a>
            </div>

            @if (session('status'))
                <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            <div class="space-y-4">
                @forelse($posts as $post)
                    @php
                        $subject = $post->subjects->first();
                        $course = $subject?->courses->first();
                    @endphp
                    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="mb-3 flex flex-wrap gap-2">
                            @foreach($post->subjects as $postSubject)
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">{{ $postSubject->name }}</span>
                            @endforeach
                        </div>

                        <div class="text-lg font-semibold text-slate-950">{{ $post->title }}</div>

                        <div class="mt-4 flex flex-wrap items-center gap-3">
                            @if($course && $subject)
                                <a class="text-sm font-semibold text-emerald-700 hover:text-emerald-800"
                                   href="{{ route('learn.subject', [$course->slug, $subject->slug]) }}">
                                    Study this topic
                                </a>
                            @endif

                            <form method="POST" action="{{ route('ignored.delete', $post) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm font-medium text-slate-600 hover:text-slate-950" type="submit">Unignore</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="rounded-xl border border-slate-200 bg-white p-8 shadow-sm">
                        <div class="font-semibold text-slate-950">No ignored posts</div>
                        <p class="mt-1 text-slate-600">Ignored posts will show here so you can undo mistakes.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

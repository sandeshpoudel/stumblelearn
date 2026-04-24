<x-app-layout>
    <div class="bg-stone-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Progress</p>
                        <h1 class="mt-2 text-3xl font-bold text-slate-950">Understood posts</h1>
                        <p class="mt-2 text-slate-600">Total points: <span class="font-semibold text-slate-950">{{ $totalPoints }}</span></p>
                    </div>
                    <a class="text-sm font-medium text-slate-600 hover:text-emerald-700" href="{{ route('learn') }}">Back to learn</a>
                </div>
            </div>

            @if (session('status'))
                <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            <div class="space-y-4">
                @forelse($understood as $post)
                    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
                            <div>
                                <div class="mb-3 flex flex-wrap gap-2">
                                    @foreach($post->subjects as $postSubject)
                                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">{{ $postSubject->name }}</span>
                                    @endforeach
                                </div>
                                <div class="text-lg font-semibold text-slate-950">{{ $post->title }}</div>
                                <div class="mt-1 text-sm text-slate-600">Points: {{ $post->pivot->points ?? 0 }}</div>
                            </div>

                            <form method="POST" action="{{ route('progress.delete', $post) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm font-medium text-slate-600 hover:text-slate-950" type="submit">Remove</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="rounded-xl border border-slate-200 bg-white p-8 shadow-sm">
                        <div class="font-semibold text-slate-950">No understood posts yet</div>
                        <p class="mt-1 text-slate-600">Mark posts as understood to track your learning progress.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

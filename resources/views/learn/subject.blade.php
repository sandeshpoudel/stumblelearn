<x-app-layout>
    <div class="bg-stone-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <a class="text-sm font-medium text-slate-600 hover:text-emerald-700" href="{{ route('learn.course', $course->slug) }}">Back to {{ $course->name }}</a>
                    <h1 class="mt-3 text-3xl font-bold text-slate-950">{{ $subject->name }}</h1>
                    <p class="mt-2 text-slate-600">{{ $course->name }} study stream</p>
                </div>
                <a href="{{ route('progress') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-800 hover:bg-slate-50">
                    View progress
                </a>
            </div>

            @if (session('status'))
                <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mx-auto max-w-4xl">
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-100 bg-slate-950 px-6 py-5 text-white sm:px-8">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm font-medium text-emerald-300">Learning card</p>
                                <p class="mt-1 text-sm text-slate-300">{{ $course->name }} / {{ $subject->name }}</p>
                            </div>
                            <span class="w-fit rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white">Randomized</span>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8">
                        @if($post)
                            <h2 class="text-3xl font-bold tracking-normal text-slate-950">{{ $post->title }}</h2>
                            <p class="mt-6 whitespace-pre-line text-lg leading-8 text-slate-700">{{ $post->content }}</p>

                            <div class="mt-8 flex flex-col gap-4 border-t border-slate-100 pt-6 sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex gap-3">
                                    <form method="POST" action="{{ route('learn.posts.save', $post) }}">
                                        @csrf
                                        <button class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50" type="submit">Save</button>
                                    </form>

                                    <form method="POST" action="{{ route('learn.posts.ignore', $post) }}">
                                        @csrf
                                        <button class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50" type="submit">Ignore</button>
                                    </form>
                                </div>

                                <div class="flex gap-3">
                                    <form method="POST" action="{{ route('learn.posts.understood', $post) }}">
                                        @csrf
                                        <button class="rounded-lg border border-emerald-600 bg-white px-4 py-2 text-sm font-semibold text-emerald-700 hover:bg-emerald-50" type="submit">Understood (+10)</button>
                                    </form>

                                    <a class="rounded-lg bg-emerald-600 px-5 py-2 text-sm font-semibold text-white hover:bg-emerald-700"
                                       href="{{ route('learn.subject', [$course->slug, $subject->slug]) }}">
                                        Stumble next
                                    </a>
                                </div>
                            </div>
                        @else
                            <h2 class="text-2xl font-bold text-slate-950">No more posts left</h2>
                            <p class="mt-3 text-slate-600">You have already ignored or understood every published post in this subject.</p>
                            <a class="mt-6 inline-flex items-center justify-center rounded-lg bg-emerald-600 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-700"
                               href="{{ route('learn.course', $course->slug) }}">
                                Choose another subject
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

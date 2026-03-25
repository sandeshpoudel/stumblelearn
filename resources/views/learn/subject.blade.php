<x-app-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header row --}}
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded bg-emerald-600"></div>
                    <div>
                        <div class="text-xl font-semibold text-gray-900">StumbleLearn</div>
                        <div class="text-sm text-gray-500">One topic at a time</div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        Profile
                    </a>
                </div>
            </div>

            {{-- Back + Context --}}
            <div class="max-w-4xl mx-auto mb-6 flex items-center justify-between">
                <a class="text-sm text-gray-600 underline"
                   href="{{ route('learn.course', $course->slug) }}">← Back</a>

                <div class="text-sm text-gray-500">
                    {{ $course->name }} › {{ $subject->name }}
                </div>
            </div>

            @if (session('status'))
                <div class="max-w-4xl mx-auto mb-6 p-3 bg-green-100 border border-green-200 rounded">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Post Card --}}
            <div class="max-w-4xl mx-auto">
                <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="p-8 sm:p-10">

                        @if($post)
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-emerald-700 font-medium">
                                        {{ $course->name }}
                                    </span>
                                    <span class="text-gray-400">›</span>
                                    <span class="text-gray-700">{{ $subject->name }}</span>
                                </div>
                            </div>

                            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-gray-900 mb-4">
                                {{ $post->title }}
                            </h1>

                            <p class="text-gray-600 leading-7 mb-10">
                                {!! nl2br(e($post->content)) !!}
                            </p>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 pt-6 border-t border-gray-100">
                                <div class="flex items-center gap-6 text-sm text-gray-600">
                                    <form method="POST" action="{{ route('learn.posts.save', $post) }}">
                                        @csrf
                                        <button class="hover:text-gray-900" type="submit">Save</button>
                                    </form>

                                    <form method="POST" action="{{ route('learn.posts.ignore', $post) }}">
                                        @csrf
                                        <button class="hover:text-gray-900" type="submit">Ignore</button>
                                    </form>
                                </div>

                                <div class="flex items-center gap-3">
                                    <form method="POST" action="{{ route('learn.posts.understood', $post) }}">
                                        @csrf
                                        <button
                                            class="inline-flex items-center justify-center rounded-xl border border-emerald-600 bg-white px-5 py-3 text-sm font-semibold text-emerald-700 hover:bg-emerald-50"
                                            type="submit">
                                            Understood (+10)
                                        </button>
                                    </form>

                                    <a
                                        class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-700"
                                        href="{{ route('learn.subject', [$course->slug, $subject->slug]) }}">
                                        Stumble
                                    </a>
                                </div>
                            </div>
                        @else
                            <h1 class="text-2xl font-bold tracking-tight text-gray-900 mb-2">
                                No more posts left 🎉
                            </h1>

                            <p class="text-gray-600 leading-7">
                                You’ve already ignored or understood all published posts in this subject.
                            </p>

                            <div class="mt-6">
                                <a class="inline-flex items-center justify-center rounded-xl border px-5 py-3 text-sm font-semibold"
                                   href="{{ route('learn.course', $course->slug) }}">
                                    Choose another subject
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
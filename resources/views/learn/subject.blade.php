<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <a class="text-sm text-gray-600 underline" href="{{ route('learn.course', $course->slug) }}">← Back</a>

        <h1 class="text-2xl font-bold mt-4">{{ $subject->name }}</h1>
        <p class="text-sm text-gray-600 mb-6">{{ $course->name }}</p>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 border border-green-200 rounded">
                {{ session('status') }}
            </div>
        @endif

        @if($post)
            <div class="border rounded p-6 bg-white">
                <h2 class="text-xl font-semibold mb-3">{{ $post->title }}</h2>
                <div class="prose max-w-none">
                    {!! nl2br(e($post->content)) !!}
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <form method="POST" action="{{ route('learn.posts.save', $post) }}">
                        @csrf
                        <button class="px-4 py-2 border rounded">Save</button>
                    </form>

                    <form method="POST" action="{{ route('learn.posts.ignore', $post) }}">
                        @csrf
                        <button class="px-4 py-2 border rounded">Ignore</button>
                    </form>

                    <form method="POST" action="{{ route('learn.posts.understood', $post) }}">
                        @csrf
                        <button class="px-4 py-2 bg-black text-white rounded">Understood</button>
                    </form>

                    <a class="px-4 py-2 border rounded"
                       href="{{ route('learn.subject', [$course->slug, $subject->slug]) }}">
                        Next
                    </a>
                </div>
            </div>
        @else
            <div class="p-6 border rounded bg-white">
                <h2 class="text-lg font-semibold">No more posts left 🎉</h2>
                <p class="text-gray-600 mt-2">
                    You’ve already ignored or understood all published posts in this subject.
                </p>

                <a class="inline-block mt-4 px-4 py-2 border rounded"
                   href="{{ route('learn.course', $course->slug) }}">
                    Choose another subject
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
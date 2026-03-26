<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Ignored Posts</h1>
            <a class="text-sm underline text-gray-600" href="{{ route('learn') }}">Back to Learn</a>
        </div>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 border border-green-200 rounded">
                {{ session('status') }}
            </div>
        @endif

        @forelse($posts as $post)
            <div class="p-5 mb-4 border rounded-xl bg-white">
                <div class="text-xs text-gray-500 mb-2">
                    {{ $post->subject?->course?->name }} › {{ $post->subject?->name }}
                </div>

                <div class="font-semibold text-lg">{{ $post->title }}</div>

                <div class="mt-3 flex items-center gap-3">
                    <a class="text-sm underline text-emerald-700"
                       href="{{ route('learn.subject', [$post->subject->course->slug, $post->subject->slug]) }}">
                        Go to subject
                    </a>

                    <form method="POST" action="{{ route('ignored.delete', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-sm text-gray-600 hover:text-gray-900" type="submit">
                            Unignore
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-6 border rounded-xl bg-white">
                <div class="font-semibold">No ignored posts</div>
                <p class="text-gray-600 mt-1">Ignored posts will show here so you can undo mistakes.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>
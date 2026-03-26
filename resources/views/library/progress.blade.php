<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold">Progress</h1>
                <p class="text-gray-600 text-sm">Total points: <span class="font-semibold">{{ $totalPoints }}</span></p>
            </div>

            <a class="text-sm underline text-gray-600" href="{{ route('learn') }}">Back to Learn</a>
        </div>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 border border-green-200 rounded">
                {{ session('status') }}
            </div>
        @endif

        @forelse($understood as $post)
            <div class="p-5 mb-4 border rounded-xl bg-white">
                <div class="text-xs text-gray-500 mb-2">
                    {{ $post->subject?->course?->name }} › {{ $post->subject?->name }}
                </div>

                <div class="flex items-center justify-between gap-4">
                    <div>
                        <div class="font-semibold text-lg">{{ $post->title }}</div>
                        <div class="text-sm text-gray-600 mt-1">
                            Points: {{ $post->pivot->points ?? 0 }}
                        </div>
                    </div>

                    <form method="POST" action="{{ route('progress.delete', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-sm text-gray-600 hover:text-gray-900" type="submit">
                            Remove
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-6 border rounded-xl bg-white">
                <div class="font-semibold">No understood posts yet</div>
                <p class="text-gray-600 mt-1">Mark posts as understood to track your progress.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>
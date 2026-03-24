<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <a class="text-sm text-gray-600 underline" href="{{ route('learn') }}">← Back</a>

        <h1 class="text-2xl font-bold mt-4 mb-6">{{ $course->name }}: Subjects</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($subjects as $subject)
                <a class="p-4 border rounded hover:bg-gray-50"
                   href="{{ route('learn.subject', [$course->slug, $subject->slug]) }}">
                    <div class="font-semibold">{{ $subject->name }}</div>
                    <div class="text-sm text-gray-600">{{ $subject->slug }}</div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
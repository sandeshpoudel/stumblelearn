<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Choose a course</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($courses as $course)
                <a class="p-4 border rounded hover:bg-gray-50"
                   href="{{ route('learn.course', $course->slug) }}">
                    <div class="font-semibold">{{ $course->name }}</div>
                    <div class="text-sm text-gray-600">{{ $course->slug }}</div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
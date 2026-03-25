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
                    <button type="button"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        Feedback
                    </button>

                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        Profile
                    </a>
                </div>
            </div>

            {{-- Filters --}}
            <div class="flex items-center justify-center mb-6">
                <select class="w-56 rounded-full border-gray-300 bg-white px-4 py-2 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option>All Courses</option>
                    <option>BCA</option>
                    <option>BIT</option>
                </select>
            </div>

            {{-- Progress --}}
            <div class="max-w-xl mx-auto mb-8">
                <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                    <span class="uppercase tracking-wider">Subject Mastery</span>
                    <span>0%</span>
                </div>
                <div class="h-2 w-full rounded-full bg-gray-200">
                    <div class="h-2 rounded-full bg-emerald-600" style="width: 0%"></div>
                </div>
            </div>

            {{-- Post Card --}}
            <div class="max-w-4xl mx-auto">
                <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="p-8 sm:p-10">

                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-2 text-sm">
                                <span class="rounded-full bg-emerald-50 px-3 py-1 text-emerald-700 font-medium">BCA</span>
                                <span class="text-gray-400">›</span>
                                <span class="text-gray-700">DSA</span>
                            </div>

                            <button type="button"
                                class="inline-flex items-center gap-2 text-sm font-medium text-emerald-700 hover:text-emerald-800">
                                Deep Dive
                            </button>
                        </div>

                        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-gray-900 mb-4">
                            Introduction to Linked Lists
                        </h1>

                        <p class="text-gray-600 leading-7 mb-10">
                            A linked list is a linear data structure where elements are not stored at contiguous memory locations.
                            The elements in a linked list are linked using pointers.
                        </p>

                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 pt-6 border-t border-gray-100">
                            <div class="flex items-center gap-6 text-sm text-gray-600">
                                <button class="hover:text-gray-900">Save</button>
                                <button class="hover:text-gray-900">Ignore</button>
                            </div>

                            <div class="flex items-center gap-3">
                                <button
                                    class="inline-flex items-center justify-center rounded-xl border border-emerald-600 bg-white px-5 py-3 text-sm font-semibold text-emerald-700 hover:bg-emerald-50">
                                    Understood (+10)
                                </button>

                                <button
                                    class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-700">
                                    Stumble
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <p class="text-center text-xs text-gray-400 mt-6">
                    Day 1: UI skeleton only. Logic will come in later days.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Post;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearnController extends Controller
{
    public function index(): View
    {
        $courses = Course::query()
            ->orderBy('name')
            ->get();

        return view('learn.index', compact('courses'));
    }

    public function course(Course $course): View
    {
        $subjects = $course->subjects()
            ->orderBy('name')
            ->get();

        return view('learn.course', compact('course', 'subjects'));
    }

    public function subject(Course $course, Subject $subject): View
    {
        abort_unless($subject->course_id === $course->id, 404);

        $user = request()->user();

        // Exclude posts user already ignored or understood
        $ignoredIds = $user->ignoredPosts()->pluck('posts.id');
        $understoodIds = $user->understoodPosts()->pluck('posts.id');

        $post = $subject->posts()
            ->where('is_published', true)
            ->whereNotIn('id', $ignoredIds)
            ->whereNotIn('id', $understoodIds)
            ->inRandomOrder()
            ->first();

        return view('learn.subject', compact('course', 'subject', 'post'));
    }

    public function save(Request $request, Post $post): RedirectResponse
    {
        $request->user()->savedPosts()->syncWithoutDetaching([$post->id]);

        return back()->with('status', 'Saved!');
    }

    public function ignore(Request $request, Post $post): RedirectResponse
    {
        $request->user()->ignoredPosts()->syncWithoutDetaching([$post->id]);

        return back()->with('status', 'Ignored!');
    }

    public function understood(Request $request, Post $post): RedirectResponse
    {
        $request->user()->understoodPosts()->syncWithoutDetaching([
            $post->id => ['points' => 10],
        ]);

        return back()->with('status', 'Marked as understood!');
    }
}
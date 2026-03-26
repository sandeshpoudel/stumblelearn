<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LibraryController extends Controller
{
    public function saved(Request $request): View
    {
        $posts = $request->user()
            ->savedPosts()
            ->with(['subject.course'])
            ->orderByPivot('created_at', 'desc')
            ->get();

        return view('library.saved', compact('posts'));
    }

    public function unsave(Request $request, Post $post): RedirectResponse
    {
        $request->user()->savedPosts()->detach($post->id);

        return back()->with('status', 'Removed from saved.');
    }

    public function progress(Request $request): View
    {
        $understood = $request->user()
            ->understoodPosts()
            ->with(['subject.course'])
            ->orderByPivot('created_at', 'desc')
            ->get();

        $totalPoints = (int) $request->user()
            ->understoodPosts()
            ->sum('understood_posts.points');

        return view('library.progress', compact('understood', 'totalPoints'));
    }

    public function ununderstood(Request $request, Post $post): RedirectResponse
    {
        $request->user()->understoodPosts()->detach($post->id);

        return back()->with('status', 'Removed from understood.');
    }

    public function ignored(Request $request): View
    {
        $posts = $request->user()
            ->ignoredPosts()
            ->with(['subject.course'])
            ->orderByPivot('created_at', 'desc')
            ->get();

        return view('library.ignored', compact('posts'));
    }

    public function unignore(Request $request, Post $post): RedirectResponse
    {
        $request->user()->ignoredPosts()->detach($post->id);

        return back()->with('status', 'Removed from ignored.');
    }
}
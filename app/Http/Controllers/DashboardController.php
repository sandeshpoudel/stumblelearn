<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $savedCount = $user->savedPosts()->count();
        $understoodCount = $user->understoodPosts()->count();
        $ignoredCount = $user->ignoredPosts()->count();
        $totalPoints = (int) $user->understoodPosts()->sum('understood_posts.points');
        $totalPublishedPosts = Post::query()->where('is_published', true)->count();
        $completionPercent = $totalPublishedPosts > 0
            ? min(100, (int) round(($understoodCount / $totalPublishedPosts) * 100))
            : 0;

        $activeDays = DB::table('understood_posts')
            ->where('user_id', $user->id)
            ->distinct()
            ->count(DB::raw('DATE(created_at)'));

        $recentUnderstood = $user->understoodPosts()
            ->with('subjects.courses')
            ->orderByPivot('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentSaved = $user->savedPosts()
            ->with('subjects.courses')
            ->orderByPivot('created_at', 'desc')
            ->limit(5)
            ->get();

        $suggestedCourses = Course::query()
            ->with(['subjects' => fn ($query) => $query
                ->withCount(['posts' => fn ($postQuery) => $postQuery->where('is_published', true)])
                ->orderBy('name')])
            ->orderBy('name')
            ->limit(4)
            ->get();

        return view('dashboard', compact(
            'activeDays',
            'completionPercent',
            'ignoredCount',
            'recentSaved',
            'recentUnderstood',
            'savedCount',
            'suggestedCourses',
            'totalPoints',
            'totalPublishedPosts',
            'understoodCount',
        ));
    }
}

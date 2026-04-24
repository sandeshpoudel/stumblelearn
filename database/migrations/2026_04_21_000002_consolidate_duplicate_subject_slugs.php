<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $duplicates = DB::table('subjects')
            ->select('slug')
            ->whereNotNull('slug')
            ->groupBy('slug')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('slug');

        foreach ($duplicates as $slug) {
            $subjects = DB::table('subjects')
                ->where('slug', $slug)
                ->orderBy('id')
                ->get(['id', 'course_id']);

            $keeper = $subjects->first();

            foreach ($subjects->skip(1) as $duplicate) {
                $courseIds = DB::table('course_subject')
                    ->where('subject_id', $duplicate->id)
                    ->pluck('course_id');

                if ($duplicate->course_id) {
                    $courseIds->push($duplicate->course_id);
                }

                foreach ($courseIds->unique() as $courseId) {
                    DB::table('course_subject')->insertOrIgnore([
                        'course_id' => $courseId,
                        'subject_id' => $keeper->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('course_subject')->where('subject_id', $duplicate->id)->delete();

                $postIds = DB::table('post_subject')
                    ->where('subject_id', $duplicate->id)
                    ->pluck('post_id');

                foreach ($postIds as $postId) {
                    DB::table('post_subject')->insertOrIgnore([
                        'post_id' => $postId,
                        'subject_id' => $keeper->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('post_subject')->where('subject_id', $duplicate->id)->delete();

                DB::table('posts')
                    ->where('subject_id', $duplicate->id)
                    ->update(['subject_id' => $keeper->id, 'updated_at' => now()]);

                DB::table('subjects')->where('id', $duplicate->id)->delete();
            }
        }

        Schema::table('subjects', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropUnique(['slug']);
        });
    }
};

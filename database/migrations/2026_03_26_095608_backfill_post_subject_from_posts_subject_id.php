<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Only backfill if posts.subject_id exists
        $hasColumn = DB::getSchemaBuilder()->hasColumn('posts', 'subject_id');

        if (! $hasColumn) {
            return;
        }

            DB::table('posts')
            ->whereNotNull('subject_id')
            ->select('id', 'subject_id')
            ->orderBy('id')
            ->chunk(500, function ($rows) {
                $now = now();
                $insert = [];

            foreach ($rows as $row) {
                $insert[] = [
                    'post_id' => $row->id,
                    'subject_id' => $row->subject_id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            DB::table('post_subject')->insertOrIgnore($insert);
        });
    }

    public function down(): void
    {
        // do nothing (safe)
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('course_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['course_id', 'subject_id']);
            $table->index(['subject_id', 'course_id']);
        });

        if (Schema::hasColumn('subjects', 'course_id')) {
            $now = now();

            DB::table('subjects')
                ->whereNotNull('course_id')
                ->select('id', 'course_id')
                ->orderBy('id')
                ->chunkById(500, function ($subjects) use ($now) {
                    $rows = [];

                    foreach ($subjects as $subject) {
                        $rows[] = [
                            'course_id' => $subject->course_id,
                            'subject_id' => $subject->id,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }

                    DB::table('course_subject')->insertOrIgnore($rows);
                });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('course_subject');
    }
};

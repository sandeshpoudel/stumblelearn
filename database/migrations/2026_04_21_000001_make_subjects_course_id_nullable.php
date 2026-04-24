<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('subjects', 'course_id')) {
            return;
        }

        Schema::table('subjects', function (Blueprint $table) {
            try {
                $table->dropForeign(['course_id']);
            } catch (Throwable $e) {
                //
            }

            $table->foreignId('course_id')->nullable()->change();
            $table->foreign('course_id')->references('id')->on('courses')->nullOnDelete();
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('subjects', 'course_id')) {
            return;
        }

        Schema::table('subjects', function (Blueprint $table) {
            try {
                $table->dropForeign(['course_id']);
            } catch (Throwable $e) {
                //
            }

            $table->foreignId('course_id')->nullable(false)->change();
            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnDelete();
        });
    }
};

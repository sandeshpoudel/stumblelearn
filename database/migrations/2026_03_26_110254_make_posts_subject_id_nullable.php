<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // If you have a foreign key, we must drop it before changing column
            // The default FK name is usually posts_subject_id_foreign
            try {
                $table->dropForeign(['subject_id']);
            } catch (\Throwable $e) {
                // ignore if it doesn't exist / different name
            }

            $table->foreignId('subject_id')->nullable()->change();

            // Re-add FK (nullable allowed)
            $table->foreign('subject_id')->references('id')->on('subjects')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            try {
                $table->dropForeign(['subject_id']);
            } catch (\Throwable $e) {
                //
            }

            $table->foreignId('subject_id')->nullable(false)->change();
            $table->foreign('subject_id')->references('id')->on('subjects')->cascadeOnDelete();
        });
    }
};
<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Post;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $bca = Course::firstOrCreate(['slug' => 'bca'], ['name' => 'BCA']);
        $bit = Course::firstOrCreate(['slug' => 'bit'], ['name' => 'BIT']);

        $dsa = Subject::firstOrCreate(
            ['course_id' => $bca->id, 'slug' => 'dsa'],
            ['name' => 'DSA']
        );

        $se = Subject::firstOrCreate(
            ['course_id' => $bca->id, 'slug' => 'software-engineering'],
            ['name' => 'Software Engineering']
        );

        $web = Subject::firstOrCreate(
            ['course_id' => $bit->id, 'slug' => 'web-development'],
            ['name' => 'Web Development']
        );

        $posts = [
            [$dsa, 'Introduction to Linked Lists', 'A linked list is a linear data structure where elements are connected via pointers.'],
            [$dsa, 'Stacks vs Queues', 'Stacks are LIFO while queues are FIFO. Use stacks for undo/history, queues for scheduling.'],
            [$dsa, 'Big-O Basics', 'Big-O describes how runtime grows with input size: O(1), O(log n), O(n), O(n log n), O(n^2).'],
            [$se, 'What is SDLC?', 'SDLC is the process of planning, building, testing, deploying, and maintaining software.'],
            [$se, 'Agile vs Waterfall', 'Agile is iterative; Waterfall is sequential. Agile fits changing requirements better.'],
            [$web, 'What is HTTP?', 'HTTP is a stateless request-response protocol used on the web.'],
            [$web, 'REST APIs', 'REST uses resource-based URLs and standard HTTP methods like GET/POST/PUT/DELETE.'],
        ];

        foreach ($posts as [$subject, $title, $content]) {
            Post::firstOrCreate(
                ['subject_id' => $subject->id, 'slug' => Str::slug($title)],
                ['title' => $title, 'content' => $content, 'is_published' => true]
            );
        }
    }
}
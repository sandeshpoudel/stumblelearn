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
        $bicte = Course::firstOrCreate(['slug' => 'bicte'], ['name' => 'BICTE']);

        $dsa = Subject::firstOrCreate(['slug' => 'dsa'], ['name' => 'DSA']);
        $se = Subject::firstOrCreate(['slug' => 'software-engineering'], ['name' => 'Software Engineering']);
        $web = Subject::firstOrCreate(['slug' => 'web-development'], ['name' => 'Web Development']);

        $dsa->courses()->syncWithoutDetaching([$bca->id, $bit->id, $bicte->id]);
        $se->courses()->syncWithoutDetaching([$bca->id, $bicte->id]);
        $web->courses()->syncWithoutDetaching([$bit->id, $bicte->id]);

        $posts = [
            [$dsa, 'Introduction to Linked Lists', 'A linked list is a linear data structure where elements are connected through references. It is useful when you need efficient insertions and deletions without shifting many items.'],
            [$dsa, 'Stacks vs Queues', 'Stacks are LIFO while queues are FIFO. Use stacks for undo/history flows and queues for scheduling, buffering, or breadth-first traversal.'],
            [$dsa, 'Big-O Basics', 'Big-O describes how runtime grows with input size: O(1), O(log n), O(n), O(n log n), and O(n^2). It helps compare algorithms without depending on hardware.'],
            [$se, 'What is SDLC?', 'SDLC is the process of planning, building, testing, deploying, and maintaining software. A clear SDLC reduces rework and improves team visibility.'],
            [$se, 'Agile vs Waterfall', 'Agile is iterative while Waterfall is sequential. Agile fits changing requirements better, while Waterfall can work for stable and well-defined scopes.'],
            [$web, 'What is HTTP?', 'HTTP is a stateless request-response protocol used on the web. Browsers send requests, servers return responses, and each request carries the context it needs.'],
            [$web, 'REST APIs', 'REST uses resource-based URLs and standard HTTP methods like GET, POST, PUT, PATCH, and DELETE to model actions on data.'],
        ];

        foreach ($posts as [$subject, $title, $content]) {
            $post = Post::firstOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'subject_id' => $subject->id,
                    'title' => $title,
                    'content' => $content,
                    'is_published' => true,
                ]
            );

            $post->subjects()->syncWithoutDetaching([$subject->id]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Post;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ComprehensiveCurriculumSeeder extends Seeder
{
    /**
     * A normalized starter catalog inspired by common TU, Pokhara University,
     * and Purbanchal University computing and IT curricula in Nepal.
     *
     * The app currently models "course" as a program name, not a university
     * version, so overlapping subjects are reused across programs.
     */
    public function run(): void
    {
        $courseSubjects = [
            'bca' => [
                'name' => 'BCA',
                'subjects' => [
                    'English I',
                    'English II',
                    'Mathematics I',
                    'Mathematics II',
                    'Computer Fundamentals and Applications',
                    'Digital Logic',
                    'Society and Technology',
                    'C Programming',
                    'Financial Accounting',
                    'Microprocessor and Computer Architecture',
                    'Data Structures and Algorithms',
                    'Object Oriented Programming in Java',
                    'System Analysis and Design',
                    'Probability and Statistics',
                    'Web Technology',
                    'Operating System',
                    'Numerical Methods',
                    'Software Engineering',
                    'Scripting Language',
                    'Database Management System',
                    'Management Information System',
                    '.NET Technology',
                    'Computer Networking',
                    'Introduction to Management',
                    'Computer Graphics',
                    'Mobile Programming',
                    'Distributed System',
                    'Applied Economics',
                    'Advanced Java Programming',
                    'Network Programming',
                    'Cyber Law and Professional Ethics',
                    'Cloud Computing',
                    'Internship',
                    'Operations Research',
                    'Project Work',
                    'E-Commerce',
                    'Multimedia Systems',
                    'Artificial Intelligence',
                ],
            ],
            'bicte' => [
                'name' => 'BICTE',
                'subjects' => [
                    'Foundation of Education',
                    'Educational Psychology',
                    'Curriculum and Evaluation',
                    'ICT in Education',
                    'Computer Fundamentals and Applications',
                    'C Programming',
                    'Digital Logic',
                    'Mathematics for ICT',
                    'Object Oriented Programming',
                    'Data Structures and Algorithms',
                    'Database Management System',
                    'Web Technology',
                    'Computer Networking',
                    'Operating System',
                    'Instructional Design',
                    'Educational Technology',
                    'Multimedia Systems',
                    'E-Learning Design',
                    'Research Methodology',
                    'Assessment and Measurement',
                    'Software Engineering',
                    'Mobile Learning',
                    'Inclusive Education and Assistive Technology',
                    'School Management Information System',
                    'Cyber Law and Professional Ethics',
                    'Project Work',
                    'Teaching Practice',
                    'Internship',
                    'Cloud Computing',
                    'Information Security',
                    'Artificial Intelligence in Education',
                    'Learning Management Systems',
                    'Digital Content Development',
                    'Educational Data Analysis',
                    'Community ICT Project',
                ],
            ],
            'bim' => [
                'name' => 'BIM',
                'subjects' => [
                    'English Composition',
                    'Business Mathematics',
                    'Digital Logic',
                    'C Programming',
                    'Financial Accounting',
                    'Business Communication',
                    'Discrete Mathematics',
                    'Object Oriented Programming in Java',
                    'Microprocessor and Computer Architecture',
                    'Organizational Behavior and Human Resource Management',
                    'Data Structures and Algorithms',
                    'Database Management System',
                    'Business Statistics',
                    'Computer Graphics',
                    'Managerial Economics',
                    'Business Data Communication and Networking',
                    'Software Engineering',
                    'Web Technology',
                    'Operations Management',
                    'Cost and Management Accounting',
                    'Business Information Systems',
                    'Business Research Methods',
                    'Computer Security and Cyber Law',
                    'Marketing Management',
                    'Business Finance',
                    'Decision Support System',
                    'Business Environment',
                    'IT Entrepreneurship and Innovation',
                    'Database Administration',
                    'E-Commerce',
                    'Management Information System',
                    'Strategic Management',
                    'Software Project Management',
                    'Internship',
                    'Project Work',
                    'Data Warehousing and Data Mining',
                    'Cloud Computing',
                    'Business Analytics',
                ],
            ],
            'bit' => [
                'name' => 'BIT',
                'subjects' => [
                    'Introduction to Information Technology',
                    'C Programming',
                    'Digital Logic',
                    'Basic Mathematics',
                    'Sociology',
                    'Microprocessor and Computer Architecture',
                    'Discrete Structure',
                    'Object Oriented Programming',
                    'Basic Statistics',
                    'Economics',
                    'Data Structures and Algorithms',
                    'Database Management System',
                    'Numerical Methods',
                    'Operating System',
                    'Principles of Management',
                    'Web Technology I',
                    'Artificial Intelligence',
                    'System Analysis and Design',
                    'Network and Data Communications',
                    'Operations Research',
                    'Web Technology II',
                    'Software Engineering',
                    'Information Security',
                    'Computer Graphics',
                    'Technical Writing',
                    '.NET Centric Computing',
                    'Database Administration',
                    'Management Information System',
                    'Research Methodology',
                    'Mobile Application Development',
                    'Advanced Java Programming',
                    'Software Project Management',
                    'E-Commerce',
                    'Project Work',
                    'Network and System Administration',
                    'E-Governance',
                    'Internship',
                    'Cloud Computing',
                    'Data Warehousing and Data Mining',
                    'Multimedia Computing',
                ],
            ],
            'csit' => [
                'name' => 'BSc CSIT',
                'subjects' => [
                    'Introduction to Information Technology',
                    'C Programming',
                    'Digital Logic',
                    'Mathematics I',
                    'Physics',
                    'Discrete Structure',
                    'Object Oriented Programming',
                    'Microprocessor',
                    'Mathematics II',
                    'Statistics I',
                    'Data Structures and Algorithms',
                    'Numerical Method',
                    'Computer Architecture',
                    'Computer Graphics',
                    'Statistics II',
                    'Theory of Computation',
                    'Computer Networks',
                    'Operating Systems',
                    'Database Management System',
                    'Artificial Intelligence',
                    'Design and Analysis of Algorithms',
                    'System Analysis and Design',
                    'Cryptography',
                    'Simulation and Modeling',
                    'Web Technology',
                    'Software Engineering',
                    'Compiler Design',
                    'E-Governance',
                    '.NET Centric Computing',
                    'Technical Writing',
                    'Advanced Java Programming',
                    'Data Warehousing and Data Mining',
                    'Principles of Management',
                    'Project Work',
                    'Information Retrieval',
                    'Database Administration',
                    'Network and System Administration',
                    'Internship',
                    'Cloud Computing',
                    'Real Time Systems',
                    'Image Processing',
                    'Multimedia Computing',
                    'Knowledge Management',
                    'Society and Ethics in IT',
                ],
            ],
        ];

        foreach ($courseSubjects as $courseSlug => $courseData) {
            $course = Course::firstOrCreate(
                ['slug' => $courseSlug],
                ['name' => $courseData['name']]
            );

            foreach ($courseData['subjects'] as $subjectName) {
                $subject = Subject::firstOrCreate(
                    ['slug' => Str::slug($subjectName)],
                    ['name' => $subjectName]
                );

                $subject->courses()->syncWithoutDetaching([$course->id]);

                foreach ($this->postsFor($subjectName) as $index => $postData) {
                    $slug = Str::slug($subjectName . '-' . ($index + 1) . '-' . $postData['title']);

                    $post = Post::firstOrCreate(
                        [
                            'subject_id' => $subject->id,
                            'slug' => $slug,
                        ],
                        [
                            'title' => $postData['title'],
                            'content' => $postData['content'],
                            'is_published' => true,
                        ]
                    );

                    $post->subjects()->syncWithoutDetaching([$subject->id]);
                }
            }
        }
    }

    private function postsFor(string $subject): array
    {
        $plain = $this->plainSubject($subject);
        $lower = Str::lower($plain);

        return [
            [
                'title' => "Introduction to {$plain}",
                'content' => "Start {$lower} like opening a new toolbox: first learn what each tool is for, then learn when to use it. {$plain} introduces the main ideas, vocabulary, and habits that help you understand the subject without fear.\n\nIn simple words, this topic answers three questions: what is this subject, why does it matter, and where will you use it in real study or work? Keep a small notebook of examples, because examples turn abstract definitions into something your brain can hold.",
            ],
            [
                'title' => "Core Concepts of {$plain}",
                'content' => "Every subject has a few ideas that behave like pillars. In {$lower}, these core concepts support almost every chapter that comes later, so learning them early saves effort.\n\nRead each concept slowly, connect it with one familiar example, and try explaining it aloud in your own words. If the explanation sounds simple, you are not making it childish; you are making it clear.",
            ],
            [
                'title' => "Important Terms in {$plain}",
                'content' => "Technical subjects become easier when the vocabulary stops feeling like a foreign language. {$plain} has terms that may look difficult at first, but most of them name practical ideas.\n\nBuild a tiny glossary with the term, one-line meaning, and one example. For instance, write what the word means, where it appears, and what mistake students usually make with it.",
            ],
            [
                'title' => "How {$plain} Works in Real Life",
                'content' => "{$plain} is not only for exams; it appears in offices, schools, software, networks, reports, classrooms, and everyday digital systems. Real examples make the subject feel alive.\n\nPick one simple case from your surroundings and map the subject onto it. Ask: who uses it, what problem is solved, what input is needed, and what output is produced?",
            ],
            [
                'title' => "Step-by-Step Learning Path for {$plain}",
                'content' => "A good learning path prevents confusion. Begin {$lower} with basic definitions, move to small examples, practice simple problems, and only then try larger case studies or projects.\n\nUse the ladder method: learn one idea, test it, connect it with the previous idea, and write a short summary. This keeps your learning steady instead of making it feel like random notes.",
            ],
            [
                'title' => "Common Mistakes in {$plain}",
                'content' => "Most mistakes in {$lower} happen because students memorize words before understanding the purpose behind them. Memorization can help in revision, but it cannot replace meaning.\n\nWatch for three traps: skipping basics, copying examples without changing them, and ignoring diagrams or tables. When you make a mistake, write the reason beside the correction so the same mistake becomes useful.",
            ],
            [
                'title' => "Practice Ideas for {$plain}",
                'content' => "Practice turns {$lower} from reading material into skill. You do not need a huge project at the beginning; small focused tasks are better.\n\nTry making flashcards, solving previous questions, drawing concept maps, writing short explanations, or building a mini example. The goal is not perfection; the goal is repeated contact with the idea until it becomes familiar.",
            ],
            [
                'title' => "Exam-Focused Notes for {$plain}",
                'content' => "For exams, {$lower} should be revised in layers. First revise definitions, then diagrams or formulas, then short questions, and finally long answers or numerical problems if the subject has them.\n\nPrepare answers with a clean structure: introduction, key points, example, and conclusion. A simple answer with correct structure often scores better than a long answer that wanders.",
            ],
            [
                'title' => "Mini Project or Activity for {$plain}",
                'content' => "A mini project helps you see {$lower} as something you can use, not only something you must study. Choose a small activity that can be finished in one or two sittings.\n\nExamples include creating a summary chart, preparing a classroom presentation, building a tiny program, analyzing a business case, designing a database table, or reviewing a real system. Keep the output simple and explain what you learned.",
            ],
            [
                'title' => "Revision Summary of {$plain}",
                'content' => "Before closing {$lower}, make a one-page revision sheet. Include the main definition, five key terms, three important examples, two common mistakes, and one question you still want to ask.\n\nThis summary becomes your quick map before exams and interviews. Good revision is not reading everything again; it is remembering the shape of the subject clearly.",
            ],
        ];
    }

    private function plainSubject(string $subject): string
    {
        return str_replace(['.NET', 'BSc'], ['Dot NET', 'BSc'], $subject);
    }
}

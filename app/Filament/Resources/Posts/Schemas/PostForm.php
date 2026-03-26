<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Course;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            // UI-only filter (not saved in posts table)
            Select::make('course_filter')
                ->label('Course')
                ->options(fn () => Course::query()->orderBy('name')->pluck('name', 'id')->all())
                ->searchable()
                ->live()
                ->dehydrated(false)
                ->helperText('Choose a course to filter subjects.'),

            MultiSelect::make('subjects')
                ->relationship('subjects', 'name')
                ->label('Subjects')
                ->required()
                ->searchable()
                ->preload()
                ->options(function (callable $get) {
                    $courseId = $get('course_filter');

                    // If no course chosen, show all subjects but with clear labels
                    $query = \App\Models\Subject::query()->with('course')->orderBy('name');

                    if ($courseId) {
                        $query->where('course_id', $courseId);
                    }

                    return $query->get()->mapWithKeys(function ($subject) {
                        return [
                            $subject->id => $subject->course->name . ' — ' . $subject->name,
                        ];
                    })->all();
                })
                ->helperText('You can select multiple subjects (e.g., DSA in BCA + BIT + BICTE).'),

            TextInput::make('title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function ($state, callable $set, $get) {
                    $currentSlug = (string) ($get('slug') ?? '');
                    if ($currentSlug === '') {
                        $set('slug', Str::slug((string) $state));
                    }
                }),

            TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true)
                ->helperText('Auto-generated from title. You can edit it.'),

            Textarea::make('content')
                ->required()
                ->columnSpanFull(),

            Toggle::make('is_published')
                ->default(true),
        ]);
    }
}
<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Course;
use App\Models\Subject;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('course_filter')
                ->label('Course filter')
                ->options(fn () => Course::query()->orderBy('name')->pluck('name', 'id')->all())
                ->searchable()
                ->live()
                ->dehydrated(false)
                ->helperText('Optional: choose a course to narrow the reusable subject list.'),

            MultiSelect::make('subjects')
                ->relationship('subjects', 'name')
                ->label('Subjects')
                ->required()
                ->searchable()
                ->preload()
                ->options(function (callable $get) {
                    $query = Subject::query()->with('courses')->orderBy('name');
                    $courseId = $get('course_filter');

                    if ($courseId) {
                        $query->whereHas('courses', fn ($courseQuery) => $courseQuery->whereKey($courseId));
                    }

                    return $query->get()->mapWithKeys(function (Subject $subject) {
                        $courses = $subject->courses->pluck('name')->join(', ');

                        return [
                            $subject->id => $subject->name . ($courses ? ' - ' . $courses : ''),
                        ];
                    })->all();
                })
                ->helperText('Select every subject this post should appear under.'),

            TextInput::make('title')
                ->required()
                ->live(onBlur: true)
                ->maxLength(255)
                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    if ((string) ($get('slug') ?? '') === '') {
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
                ->rows(8)
                ->columnSpanFull(),

            Toggle::make('is_published')
                ->label('Published')
                ->default(true),
        ]);
    }
}

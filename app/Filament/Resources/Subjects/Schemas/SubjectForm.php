<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                MultiSelect::make('courses')
                    ->relationship('courses', 'name')
                    ->label('Courses')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->helperText('Attach this subject to every course where it belongs. Example: DSA can be used in BCA, BIT, and BICTE.'),

                TextInput::make('name')
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
                    ->helperText('Keep this reusable, such as dsa or web-development.'),
            ]);
    }
}

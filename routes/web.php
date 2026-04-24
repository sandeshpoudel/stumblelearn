<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\LibraryController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/learn', [LearnController::class, 'index'])->name('learn');

    Route::get('/learn/{course:slug}', [LearnController::class, 'course'])->name('learn.course');
    Route::get('/learn/{course:slug}/{subject}', [LearnController::class, 'subject'])->name('learn.subject');

    Route::post('/learn/posts/{post}/save', [LearnController::class, 'save'])->name('learn.posts.save');
    Route::post('/learn/posts/{post}/ignore', [LearnController::class, 'ignore'])->name('learn.posts.ignore');
    Route::post('/learn/posts/{post}/understood', [LearnController::class, 'understood'])->name('learn.posts.understood');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/saved', [LibraryController::class, 'saved'])->name('saved');
    Route::delete('/saved/{post}', [LibraryController::class, 'unsave'])->name('saved.delete');

    Route::get('/progress', [LibraryController::class, 'progress'])->name('progress');
    Route::delete('/progress/{post}', [LibraryController::class, 'ununderstood'])->name('progress.delete');

    Route::get('/ignored', [LibraryController::class, 'ignored'])->name('ignored');
    Route::delete('/ignored/{post}', [LibraryController::class, 'unignore'])->name('ignored.delete');
});

require __DIR__.'/auth.php';

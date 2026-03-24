<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LearnController;


Route::get('/', function () {
    return view('welcome'); // Public landing page
})->name('home');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/learn', function () {
//         return view('learn');
//     })->name('learn');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/learn', [LearnController::class, 'index'])->name('learn');

    Route::get('/learn/{course:slug}', [LearnController::class, 'course'])->name('learn.course');
    Route::get('/learn/{course:slug}/{subject:slug}', [LearnController::class, 'subject'])->name('learn.subject');

    Route::post('/learn/posts/{post}/save', [LearnController::class, 'save'])->name('learn.posts.save');
    Route::post('/learn/posts/{post}/ignore', [LearnController::class, 'ignore'])->name('learn.posts.ignore');
    Route::post('/learn/posts/{post}/understood', [LearnController::class, 'understood'])->name('learn.posts.understood');
});

require __DIR__.'/auth.php';
<?php

use App\Actions\Profile\Delete;
use App\Actions\Profile\Edit;
use App\Actions\Profile\Update;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', Edit::class)->name('profile.edit');
    Route::patch('/profile', Update::class)->name('profile.update');
    Route::delete('/profile', Delete::class)->name('profile.destroy');
});

require __DIR__.'/auth.php';

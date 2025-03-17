<?php

use Livewire\Volt\Volt;
use App\Livewire\Course\CreateCourse;
use Illuminate\Support\Facades\Route;
use App\Livewire\Articles\ShowArticles;
use App\Livewire\Articles\CreateArticles;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('/create-course', CreateCourse::class)->name('create-course');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

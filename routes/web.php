<?php

use Livewire\Volt\Volt;
use App\Livewire\RoleComponent;
use App\Livewire\Course\CreateCourse;
use Illuminate\Support\Facades\Route;
use App\Livewire\Articles\ShowArticles;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
    Route::get('/edit-course/{productId}', CreateCourse::class)->name('edit-course');

    Route::resource('roles', RoleController::class);
    Route::get('/rol', RoleComponent::class)->name('roles.index');

    Route::get('/role', [RoleController::class, 'create']);
    Route::get('/role/list', [RoleController::class, 'index']);

    Route::get('/user', [UserController::class, 'create']);
    Route::get('/show', [UserController::class, 'index']);
    Route::resource('users', UserController::class);

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

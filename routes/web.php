<?php

use Livewire\Volt\Volt;
use App\Livewire\RoleManagement;
use App\Livewire\Course\CreateCourse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



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


    Route::get('/roles', RoleManagement::class)->name('roles.index');

    Route::get('/user', [UserController::class, 'create']);
    Route::get('/show', [UserController::class, 'index']);
    Route::resource('users', UserController::class);

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('spaces', 'spaces')
    ->middleware(['auth', 'verified'])
    ->name('spaces');
Route::view('spaces/{id}', 'space')
    ->middleware(['auth', 'verified'])
    ->name('space');
Route::view('spaces/{id}/stories', 'stories')
    ->middleware(['auth', 'verified'])
    ->name('stories');
Route::view('spaces/{spaceid}/stories/{storyid}', 'story')
    ->middleware(['auth', 'verified'])
    ->name('story');
    Route::view('spaces/{id}/workflows', 'workflows')
        ->middleware(['auth', 'verified'])
        ->name('workflows');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

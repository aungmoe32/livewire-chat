<?php

use App\Livewire\Users;
use App\Livewire\Chat\Index;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';


Route::middleware('auth')->group(function () {

    Route::get('/chat', Index::class)->name('chat.index');
    // Route::get('/chat/{query}',Chat::class)->name('chat');

    Route::get('/users', Users::class)->name('users');
});

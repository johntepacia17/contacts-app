<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', fn () => redirect()->route('contacts.index'))
    ->middleware(['auth'])
    ->name('dashboard');


// Keep Breeze auth routes
require __DIR__.'/auth.php';

// Contacts
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/contacts/search', [ContactController::class, 'search'])->name('contacts.search');
    Route::resource('contacts', ContactController::class)->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Superadmin
Route::middleware(['auth', 'verified', 'role:superadmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('users', UserManagementController::class)->only(['index', 'create', 'store']);
    });

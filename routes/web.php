<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Viewer route - viewer, editor, admin can access
Route::middleware(['auth', 'role:viewer|editor|admin'])->group(function () {
    Route::get('/viewer', function () {
        return 'Viewer Page - You can VIEW content';
    });
});

// Editor route - editor and admin can access
Route::middleware(['auth', 'role:editor|admin'])->group(function () {
    Route::get('/posts/create', function () {
        return 'Create Post Page - You can CREATE and EDIT content';
    });
});

// Admin route - only admin can access
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Admin Panel - You can MANAGE everything';
    });
});

require __DIR__ . '/auth.php';

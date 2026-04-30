<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\PermissionController;


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
Route::middleware(['auth', 'role:viewer|editor|admin|super admin'])->group(function () {
    Route::get('/viewer', function () {
        return 'Viewer Page - You can VIEW content';
    });
});

// Editor route - editor and admin can access
// Route::middleware(['auth', 'role:editor|admin'])->group(function () {
//     Route::get('/posts/create', function () {
//         return 'Create Post Page - You can CREATE and EDIT content';
//     });
// });

// Admin route - only admin can access
Route::middleware(['auth', 'role:admin|super admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Admin Panel - You can MANAGE everything';
    });
});

// Post routes - auth required for all
//we removed role: from middleware here — the permission check now happens inside the controller using $user->can()
Route::middleware(['auth'])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/manage-users', [PostController::class, 'manageUsers'])->name('posts.manageUsers');
    // Test delete permission
    Route::get('/test-delete/{id}', [PostController::class, 'destroy']);
});




// Role management routes - admin only
Route::middleware(['auth', 'role:admin|super admin'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::get('/users', [UserRoleController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserRoleController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserRoleController::class, 'update'])->name('users.update');
    Route::resource('permissions', PermissionController::class)->only(['index', 'create', 'store', 'destroy']);
});


require __DIR__ . '/auth.php';

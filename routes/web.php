<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\LicenseAdminController;
use App\Http\Controllers\LanguageController;

// Home route
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route(auth()->user()->isAdmin() ? 'admin.dashboard' : 'user.dashboard');
    }
    return redirect()->route('login');
})->name('home');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Language switching route (public - should be defined before other routes)
Route::get('/language/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/register', [AdminController::class, 'showRegister'])->name('register');
    Route::post('/register', [AdminController::class, 'register']);
    Route::get('/edit-link/{link}', [AdminController::class, 'editLink'])->name('edit-link');
    Route::post('/update-link/{link}', [AdminController::class, 'updateLink'])->name('update-link');
    Route::get('/search-users', [AdminController::class, 'searchUsers'])->name('search-users');
    Route::post('/create-link', [AdminController::class, 'createLink'])->name('create-link');
    Route::delete('/delete-user/{user}', [AdminController::class, 'deleteUser'])->name('delete-user');
    Route::delete('/delete-link/{link}', [AdminController::class, 'deleteLink'])->name('delete-link');
    
    // License management routes (admin only)
    Route::resource('license', LicenseAdminController::class);
});

// User routes
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/update-settings', [UserController::class, 'updateSettings'])->name('update-settings');
    Route::post('/add-button', [UserController::class, 'addButton'])->name('add-button');
    Route::delete('/delete-button/{button}', [UserController::class, 'deleteButton'])->name('delete-button');
    Route::post('/toggle-button/{button}', [UserController::class, 'toggleButton'])->name('toggle-button');
    Route::get('/edit-button/{button}', [UserController::class, 'editButton'])->name('edit-button');
    Route::post('/edit-button/{button}', [UserController::class, 'updateButton'])->name('update-button');
    Route::post('/reorder-buttons', [UserController::class, 'reorderButtons'])->name('reorder-buttons');
    
    // Remove the duplicate language route from here since it's defined as public above
});

// Public routes
Route::get('/u/{slug}', [PublicController::class, 'showPublicPage'])->name('public.page');
Route::get('/click/{button}', [PublicController::class, 'trackClick'])->name('track-click');
Route::get('/uploads/{filename}', [PublicController::class, 'serveUpload'])->name('serve-upload');
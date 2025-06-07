<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::get('/admin', function () {
    return view('admin.index_admin');
})->name('admin.dashboard')->middleware('auth');

Route::get('/login_admin', function () {
    return view('admin.login_admin');
})->name('login_admin');

// Login Routes
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::get('auth/facebook', [LoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [LoginController::class, 'handleFacebookCallback'])->name('auth.facebook.callback');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Profile routes
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::put('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    // Post management routes
    Route::get('/admin/post', [PostController::class, 'index'])->name('admin.post_admin');
    Route::get('/admin/post/create', [PostController::class, 'create'])->name('admin.post.create');
    Route::post('/admin/post', [PostController::class, 'store'])->name('admin.post.store');
    Route::get('/admin/post/{post}/edit', [PostController::class, 'edit'])->name('admin.post.edit');
    Route::put('/admin/post/{post}', [PostController::class, 'update'])->name('admin.post.update');
    Route::delete('/admin/post/{post}', [PostController::class, 'destroy'])->name('admin.post.destroy');
});

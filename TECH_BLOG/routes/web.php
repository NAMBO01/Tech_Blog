<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\FieldAdminController;
use App\Http\Controllers\Admin\TagAdminController;
use App\Http\Controllers\Admin\LanguageAdminController;
use App\Http\Controllers\Admin\RevisionAdminController;
use App\Http\Controllers\Admin\CommentAdminController;
use App\Http\Controllers\Admin\MediaAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;

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

// Public routes
Route::get('/', [PostUserController::class, 'index'])->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/{tag:slug}', [TagController::class, 'show'])->name('tags.show');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Search routes
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');
Route::get('/search/ajax', [App\Http\Controllers\SearchController::class, 'ajaxSearch'])->name('search.ajax');

// Admin Routes
// Route::get('/admin', function () {
//     return view('admin.index_admin');
// })->name('admin.dashboard')->middleware('auth');

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

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Posts
    Route::get('/posts', [PostController::class, 'index'])->name('post_admin');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{post}/revisions', [PostController::class, 'revisions'])->name('posts.revisions');
    Route::post('/posts/{post}/revisions/{revision}/restore', [PostController::class, 'restoreRevision'])->name('posts.restore-revision');
    Route::post('/posts/{post}/submit-revision', [PostController::class, 'submitRevision'])->name('posts.submit-revision');


    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin_cate');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Fields
    Route::get('/fields', [FieldController::class, 'index'])->name('fields.index');
    Route::get('/fields/create', [FieldController::class, 'create'])->name('fields.create');
    Route::post('/fields', [FieldController::class, 'store'])->name('fields.store');
    Route::get('/fields/{field}/edit', [FieldController::class, 'edit'])->name('fields.edit');
    Route::put('/fields/{field}', [FieldController::class, 'update'])->name('fields.update');
    Route::delete('/fields/{field}', [FieldController::class, 'destroy'])->name('fields.destroy');


    // Tags
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

    // Users
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Quản lý người dùng (admin)
Route::prefix('admin/users')->name('admin.users.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
});

Route::get('/login', [LoginUserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginUserController::class, 'login']);
Route::post('/logout', [LoginUserController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterUserController::class, 'showRegisterUser'])->name('register');
Route::post('/register', [RegisterUserController::class, 'registerUser'])->name('register.post');

// Profile user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'userProfile'])->name('user.profile');
});

Route::middleware('auth')->get('/bookmarks', [App\Http\Controllers\UserController::class, 'bookmarks'])->name('user.bookmarks');

Route::get('/admin/revisions/pending', [PostController::class, 'pendingRevisions'])->name('admin.revisions.pending');
Route::post('/admin/revisions/{revision}/approve', [PostController::class, 'approveRevision'])->name('admin.revisions.approve');
Route::post('/admin/revisions/{revision}/reject', [PostController::class, 'rejectRevision'])->name('admin.revisions.reject');

Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts/{post}/rate', [PostController::class, 'rate'])->name('posts.rate');
Route::post('/posts/{post}/bookmark', [PostController::class, 'bookmark'])->name('posts.bookmark');
Route::post('/posts/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');
Route::post('/posts/{post}/comment/ajax', [App\Http\Controllers\PostController::class, 'commentAjax'])->name('posts.comment.ajax');

<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestPageController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\TrainerBookingController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route("admin.dashboard");
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Guest Page Routing
Route::get('/', [GuestPageController::class, 'index'])->name('home');
Route::get('/about', [GuestPageController::class, 'about'])->name('about');
Route::get('/services', [GuestPageController::class, 'services'])->name('services');
Route::get('/contact', [GuestPageController::class, 'contact'])->name('contact');
Route::get('/home-workouts/{target?}', [GuestPageController::class, 'homeWorkouts'])->name('home-workouts');
Route::get('/sample', [GuestPageController::class, 'sample'])->name('guest-sample');
Route::post('/contact', [GuestPageController::class, 'submitMessageContact'])->name('contact.submit');

//For Customers with or without Memberships
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
    Route::get('/membership', [MembershipController::class, 'index'])->name('membership.index');
    Route::post('/membership/apply', [MembershipController::class, 'apply'])->name('membership.apply');
    Route::patch('/membership/cancel', [MembershipController::class, 'cancelMembership'])->name('membership.cancel');
    Route::get('/book-trainer', [TrainerBookingController::class, 'index'])->name('trainer.book');
    Route::post('/book-trainer', [TrainerBookingController::class, 'store'])->name('trainer.store');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts', [PostController::class, 'submit'])->name('posts.submit');
});

//For Administrators
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminPostController::class, 'index'])->name('dashboard');
    Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [AdminPostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [AdminPostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/{post}', [AdminPostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.delete');
});

require __DIR__ . '/auth.php';

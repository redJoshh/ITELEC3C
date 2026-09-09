<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestPageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Guest Page Routing
Route::get('/', [GuestPageController::class, 'index'])->name('home');
Route::get('/about', [GuestPageController::class, 'about'])->name('about');
Route::get('/services', [GuestPageController::class, 'services'])->name('services');
Route::get('/contact', [GuestPageController::class, 'contact'])->name('contact');
Route::get('/home-workouts/{target?}', [GuestPageController::class, 'homeWorkouts'])->name('home-workouts');

//Guest POST
Route::post('/contact', [GuestPageController::class, 'submitMessageContact'])->name('contact.submit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AgeRestriction;

Route::get('/', function () {
    return view('welcome');
})->middleware('age.restriction');

Route::get('/agelimitpage', function () {
    return view('agelimit');
})->name('agelimit');

Route::get('/menu', function () {
    echo "menu";
})->name('menu');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');

})->name('welcome');

// Route::get('/agelimitpage', function () {
//     return view('agelimit');
// })->name('agelimit');

Route::get('/menu', function () {
    echo "menu";
})->name('menu');
// Route::get('/dashboard', function () {
//     $userRole = auth()->user()->role ?? null;
//     return view('dashboard', compact('userRole'));
// })->middleware(['auth', 'check.role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('products.delete');
});

Route::middleware(['auth', 'check.role:user'])->group(function () {
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/products/{product}/purchase', [ProductController::class, 'purchase'])->name('products.purchase');
    Route::post('/products/{product}/review', [ProductController::class, 'review'])->name('products.review');
});

require __DIR__ . '/auth.php';

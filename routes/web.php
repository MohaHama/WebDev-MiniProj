
<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

//Products
Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');

Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('auth');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

//Only admins can delete products
Route::delete('/products/{id}', [ProductController::class, 'destroy'])
    ->name('products.destroy')
    ->middleware(['auth', 'admin']);

//Get the image of a product
Route::get('/products/{id}/image', [ProductController::class, 'image'])->name('products.image');

//Registration
Route::get('/register', [RegisterController::class, 'create'])->name('register')->middleware('guest');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store')->middleware('guest');

//Login
Route::get('/login', [LoginController::class, 'create'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'store'])->name('login.store')->middleware('guest');

//Logout
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

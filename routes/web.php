<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Get the image of a product
Route::get('/products/{id}/image', [ProductController::class, 'image'])->name('products.image');

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('/posts', \App\Http\Controllers\PostController::class);
Route::resource('/siswas', \App\Http\Controllers\SiswaController::class);
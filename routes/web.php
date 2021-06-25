<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/productos/{category?}', function ($category = NULL) {
    return view('productos', [ 
        'category' => $category
    ]);
})->name('productos');

Route::get('/producto/{slug}', function ($slug) {
    return view('producto', [ 
        'slug' => $slug
    ]);
})->name('producto');

Route::get('/my-products', function () {
    return view('myProducts');
})->name('myProducts');

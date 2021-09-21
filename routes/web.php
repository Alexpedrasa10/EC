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
    return view('dashboard');
})->name('dashboard');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

// Dinamic
Route::get('/productos/{category?}', function ($category = NULL) {
    return view('productos', [ 
        'category' => $category
    ]);
})->name('productos');

Route::get('/productos/MEN', function ($category = "MEN") {
    return view('productos', [ 
        'category' => $category
    ]);
})->name('MEN');

Route::get('/productos/WOMEN', function ($category = "WOMEN") {
    return view('productos', [ 
        'category' => $category
    ]);
})->name('WOMEN');


Route::get('/producto/{slug}', function ($slug) {
    return view('producto', [ 
        'slug' => $slug
    ]);
})->name('producto');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-product/{slug?}', function ($slug = NULL) {
    return view('edit-product', [ 
        'slug' => $slug
    ]);
})->name('edit-products');

Route::get('/my-products', function () {
    return view('myProducts');
})->name('myProducts');

Route::get('/checkout-payment', function () {
    return view('checkout-payment');
})->name('checkout');


Route::get('/auth/{driver}', 'App\Http\Controllers\LoginSocial@redirect')->name('socialite');
Route::get('/auth/{driver}/callback',  'App\Http\Controllers\LoginSocial@login');

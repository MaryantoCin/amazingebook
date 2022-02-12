<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('locale/{locale?}', [App\Http\Controllers\HomeController::class, 'set_locale'])->name('set_locale');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'show_profile'])->name('show_profile');
    Route::patch('/profile', [App\Http\Controllers\HomeController::class, 'update_profile'])->name('update_profile');
    Route::get('/ebook/{ebook}', [App\Http\Controllers\HomeController::class, 'show_ebook'])->name('show_ebook');
    ROute::post('/ebook/{ebook}', [App\Http\Controllers\HomeController::class, 'rent_ebook'])->name('rent_ebook');
    Route::get('/cart', [App\Http\Controllers\HomeController::class, 'show_cart'])->name('show_cart');
    Route::delete('/order/{order}', [App\Http\Controllers\HomeController::class, 'delete_cart'])->name('delete_cart');
    Route::post('/checkout', [App\Http\Controllers\HomeController::class, 'checkout_cart'])->name('checkout_cart');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/account', [App\Http\Controllers\HomeController::class, 'show_account'])->name('show_account');
    Route::get('/account/{account}', [App\Http\Controllers\HomeController::class, 'show_update_role'])->name('show_update_role');
    Route::patch('/account/{account}', [App\Http\Controllers\HomeController::class, 'update_role'])->name('update_role');
    Route::delete('/account/{account}', [App\Http\Controllers\HomeController::class, 'delete_account'])->name('delete_account');
});

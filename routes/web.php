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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'show_profile'])->name('show_profile');
Route::patch('/profile', [App\Http\Controllers\HomeController::class, 'update_profile'])->name('update_profile');
Route::get('/ebook/{ebook}', [App\Http\Controllers\HomeController::class, 'show_book'])->name('show_book');

<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



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

Route::get('/admin/books/index', [BookController::class, 'index']);
//Route::get('/books', [BookController::class, 'books']);
Route::get('/admin/books/create', [BookController::class, 'create']);
Route::get('/admin/books/{id}', [BookController::class, 'show']);
Route::post('/admin/books/create', [BookController::class, 'store']);
Route::get('/admin/books/delete/{id}', [BookController::class, 'destroy']);
Route::get('/admin/books/update/{id}', [BookController::class, 'updateBookView']);
Route::post('/admin/books/updateBook', [BookController::class, 'updateBook']);

Route::get('/index', [UserController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'viewProduct']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cart/{id}', [UserController::class, 'getCart']);
Route::post('/cart/add', [CartController::class, 'addCart'])->name('cart.add');
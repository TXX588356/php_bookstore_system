<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
Route::get('/', [UserController::class, 'index']);
Auth::routes();


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


Route::middleware('can:isAdmin')->group(function() {
  Route::get('/admin/books/index', [BookController::class, 'index']);
  //Route::get('/books', [BookController::class, 'books']);
  Route::get('/admin/books/create', [BookController::class, 'create']);
  Route::get('/admin/books/{id}', [BookController::class, 'show']);
  Route::post('/admin/books/create', [BookController::class, 'store']);
  Route::get('/admin/books/delete/{id}', [BookController::class, 'destroy']);
  Route::get('/admin/books/update/{id}', [BookController::class, 'updateBookView']);
  Route::post('/admin/books/updateBook', [BookController::class, 'updateBook']);
});



//Route::get('/index', [UserController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'viewProduct']);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth', 'can:isUser')->group(function () {
  Route::get('/cart/{id}', [UserController::class, 'getCart']);
  Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
});


/* Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/register/admin', [RegisterController::class,'createAdmin']); */

Route::group(['middleware' => 'auth:admin'], function () {
 
 Route::view('/admin', 'admin');
});
Route::get('logout', [LoginController::class,'logout']);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
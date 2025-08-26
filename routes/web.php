<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
Route::get('/', [UserController::class, 'index']); //entry point
Auth::routes();


Route::middleware('can:isAdmin')->group(function() {
  Route::get('/admin/books/index', [BookController::class, 'index']);
  Route::get('/admin/books/create', [BookController::class, 'create']);
  Route::get('/admin/books/{id}', [BookController::class, 'show']);
  Route::post('/admin/books/create', [BookController::class, 'store']);
  Route::get('/admin/books/delete/{id}', [BookController::class, 'destroy']);
  Route::get('/admin/books/update/{id}', [BookController::class, 'updateBookView']);
  Route::post('/admin/books/updateBook', [BookController::class, 'updateBook']);

});



//Route::get('/index', [UserController::class, 'index']);

  Route::get('/search', [UserController::class, 'searchProduct']);
  Route::get('/categorySearch', [UserController::class, 'searchByCategory']);
  

Auth::routes();


Route::middleware('auth', 'can:isUser')->group(function () {
  Route::get('/cart', [CartController::class, 'show']);
  Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
  Route::post('/checkout', [OrderController::class, 'showCheckoutPage']);
  
});

Route::get('/books/{id}', [UserController::class, 'viewProduct']);

Route::get('logout', [LoginController::class,'logout']);
/* Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/register/admin', [RegisterController::class,'createAdmin']); */

/* Route::group(['middleware' => 'auth:admin'], function () {
 
 Route::view('/admin', 'admin');
}); */


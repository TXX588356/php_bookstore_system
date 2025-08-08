<?php

use App\Http\Controllers\BookController;
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

Route::get('/books/index', [BookController::class, 'index']);
//Route::get('/books', [BookController::class, 'books']);
Route::get('/books/create', [BookController::class, 'create']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::post('/books/create', [BookController::class, 'store']);
Route::get('/delete/{id}', [BookController::class, 'destroy']);
Route::get('/update/{id}', [BookController::class, 'updateBookView']);
Route::post('/books/updateBook', [BookController::class, 'updateBook']);



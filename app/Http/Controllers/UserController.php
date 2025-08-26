<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect('/admin/books/index');  //admin cannot access this page, and will be redirected
        }
        $books = Book::orderBy('created_at', 'desc')->paginate(5);

        return view('user.index', ['books' => $books]);
    }

    /*
    public function getCart($user)
    {
        return view('user.cart', ['user' => $user]);
    }
    */
    
    public function viewProduct($id) {
        if(auth()->check() && auth()->user()->role === 'admin') {
            return redirect('/admin/books/index'); //admin cannot access this page,  and will be redirected
        }
        $book = Book::findOrFail($id);
        return view('user.show', ["book" => $book]);
    }
}

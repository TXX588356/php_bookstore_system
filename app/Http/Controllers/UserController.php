<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect('/admin/books/index');  //admin cannot access this page, and will be redirected
        }
        $books = Book::orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        return view('user.index', compact('books', 'categories'));
    }
    
    public function viewProduct($id)
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect('/admin/books/index'); //admin cannot access this page,  and will be redirected
        }
        $book = Book::findOrFail($id);
        return view('user.show', ["book" => $book]);
    }
    
    public function searchProduct(Request $request)
    {
        $keyword = $request->input('search');

        $books = Book::where('title', 'like', '%' . $keyword . '%')
            ->orWhere('desc', 'like', '%' . $keyword . '%')
            ->paginate(5);

        $categories = Category::all();

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('books.index', compact('books', 'categories')); //show different view for admin role
        }
        return view('user.index', compact('books', 'categories'));
    }

    public function searchByCategory(Request $request) {
        $keyword = $request->input('categorySearch');

        $books = Book::whereHas('categories', function($query) use ($keyword) {
            $query->where('name', '=', $keyword);
        })->paginate(5);

        $categories = Category::all();

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('books.index', compact('books', 'categories')); //show different view for admin role
        }
        return view('user.index', compact('books', 'categories'));
    }
}

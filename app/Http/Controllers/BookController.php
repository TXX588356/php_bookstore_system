<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
      $books = Book::orderBy('created_at', 'desc')->paginate(5);

      return view('books.index', ["books" => $books]);
    }

    public function show($id) {
      $book = Book::findOrFail($id);
      return view('books.show', ["book" => $book]);
    }

    public function create() {
      $categories = Category::all();
      return view('books.create', ['categories' => $categories]);
    }

    public function store(Request $request) {
      /* $validated = $request->validate([
        'title' => 'required|string|255',
        'author' => 'required|string|255',
        'desc' => 'required|string|max:1000',
        'price' => 'required|integer|min:1',
        'stock' => 'required|integer|min:1',
        'page_count' => 'required|integer|min:1',
        'publisher' => 'required|string|255',
        'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'categories' => 'required|array|min:1',
        'categories.*' => 'exists:categories,id',
      ]);

      $book = Book::create([
        'title' => $validated['title'],
        'author' => $validated['author'],
        'desc' => $validated['desc'],
        'price' => $validated['price'],
        'stock' => $validated['stock'],
        'page_count' => $validated['page_count'],
        'publisher' => $validated['publisher'],
        'cover_image' => $validated['cover_image'],
      ]);

      $book->categories()->sync($validated['categories']); */
      $book = new Book();
      $book->title = $request->title;
      $book->author = $request->author;
      $book->desc = $request->desc;
      $book->price = $request->price;
      $book->stock = $request->stock;
      $book->page_count = $request->page_count;
      $book->publisher = $request->publisher;
      $book->cover_image = $request->cover_image;
      $book->save();
      $book->categories()->sync($request->input('categories', []));      
      return redirect('/books/index')->with('success', 'Book Created!');
    }

    public function destroy($id) {
      $book = Book::findOrFail($id);
      $book->delete();

      return redirect('/books/index')->with('success', 'Book Deleted!');;
    }

    public function updateBookView($id) {
      $book = Book::find($id);
      $categories = Category::all();

      return view('/books/updateBook', ['book' => $book], ['categories' => $categories]);
    }

    
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
      $this->authorize('viewAny', Book::class); // all users can view books
      $books = Book::orderBy('created_at', 'desc')->paginate(5);
      $categories = Category::all();

      return view('books.index', compact('books', 'categories'));
    }

    public function show($id) {
      $book = Book::findOrFail($id);
      $this->authorize('view', $book); // all users can view a specific book
      return view('books.show', ["book" => $book]);
    }

    public function create() {
      $this->authorize('create', Book::class); // only admin can create books
      $categories = Category::all();
      return view('books.create', ['categories' => $categories]);
    }

    public function store(Request $request) {
      
      $data = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'desc' => 'required',
        'price' => 'required',
        'stock' => 'required|integer|min:1',
        'page_count' => 'required|integer|min:1',
        'publisher' => 'required',
        'cover_image' => 'required',
        'categories' => 'required|array|min:1',
        'categories.*' => 'exists:categories,id',
      ]);

      $this->authorize('create', Book::class); // only admin can create books
      $book = Book::create($data);

      //to bind with the pivot table
      $book->categories()->sync($request->input('categories', []));
      return redirect('/admin/books/index')->with('success', 'Book Created!');
    }

    public function destroy($id) {
      $book = Book::findOrFail($id);
      $this->authorize('delete', $book); // only admin can delete books
      $book->delete();

      return redirect('/admin/books/index')->with('success', 'Book Deleted!');
    }

    public function updateBookView($id) {
      $book = Book::find($id);
      $this->authorize('update', $book); // only admin can update books
      $categories = Category::all();

      return view('books.updateBook', ['book' => $book], ['categories' => $categories]);
    }

    public function updateBook(Request $request) {
      
      $book = Book::findOrFail($request->id);
      $this->authorize('update', $book); // only admin can update books

      $data = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'desc' => 'required',
        'price' => 'required',
        'stock' => 'required|integer|min:1',
        'page_count' => 'required|integer|min:1',
        'publisher' => 'required',
        'cover_image' => 'required',
        'categories' => 'required|array|min:1',
        'categories.*' => 'exists:categories,id',
      ]);

      $book->update($data);

      $book->categories()->sync($data['categories']);
      return redirect('/admin/books/index')->with('success', 'Book Edited!');
    }
  
}

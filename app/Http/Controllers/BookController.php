<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
      $books = Book::orderBy('created_at', 'desc')->paginate(5);
      $categories = Category::all();

      return view('books.index', compact('books', 'categories'));
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
     
/*       $book = new Book();
      $book->title = $request->title;
      $book->author = $request->author;
      $book->desc = $request->desc;
      $book->price = $request->price;
      $book->stock = $request->stock;
      $book->page_count = $request->page_count;
      $book->publisher = $request->publisher;
      $book->cover_image = $request->cover_image;
      $book->save();
      $book->categories()->sync($request->input('categories', []));   */
      
      
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

      
      $book = Book::create($data);

      //to bind with the pivot table
      $book->categories()->sync($request->input('categories', []));
      return redirect('/admin/books/index')->with('success', 'Book Created!');
    }

    public function destroy($id) {
      $book = Book::findOrFail($id);
      $book->delete();

      return redirect('/admin/books/index')->with('success', 'Book Deleted!');;
    }

    public function updateBookView($id) {
      $book = Book::find($id);
      $categories = Category::all();

      return view('books.updateBook', ['book' => $book], ['categories' => $categories]);
    }

    public function updateBook(Request $request) {

      
      $book = Book::findOrFail($request->id);


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

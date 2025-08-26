<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function show() {
        $userId = Auth::id();
        $cartItems = Cart::with('book')->where('user_id', $userId)->orderBy('created_at')->get();
        return view('user.cart', ['cartItems' => $cartItems]);
    /*
        $booksInCart = Cart::where('user_id', $userId)->orderBy('created_at')->get();
        $books = [];
        foreach ($booksInCart as $bookInCart) {
            $book = Book::where('id', $bookInCart->book_id)->first();
            $books[] = $book;
        }
        return view('user.cart', ['books' => $books]);
    */
    }

    public function add(Request $request) {
        $bookId = $request->input('book_id');
        $quantity = $request->input('quantity');
        $userId = Auth::id();
        $book = Book::findOrFail($bookId);
        $book_current_stock = $book->stock;

        $bookInCart = Cart::where('user_id', $userId)->where('book_id', $bookId)->first();
        if($bookInCart) {
            // Book already in cart, update quantity
            if($bookInCart->quantity + $quantity > $book_current_stock) {
                $existngQty = $bookInCart->quantity;
                return redirect()->back()->with('fail', 
                'You are adding more than available stock. The existing quantity in your cart is '.$existngQty.'.
                You can only add '.($book_current_stock - $existngQty).' more.');
            } else {
                $bookInCart->quantity += $quantity;
                $bookInCart->save();
            }
        } else {
            // Book not in cart, create new entry
            if($quantity > $book_current_stock) {
                return redirect()->back()->with('fail', "You are adding more than available stock");
            } else {
                Cart::create(['user_id' => $userId, 'book_id' => $bookId, 'quantity' => $quantity]);
            }
        }

        return redirect()->back()->with('success', 'Book added to cart!');
        
        /*
        //$cart = $request->session()->get('cart', []);

        if(isset($cart[$bookId])) {
            if($cart[$bookId]['quantity'] + $quantity > $book_current_stock) {
                return redirect()->back()->with('Fail', "You are adding more than available stock");
            } else {
                $cart[$bookId]['quantity'] += $quantity;
            }
        } else {
            $cart[$bookId] = [
                "book_id" => $bookId,
                "quantity" => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Book added to cart!');
        */
    }
}

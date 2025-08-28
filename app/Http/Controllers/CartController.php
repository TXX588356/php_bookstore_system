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

        foreach ($cartItems as $item) {
            $this->authorize('view', $item);  // ensure user can only view their own cart items
        }

        // Validate selected items against stock and calculate current total
        $selectedItems = session()->get('selected_cart_items', []);
        $currentTotal = 0;
        foreach ($cartItems as $item) {
            if (in_array($item->book_id, $selectedItems)) {
                if ($item->book->stock == 0 || $item->quantity > $item->book->stock) {
                    // If the book is out of stock or quantity exceeds stock, remove it from selected items
                    $selectedItems = array_diff($selectedItems, [$item->book_id]);
                    session()->put('selected_cart_items', $selectedItems);
                } else {
                    // Calculate the current total of the selected items
                    $currentTotal += $item->book->price * $item->quantity;
                }
            }
        }

        return view('user.cart', ['cartItems' => $cartItems, 'currentTotal' => $currentTotal]);
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
                $this->authorize('update', $bookInCart);  // ensure user can only update their own cart items
                $bookInCart->quantity += $quantity;
                $bookInCart->save();
            }
        } else {
            // Book not in cart, create new entry
            if($quantity > $book_current_stock) {
                return redirect()->back()->with('fail', "You are adding more than available stock");
            } else {
                $this->authorize('create', Cart::class);  // only normal user can add items to cart
                Cart::create(['user_id' => $userId, 'book_id' => $bookId, 'quantity' => $quantity]);
            }
        }

        return redirect()->back()->with('success', 'Book added to cart!');
    }

    public function updateQuantity(Request $request) {
        $bookId = $request->input('book_id');
        $newQuantity = $request->input('quantity');
        $userId = Auth::id();
        $book = Book::findOrFail($bookId);
        $book_current_stock = $book->stock;

        $bookInCart = Cart::where('user_id', $userId)->where('book_id', $bookId)->first();
        $existngQty = $bookInCart->quantity;
        if($bookInCart) {
            if($newQuantity > $book_current_stock) {
                return redirect('/cart')->with('fail', "You are adding more than available stock. (Available stock: $book_current_stock)");
            } else {
                $this->authorize('update', $bookInCart);  // ensure user can only update their own cart items
                $bookInCart->quantity = $newQuantity;
                $bookInCart->save();
                return redirect('/cart')->with('success', 'Cart quantity updated successfully!');
            }
        } else {
            return redirect('/cart')->with('fail', 'Book not found in cart!');
        }
    }

    public function toggleCartItem(Request $request) {
        $book_id = $request->book_id;
        $book = Book::findOrFail($book_id);
        $cartItems = session()->get('selected_cart_items', []);

        if($request->has('cart_items')) {
            // Add item to selected cart items
            if (!in_array($book_id, $cartItems)) {
                $cartItems[] = $book_id;
            }
        } else {
            // Remove item from selected cart items
            $cartItems = array_diff($cartItems, [$book_id]);
        }
    
        session()->put('selected_cart_items', $cartItems);
        return redirect('/cart');
    }

    public function remove(Request $request) {
        $user_id = Auth::id();
        $book_id = $request->book_id;
        $book = Book::findOrFail($book_id);
        
        $bookInCart = Cart::where('user_id', $user_id)->where('book_id', $book_id)->first();
        if($bookInCart) {
            $this->authorize('delete', $bookInCart);  // ensure user can only delete their own cart items
            $bookInCart->delete();
            // If the item to be removed is in the selected cart items, remove it from the session as well
            $cartItems = session()->get('selected_cart_items', []);
            if(in_array($book_id, $cartItems)) {
                $cartItems = array_diff($cartItems, [$book_id]);
                session()->put('selected_cart_items', $cartItems);
            }
            return redirect('/cart')->with('success', 'Book removed from cart!');
        } else {
            return redirect('/cart')->with('fail', 'Book not found in cart!');
        }
    }
}

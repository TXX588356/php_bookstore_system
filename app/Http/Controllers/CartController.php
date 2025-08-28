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
                return redirect()->back()->with('fail', "You are adding more than available stock. (Available stock: $book_current_stock)");
            } else {
                $bookInCart->quantity = $newQuantity;
                $bookInCart->save();
                // update total amount if the item is currently selected for checkout
                if(in_array($bookId, session()->get('selected_cart_items', []))) {
                    $currentTotalAmount = session()->get('current_total_amount', 0);
                    $previousAmount = $book->price * $existngQty;
                    $newAmount = $book->price * $newQuantity;
                    $currentTotalAmount = $currentTotalAmount - $previousAmount + $newAmount;
                    session()->put('current_total_amount', $currentTotalAmount);
                }
                return redirect()->back()->with('success', 'Cart quantity updated successfully!');
            }
        } else {
            return redirect()->back()->with('fail', 'Book not found in cart!');
        }
    }

    public function toggleCartItem(Request $request) {
        $book_id = $request->book_id;
        $book = Book::findOrFail($book_id);
        $currentTotalAmount = session()->get('current_total_amount', 0);
        $cartItems = session()->get('selected_cart_items', []);

        if($request->has('cart_items')) {
            // Add item to selected cart items
            if (!in_array($book_id, $cartItems)) {
                $cartItems[] = $book_id;
                $currentTotalAmount += $request->item_amount;
            }
        } else {
            // Remove item from selected cart items
            $cartItems = array_diff($cartItems, [$book_id]);
            $currentTotalAmount -= $request->item_amount;
        }
    
        session()->put('selected_cart_items', $cartItems);
        session()->put('current_total_amount', $currentTotalAmount);
        return redirect()->back();
    }

    public function remove(Request $request) {
        $user_id = Auth::id();
        $book_id = $request->book_id;
        $book = Book::findOrFail($book_id);
        
        $bookInCart = Cart::where('user_id', $user_id)->where('book_id', $book_id)->first();
        if($bookInCart) {
            $bookInCart->delete();
            // If the item to be removed is in the selected cart items, remove it from the session as well
            $cartItems = session()->get('selected_cart_items', []);
            if(in_array($book_id, $cartItems)) {
                $cartItems = array_diff($cartItems, [$book_id]);
                session()->put('selected_cart_items', $cartItems);
            }
            $currentTotalAmount = session()->get('current_total_amount', 0);
            $currentTotalAmount -= $book->price * $bookInCart->quantity;
            session()->put('current_total_amount', $currentTotalAmount);
            return redirect()->back()->with('success', 'Book removed from cart!');
        } else {
            return redirect()->back()->with('fail', 'Book not found in cart!');
        }
    }
}

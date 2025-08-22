<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addCart(Request $request) {
        $bookId = $request->input('book_id');
        $quantity = $request->input('quantity');

        $cart = $request->session()->get('cart', []);
        $book = Book::findOrFail($bookId);
        $book_current_stock = $book->stock;

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
    }
}

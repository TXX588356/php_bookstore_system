<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showCheckoutPage() {
        if (!session()->has('selected_cart_items') || count(session('selected_cart_items')) === 0) {
            return redirect()->back()->with('fail', 'No items selected for checkout. Please select items to proceed.');
        }
        $selectedItemsInCart = Cart::with('book')->whereIn('book_id', session('selected_cart_items'))->get();
        return view('user.checkout', ['selectedItems' => $selectedItemsInCart]);
    }

    public function processCheckout(Request $request) {
         $validated = $request->validate([
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|digits:16',
            'expiry_date' => 'required|date|after:today',
            'cvv' => 'required|digits_between:3,4'
         ]);

        $userId = Auth::id();
        $order = Order::create(['user_id' => $userId, 'total_amount' => session()->get('current_total_amount')]);

        $orderId = $order->id;
        $selectedBooks = session('selected_cart_items', []);

        foreach ($selectedBooks as $bookId) {
            $book = Book::find($bookId);
            $unitPrice = $book->price;
            $quantity = Cart::where('book_id', $bookId)->where('user_id', $userId)->value('quantity');
            
            DB::table('order_books')->insert(['order_id' => $orderId, 'book_id' => $bookId, 
                'quantity' => $quantity, 'unit_price' => $unitPrice]);
            $book->stock -= $quantity;
            $book->save();
        }       

        Cart::where('user_id', $userId)->whereIn('book_id', session('selected_cart_items'))->delete();
        session()->forget('selected_cart_items');
        session()->put('current_total_amount', 0);

        return redirect('/orderHistory')->with('success', 'Checkout successful!');
    }

    public function showOrderHistory() {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)->with(['orderBooks.book'])->orderBy('purchase_at', 'desc')->paginate(5);
        return view('user.order', ['orders' => $orders]);
    }
}


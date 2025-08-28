<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showCheckoutPage(Request $request) {
        $this->authorize('checkout', Order::class);  // only normal user can checkout

        // Ensure there are selected items in the cart before proceeding to checkout
        if (!session()->has('selected_cart_items') || count(session('selected_cart_items')) === 0 || $request->input('total_amount') == 0) {
            return redirect()->back()->with('fail', 'No items selected for checkout. Please select items to proceed.');
        }

        session()->put('total_amount', $request->input('total_amount')); // store total amount in session to lock the final amount
        $selectedItemsInCart = Cart::with('book')->whereIn('book_id', session('selected_cart_items'))->get();
        return view('user.checkout', ['selectedItems' => $selectedItemsInCart]);
    }

    public function processCheckout(Request $request) {
        $this->authorize('checkout', Order::class);  // only normal user can checkout

        $validated = $request->validate([ // validate the format of card details for payment
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|digits:16',
            'expiry_date' => 'required|date|after:today',
            'cvv' => 'required|digits_between:3,4'
        ]);

        $userId = Auth::id();
        $order = Order::create(['user_id' => $userId, 'total_amount' => session()->get('total_amount')]);

        $orderId = $order->id;
        $selectedBooks = session('selected_cart_items', []);

        foreach ($selectedBooks as $bookId) {
            $book = Book::find($bookId);
            $unitPrice = $book->price;
            $quantity = Cart::where('book_id', $bookId)->where('user_id', $userId)->value('quantity');
            
            OrderBook::create(['order_id' => $orderId, 'book_id' => $bookId, 'quantity' => $quantity, 'unit_price' => $unitPrice]);
            $book->stock -= $quantity; // Deduct the purchased quantity from stock
            $book->save();
        }       

        // Clear purchased items from cart and session
        Cart::where('user_id', $userId)->whereIn('book_id', session('selected_cart_items'))->delete();
        session()->forget('selected_cart_items');
        session()->forget('total_amount');

        return redirect('/orderHistory')->with('success', 'Checkout successful!');
    }

    public function showOrderHistory() {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)->with(['orderBooks.book'])->orderBy('purchase_at', 'desc')->paginate(5);
        
        foreach ($orders as $order) {
            $this->authorize('view', $order);  // ensure user can only view their own orders
        }
        
        return view('user.order', ['orders' => $orders]);
    }

    public function showSalesHistory() {
        $this->authorize('viewAny', Order::class);  // only admin can view all orders

        $orders = Order::with(['orderBooks.book', 'user'])->orderBy('purchase_at', 'desc')->paginate(5);
        return view('admin.sales', ['orders' => $orders]);
    }
}


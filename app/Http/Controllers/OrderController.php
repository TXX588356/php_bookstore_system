<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showCheckoutPage() {
        if (!session()->has('selected_cart_items') || count(session('selected_cart_items')) === 0) {
            return redirect()->back()->with('fail', 'No items selected for checkout. Please select items to proceed.');
        }
        return view('user.checkout');
    }
}

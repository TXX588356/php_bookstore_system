<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showCheckoutPage() {
        return view('user.checkout');
    }
}

<x-userHeader>
    <style>
        .checkout-container {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background: #fff;
            padding: 16px 0;
            text-align: center;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.05);
            z-index: 100;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 50px;
        }

        .checkout-btn {
            background-color: #a463b1;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .action-btn {
            padding: 10px;
            border-radius: 10px;
            margin: 10px;
            height: 45px;
        }

        .update-qty {
            padding: 10px;
            background-color: #a463b1;
            justify-content: center;
            border-radius: 10px;
            color: white;
        }

        .cart-checkbox {
            width: 20px;
            height: 20px;
            margin-right: 15px;
            cursor: pointer;
        }
    </style>

    <h2>Shopping Cart</h2>

    @if(is_null($cartItems) || count($cartItems) === 0)
        <p>Your cart is empty.</p>
    @else
        <ul style="margin-bottom: 60px;">
            @foreach ($cartItems as $cartItem) 
                @php
                    $itemAmount = $cartItem->book->price * $cartItem->quantity;
                @endphp
            <li style="margin-bottom: 30px;">
                <form action="{{ route('cart.toggle') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $cartItem->book->id }}">
                    @if($cartItem->book->stock == 0)
                        <div style="display: flex; align-items: center;">
                            <div style="background-color: grey; width: 19px; height: 19px; border: 1px solid blue;"></div>
                            <div style="color: red; margin-left: 8px; font-weight: bold;">Out of Stock</div>
                        </div>
                    @elseif($cartItem->quantity > $cartItem->book->stock)
                        <div style="display: flex; align-items: center;">
                            <div style="background-color: grey; width: 19px; height: 19px; border: 1px solid blue;"></div>
                            <div style="color: red; margin-left: 8px; font-weight: bold;">
                                The available quantity left in stock is only {{ $cartItem->book->stock }}. Please update your quantity.</div>
                        </div>
                    @elseif($cartItem->book->stock > 0)
                        <input type="checkbox" name="cart_items" value="{{ $cartItem->book->id }}" 
                            class="cart-checkbox" onchange="this.form.submit()"
                            {{ in_array($cartItem->book->id, session('selected_cart_items', [])) ? 'checked' : '' }}>
                    @endif
                </form>
                <x-card>
                <h3 style="font-weight:bold">{{ $cartItem->book->title }}</h3>
                <img src="{{$cartItem->book->cover_image}}" alt="book cover" width="150" height="220"><br>
                <p><strong>Quantity: {{ $cartItem->quantity }}</strong></p>
                <p><strong>Price per unit: RM{{ number_format($cartItem->book->price, 2) }}</strong></p>
                <p><strong>Amount: RM{{ number_format($itemAmount, 2) }}</strong></p>

                <div class="buttons-grp" style="align-items: center; gap: 15px;">
                    <div class="action-btn" style="background-color: lightyellow;">
                        <a href="/books/{{ $cartItem->book->id }}" >View Details</a>
                    </div>
                    
                    <div class="action-btn" style="background-color: red; color: white;">
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $cartItem->book->id }}">
                            <button type="submit">Remove from Cart</button>
                        </form>
                    </div>

                    <div class="action-btn" style="display: flex; align-items: center;">
                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $cartItem->book->id }}">
                            <div>
                                <button type="button" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600" 
                                    onclick="handleMinus( {{ $cartItem->book->id }} )">-</button>
                                <input id="quantity-{{ $cartItem->book->id }}" class="w-8 text-center" name="quantity"
                                    value="{{ $cartItem->quantity }}" readonly>
                                <button type="button" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600"
                                    onclick="handlePlus( {{ $cartItem->book->id }} )">+</button>
                            </div>
                            <div class="update-qty">
                                <button type="submit" class="flex items-center space-x-2">
                                    <span>Update Quantity</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                </x-card>
            </li>
            @endforeach
        </ul>
    
        <form action="/checkout" method="GET">
            @csrf
            <input type="hidden" name="total_amount" value="{{ $currentTotal }}">
            <div class="checkout-container">
                <strong>Total Amount: RM
                    <span id="totalAmount">{{ number_format($currentTotal, 2) }}</span>
                </strong>
                <input type="submit" name="action" value="Checkout" class="checkout-btn">
            </div>
        </form>
    @endif
    
    <script>
        function handlePlus(bookId) {
            const quantitySpan = document.getElementById(`quantity-${bookId}`);
            let quantity = parseInt(quantitySpan.value);
            quantity++;
            quantitySpan.value = quantity;
        }

        function handleMinus(bookId) {
            const quantitySpan = document.getElementById(`quantity-${bookId}`);
            let quantity = parseInt(quantitySpan.value);
            if (quantity > 1) {
                quantity--;
                quantitySpan.value = quantity;
            }
        }
    </script>

</x-userHeader>
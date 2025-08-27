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

        .cart-checkbox {
            width: 20px;
            height: 20px;
            margin-right: 15px;
            cursor: pointer;
        }
    </style>

    <h2>Shopping Cart</h2>
    @php
        $totalAmount = 0;
    @endphp

    <form action="/checkout" method="POST">
    @csrf
    <ul>
        @foreach ($cartItems as $cartItem) 
        @php
            $itemAmount = $cartItem->book->price * $cartItem->quantity;
        @endphp
        <li style="margin-bottom: 30px;">
            <input type="checkbox" name="cartItems[]" value="{{ $cartItem->book->id }}" 
                class="cart-checkbox" data-amount="{{ $itemAmount }}">
            <x-card>
            <h3 style="font-weight:bold">{{ $cartItem->book->title }}</h3>
            <img src="{{$cartItem->book->cover_image}}" alt="book cover" width="150" height="220"><br>
            
            <p><strong>Quantity: {{ $cartItem->quantity }}</strong></p>
            <p><strong>Price per unit: RM{{ number_format($cartItem->book->price, 2) }}</strong></p>
            <p><strong>Amount: RM{{ number_format($itemAmount, 2) }}</strong></p>

            <div class="buttons-grp">
                <div class="details-btn">
                    <a href="/books/{{ $cartItem->book->id }}" >View Details</a>
                    <a href="{{ route('cart.remove', ['book_id' => $cartItem->book->id]) }}"
                    style="background-color: red; color: white;" >Remove from Cart</a>
                </div>
            </div>
            </x-card>
        </li>
        @endforeach
    </ul>
    <div class="checkout-container">
        <span><strong>Total Amount: RM<span id="totalAmount">{{ number_format($totalAmount, 2) }}</span></strong></span>
        <input type="submit" name="action" value="Checkout" class="checkout-btn">
    </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.cart-checkbox');
            const totalAmountSpan = document.getElementById('totalAmount');
            const form = document.querySelector('form');

            function updateTotal() {
                let total = 0;
                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        total += parseFloat(cb.dataset.amount);
                    }
                });
                totalAmountSpan.textContent = total.toFixed(2);
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', updateTotal);
            });

            form.addEventListener('submit', function(e) {
                const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
                if (!anyChecked) {
                    e.preventDefault();
                    alert("Select at least an item before proceed to checkout");
                }
            });
        });
    </script>
    
</x-userHeader>
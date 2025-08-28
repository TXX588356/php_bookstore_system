@php
    $totalAmount = number_format(session('total_amount', 0), 2);
@endphp

<x-userHeader>
    <style>
        .checkout-btn {
            background-color: #22c55e;
            color: #fff;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            border: none;
            cursor: pointer;
        }
        .checkout-btn:hover {
            background-color: #15803d;
        }
        .back-btn {
            background-color: #6b7280;
            color: #fff;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            text-decoration: none;
            margin-left: 10px;
            display: inline-block;
        }
        .back-btn:hover {
            background-color: #374151;
        }
    </style>
    @if ($errors->any())
        <span style="color:red; font-weight: bold; font-size: 1.2em;">Checkout failed. Please check your card details.</span>
        <br><br>
    @endif
    <h2>Order Summary</h2>
    <ul>
        @foreach ($selectedItems as $item)
            <li>
                <x-card>
                    <h3 style="font-weight:bold">{{ $item->book->title }}</h3>
                    <img src="{{ $item->book->cover_image }}" alt="book cover" width="150" height="220"><br>
                    <p><strong>Quantity: {{ $item->quantity }}</strong></p>
                    <p><strong>Price per unit: RM{{ number_format($item->book->price, 2) }}</strong></p>
                    <p><strong>Amount: RM{{ number_format($item->book->price * $item->quantity, 2) }}</strong></p>  
                </x-card>
            </li>
        @endforeach
    </ul>
    <h2>Total Amount: RM{{ $totalAmount }}</h2>
    <form action="{{ route('checkout.process') }}" method="POST" style="margin: 40px 0px;">
        @csrf
        <h3>Card Details</h3>

        <label for="card_name">Name on Card:</label>
        <input type="text" name="card_name" value="{{ old('card_name') }}" placeholder="Name on Card" required>
        @error('card_name')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <br><br>

        <label for="card_number">Card Number:</label>
        <input type="text" name="card_number" value="{{ old('card_number') }}" placeholder="Card Number" required>
        @error('card_number')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <br><br>

        <label for="expiry_date">Expiry Date:</label>
        <input type="month" name="expiry_date" value="{{ old('expiry_date') }}" required>
        @error('expiry_date')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <br><br>

        <label for="cvv">CVV:</label>
        <input type="text" name="cvv" value="{{ old('cvv') }}" placeholder="CVV" required>
        @error('cvv')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <br><br>

        <button type="submit" class="checkout-btn">Proceed to Checkout</button>
        <a href="/cart" class="back-btn">Back to Cart</a>
    </form>
</x-userHeader>
  

<x-userHeader>
    <h2>Order History</h2>
    @if(is_null($orders) || count($orders) === 0)
        <p>Your order history is empty.</p>
    @else
        <ul>
        @foreach ($orders as $order) 
            <li style="margin-bottom: 30px;">
                <x-card>
                    <h3 style="font-weight:bold">Order ID: {{ $order->id }}</h3>
                    <h4 style="font-weight:bold">Purchase Date: {{ date('d M Y, H:i', strtotime($order->purchase_at)) }}</h4>
                    <hr><br>
                    @foreach ($order->orderBooks as $orderBook)
                        @if ($orderBook->book === null)
                            <h5 style="color:red;">This book in no longer available in the store.</h5>
                            <img alt="not available" width="120" height="180"><br>
                            <p>Quantity: {{ $orderBook->quantity }}</p>
                            <p>Price per unit: RM{{ number_format($orderBook->unit_price, 2) }}</p>
                            <p>Amount: RM{{ number_format($orderBook->unit_price * $orderBook->quantity, 2) }}</p>
                        @else
                            <h5>Title: {{ $orderBook->book->title }}</h5>
                            <img src="{{ $orderBook->book->cover_image }}" alt="book cover" width="120" height="180"><br>
                            <p>Quantity: {{ $orderBook->quantity }}</p>
                            <p>Price per unit: RM{{ number_format($orderBook->unit_price, 2) }}</p>
                            <p>Amount: RM{{ number_format($orderBook->unit_price * $orderBook->quantity, 2) }}</p>
                        @endif
                        <hr><br>
                    @endforeach
                    <strong style="font-size: 1.2em;">Total Amount: RM{{ number_format($order->total_amount, 2) }}</strong>
                </x-card>
            </li>
        @endforeach
        </ul>
    @endif  
    {{ $orders->links() }}
</x-userHeader>
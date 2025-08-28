<x-header>
    <h2>Sales History</h2>
    <p style="font-size: 1.3em;">Below is the list of all completed orders:</p>

    @if(is_null($orders) || count($orders) === 0)
        <p>Sales history is empty.</p>
    @else
        <ul>
        @foreach ($orders as $order) 
            <li style="margin-bottom: 30px; border: 1px solid grey; border-radius: 8px;">
                <x-card>
                    <h3 style="font-weight: bold; margin-bottom: 12px;">Order ID: {{ $order->id }}</h3>
                    <h4 style="font-weight: bold;">User Information:</h4>
                    @if (is_null($order->user))
                        <p style="color: red; font-size: 1.2em;">This user account may have been deleted or no longer available.</p>
                    @else
                        <p style="font-size: 1.2em;">Name: {{ $order->user->name }}</p>
                        <p style="font-size: 1.2em;">Email: {{ $order->user->email }}</p>
                    @endif
                    <h4 style="font-weight:bold">Purchase Date: {{ date('d M Y, H:i', strtotime($order->purchase_at)) }}</h4>
                    <hr><br>
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align: left; padding-right: 15px;">Book Title</th>
                                <th style="text-align: left; padding-right: 15px;">Author</th>
                                <th style="text-align: left; padding-right: 15px;">Price per Unit</th>
                                <th style="text-align: left; padding-right: 15px;">Quantity</th>
                                <th style="text-align: left; padding-right: 15px;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderBooks as $orderBook)
                                @if ($orderBook->book === null)
                                    <tr>
                                        <td style="color:red; padding-top: 10px;">
                                            This book is no longer available in the store.
                                            <img alt="not available" width="70" height="90" style="vertical-align: middle; margin-right: 10px;">
                                        </td>
                                        <td style="color:red; padding-top: 10px;">N/A</td>
                                @else
                                    <tr>
                                        <td style="padding-top: 10px;">
                                            {{ $orderBook->book->title }}
                                            <img src="{{ $orderBook->book->cover_image }}" alt="book cover" width="70" height="90" style="vertical-align: middle; margin-right: 10px;">
                                        </td>
                                        <td style="padding-top: 10px;">{{ $orderBook->book->author }}</td>
                                    
                                @endif
                                        <td style="padding-top: 10px;">RM{{ number_format($orderBook->unit_price, 2) }}</td>
                                        <td style="padding-top: 10px;">{{ $orderBook->quantity }}</td>
                                        <td style="padding-top: 10px;">RM{{ number_format($orderBook->unit_price * $orderBook->quantity, 2) }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br><hr><br>
                    <strong style="font-size: 1.3em;">Total Amount: RM{{ number_format($order->total_amount, 2) }}</strong>
                </x-card>
            </li>
        @endforeach
        </ul>
    @endif
    {{ $orders->links() }}
</x-header>
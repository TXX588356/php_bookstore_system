
<x-userHeader>
    <style>
        .book-details-container {
            display: flex;
        }

        img {
            margin-right: 20px;
        }

        .inner-amount-container {
            display: flex;
        }

        .add-to-cart {
            padding: 10px;
            margin-left: 30px;
            background-color: #a463b1;
            justify-content: center;
            border-radius: 5px;
        }
    </style>
    <h1>Book Details</h1>
    <h2>{{ $book->title }}</h2>



    <div class="book-details-container">
        <img src="{{ $book->cover_image }}" alt="book cover" width="400" height="500"><br>
        <div class="inner-container">
            <p><strong>Author: </strong>{{ $book->author }}</p>
            <p><strong>Description: </strong>{{ $book->desc }}</p>
            <p><strong>Page Count: </strong>{{ $book->page_count }}</p>
            <p><strong>Publisher: </strong>{{ $book->publisher }}</p>
            <p><strong>Catogories:</strong>
                @foreach ($book->categories as $category)
                    {{ $category->name }}@if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </p>
            <p><strong>Price: </strong>RM{{ $book->price }}</p>
            <p><strong>Stock: </strong>{{ $book->stock }}</p>

            <div class="inner-amount-container">
                <div class="flex items-center space-x-2" data-stock={{ $book->stock }}>
                    <button id="minus" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">−</button>

                    <span id="quantity" class="w-8 text-center">1</span>

                    <button id="plus"
                        class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">+</button>
                </div>

                <div class="add-to-cart">
                    <form action="{{ route('cart.add') }}" method="POST" class="flex items-center space-x-2">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <input type="hidden" name="quantity" id="quantityInput" value="1">
                        @if ($book->stock == 0)
                            <button type="button" disabled class="flex items-center space-x-2">
                                <span style="color: #ff4c4c; font-weight: bold;">Out of Stock</span>
                            </button>
                        @else
                            <button type="submit" class="flex items-center space-x-2">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span>Add to Cart</span>
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>


    </div>



</x-userHeader>

<script>
    const minusBtn = document.getElementById('minus');
    const plusBtn = document.getElementById('plus');
    const quantitySpan = document.getElementById('quantity');
    const quantityInput = document.getElementById('quantityInput');

    const stock = document.querySelector('.flex').dataset.stock;
    let quantity = 1;

    plusBtn.addEventListener('click', () => {
        if (quantity < stock) {
            quantity++;
            quantitySpan.textContent = quantity;
            quantityInput.value = quantity;
        }
        if (quantity > 1) {
            minusBtn.disabled = false;
        }

        if (quantity >= stock) {
            plusBtn.disabled = true;
        }
    })

    minusBtn.addEventListener('click', () => {
        if (quantity > 1) {
            quantity--;
            quantitySpan.textContent = quantity;
            quantityInput.value = quantity;
        }

        if (quantity < stock) {
            plusBtn.disabled = false;
        }
        if (quantity <= 1) {
            minusBtn.disabled = true;
        }
    })
</script>

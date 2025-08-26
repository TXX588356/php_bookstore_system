<x-userHeader>
    <h2>Home Page</h2>
     <form action="/search" method="GET">
            <input type="text" name="search" required placeholder="Find books by title or description" size="80"/>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Search</button>
        </form>
    <br>
    <p>Search by Category</p>
    <ul>
      @foreach($categories as $category)
        <li style="display:inline-block">
          <a class="category-link" href="/categorySearch?categorySearch={{ $category->name }}">| {{ $category->name }}</a>
        </li>
      @endforeach
    </ul>
    
    <ul>
        @foreach ($books as $book)
            <li>
                <x-card href="/books/{{ $book['id'] }}">
                    <h3 style="font-weight:bold">{{ $book['title'] }}</h3>
                    <img src="{{ $book['cover_image'] }}" alt="book cover" width="150" height="220"><br>

                    <div class="buttons-grp">
                        <div class="details-btn">
                            <a href="/books/{{ $book->id }}">View Details</a>
                        </div>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>
    {{ $books->links() }}
</x-userHeader>

<x-userHeader>
  <h2>Home Page</h2>
  <ul>
    @foreach ($books as $book) 
      <li>
        <x-card href="/books/{{ $book['id'] }}">
          <h3 style="font-weight:bold">{{ $book['title'] }}</h3>
          <img src="{{$book['cover_image']}}" alt="book cover" width="150" height="220"><br>

          <div class="buttons-grp">
            <div class="details-btn">
                <a href="/books/{{ $book->id }}" >View Details</a>
            </div>
          </div>
        </x-card>
      </li>
    @endforeach
  </ul>
  {{ $books->links() }}
</x-userHeader>




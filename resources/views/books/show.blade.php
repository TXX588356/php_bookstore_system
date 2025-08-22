<x-header>
  <style>
    .book-details-container {
      display: flex;
    }
    img {
      margin-right: 20px;
    }
  </style>
    <h1>Book Details</h1>
    <h2>{{ $book->title }}</h2>

  

  <div class="book-details-container">
      <img src="{{$book->cover_image}}" alt="book cover" width="400" height="500"><br>
      <div class="inner-container">
        <p><strong>Author: </strong>{{ $book->author }}</p>
        <p><strong>Description: </strong>{{ $book->desc }}</p> 
        <p><strong>Page Count: </strong>{{ $book->page_count }}</p> 
        <p><strong>Publisher: </strong>{{ $book->publisher }}</p>
        <p><strong>Catogories:</strong>
          @foreach($book->categories as $category)
            {{ $category->name }}@if (!$loop->last), @endif
          @endforeach
        </p>
        <p><strong>Price: </strong>RM{{ $book->price }}</p>
        <p><strong>Stock: </strong>{{ $book->stock }}</p>
      </div>
  </div>


  
</x-header>

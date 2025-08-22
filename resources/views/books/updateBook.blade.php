<x-header>
  <title>Update Book</title>
  <form class="w-full max-w-[800px] mx-auto px-5" action="/admin/books/updateBook" method="POST">
    @csrf
      <input type="hidden" name="id" value={{ $book->id }}>
      <div class="mb-5">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Title:</label>
        <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light">
        <span style="color:red">@error('title'){{$message}}@enderror</span><br>  
      </div>
    
      <div class="mb-5">
        <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author Name:</label>
        <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light">
        <span style="color:red">@error('author'){{$message}}@enderror</span><br>
      </div>
    
      <div class="mb-5">
        <label for="page_count" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Number of Pages:</label>
        <input type="number" id="page_count" name="page_count" value="{{ old('page_count', $book->page_count) }}" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light">
        <span style="color:red">@error('page_count'){{$message}}@enderror</span><br>
      </div>

      <div class="mb-5">
        <label for="publisher" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publisher:</label>
        <input type="text" id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" >
        <span style="color:red">@error('publisher'){{$message}}@enderror</span><br>
      </div>


      <div class="mb-5">
        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price:</label>
        <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $book->price) }}" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" >
        <span style="color:red">@error('price'){{$message}}@enderror</span><br>
      </div>

      <div class="mb-5">
        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock Available:</label>
        <input type="number" id="stock" name="stock" value="{{ old('stock', $book->stock) }}" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" >
        <span style="color:red">@error('stock'){{$message}}@enderror</span><br>
      </div>

    <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Description:</label>
    <textarea id="desc" rows="4" name="desc" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> {{ old('desc', $book->desc) }}</textarea>
    <span style="color:red">@error('desc'){{$message}}@enderror</span><br>

    <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="cover_image">Upload an image for book cover</div>

      <div class="mb-5">
        <label for="cover_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Cover Image Link:</label>
        <input type="text" id="cover_image" value="{{ old('cover_image', $book->cover_image) }}" name="cover_image" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" >
        <span style="color:red">@error('cover_image'){{$message}}@enderror</span><br>  

      </div>

    <br>
    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Please Select At Least One Category:</label>
    <div class="category_selection">
      @foreach($categories as $category) 
        <label class="category-item">
          <input type="checkbox" id="{{ $category->id}}" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, old('categories', $book->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
          {{ $category->name }}
        </label>
       
    
        
      @endforeach
    </div>
    <span style="color:red">@error('categories'){{$message}}@enderror</span><br>

    <br><br>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >Update Book</button>
  
  </form>
</x-header>
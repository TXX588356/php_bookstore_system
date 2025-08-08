<x-header>
  <form class="w-full max-w-[800px] mx-auto px-5" action="/books/create" method="post">
    @csrf

    <h1><strong>Create a New Book</strong></h1>
      <div class="mb-5">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Title:</label>
        <input type="text" id="title" name="title" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"  required><br>
      </div>
    
      <div class="mb-5">
        <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author Name:</label>
        <input type="text" id="author" name="author" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"  required><br>
      </div>
    
      <div class="mb-5">
        <label for="page_count" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Number of Pages:</label>
        <input type="number" id="page_count" name="page_count" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"  required><br>
      </div>

      <div class="mb-5">
        <label for="publisher" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publisher:</label>
        <input type="text" id="publisher" name="publisher" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"  required><br>
      </div>


      <div class="mb-5">
        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price:</label>
        <input type="number" id="price" name="price" step="0.01" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"  required><br>
      </div>

      <div class="mb-5">
        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock Available:</label>
        <input type="number" id="stock" name="stock" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"  required><br>
      </div>

    <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Description:</label>
    <textarea id="desc" rows="4" name="desc" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

{{--     <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="cover_image">Upload file</label>
    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="book_cover" type="file">
    <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="cover_image">Upload an image for book cover</div> --}}

      <div class="mb-5">
        <label for="cover_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Cover Image Link:</label>
        <input type="text" id="cover_image" name="cover_image" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"  required><br>
      </div>


    {{-- <input type="hidden" name="category_ids[]" id="category_input" />
    <div class="category-container">
      <div class="select-btn">
        <span>Select Category</span>
        <span class="arrow-down">
          <i class="fa-solid fa-chevron-down"></i>
        </span>
      </div>

      <ul class="list-items">
        @foreach($categories as $category) 
          <li class="item" data-id="{{ $category->id}}">
            <span class="checkbox">
              <i class="fa-solid fa-check check-icon"></i>
            </span>
            <span class="item-text">{{ $category->name }}</span>
          </li>
        @endforeach
      </ul>
    </div>
 --}}
    <br>
    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Please Select At Least One Category:</label>
    <div class="category_selection">
      @foreach($categories as $category) 
        <label class="category-item">
          <input type="checkbox" id="{{ $category->id}}" name="categories[]" value="{{ $category->id }}">
          {{ $category->name }}
        </label>
       
    
        
      @endforeach
    </div>

    <br><br>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >Create Book</button>
  
  </form>

  <script>
    /* const selectedCategories = new Set();
    const selectBtn = document.querySelector('.select-btn');
    const items = document.querySelectorAll('.item');
    const form = document.querySelector('form');

    const categoryInput = document.getElementById('category_input');
    selectBtn.addEventListener('click', () => {
      selectBtn.classList.toggle('open')
    })

    items.forEach(item => {
      item.addEventListener('click', () => {
        items.forEach(i => i.classList.remove('checked'));
        item.classList.toggle("checked");

        categoryInput.value = item.getAttribute('data-id');
        
      })
    }); */
  </script>
</x-header>
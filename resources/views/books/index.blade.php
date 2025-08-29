<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
<style>
    .top-container {
        display: flex;
        justify-content: space-between;
    }
</style>
<x-header>
    <h2>Home Page</h2>

    <div class="top-container">
        <div class="searchContainer">
            <form action="/search" method="GET">
                <input type="text" name="search" required placeholder="Find books by title or description"
                    size="80" />
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Search</button>
            </form>
        </div>

        <div class="sortContainer">
<el-dropdown class="inline-block">
            <button
                class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-blue-100 px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1 inset-ring-gray-300 hover:bg-blue-200">Sort By
                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                    class="-mr-1 size-5 text-gray-400">
                    <path
                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </button>

            <el-menu anchor="bottom end" popover
                class="w-65 origin-top-right rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                <div class="py-1">
                    <a href="/priceSearch?sortPrice=LessThan5"
                        class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">Price
                        (Less Than RM5)</a>
                    <a href="/priceSearch?sortPrice=MoreThan5"
                        class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">Price
                        (More Than RM5)</a>
                    <a href="/bookTitleSort?sortByAlphabet=asc"
                        class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">A-Z
                        (Book Title)</a>
                    <a href="/bookTitleSort?sortByAlphabet=des"
                        class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">Z-A
                        (Book Title)</a>
                </div>
            </el-menu>
        </el-dropdown>
        </div>
        
    </div>




    <br>
    <p>Search by Category</p>
    <ul>
        <li style="display: inline-block"><a class="category-link" href="/">All Categories</a></li>
        @foreach ($categories as $category)
            <li style="display:inline-block">
                <a class="category-link" href="/categorySearch?categorySearch={{ $category->name }}">|
                    {{ $category->name }}</a>
            </li>
        @endforeach
    </ul>

    <ul>
        @if ($books->isEmpty())
            <p>No result found.</p>
        @else
            @foreach ($books as $book)
                <li>
                    <x-card href="/books/{{ $book['id'] }}">
                        <h3 style="font-weight:bold">{{ $book['title'] }}</h3>
                        <img src="{{ asset($book['cover_image']) }}" alt="book cover" width="150" height="220"><br>

                        <div class="buttons-grp">
                            <div class="details-btn">
                                <a href="/admin/books/{{ $book->id }}">View Details</a>
                            </div>
                            <div class="delete-btn">
                                <a href="/admin/books/delete/{{ $book->id }}">Delete</a>
                            </div>
                            <div class="update-btn">
                                <a href="/admin/books/update/{{ $book->id }}">Update</a>
                            </div>
                        </div>
                    </x-card>
                </li>
            @endforeach
        @endif
    </ul>
    {{ $books->appends(request()->except('page'))->links() }}
</x-header>

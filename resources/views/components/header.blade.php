<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNest Online Bookstore</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />


    <style>
        .category-container {
            position: relative;
            max-width: 390px;
            width: 100%;
            margin: 20px auto 30px;

        }

        .select-btn {
            background-color: lightsteelblue;
            justify-content: space-between;
            display: flex;
            height: 50px;
            align-items: center;
            pading: 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        .select-btn .arrow-down {
            display: flex;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            height: 20px;
            width: 20px;
            color: white;
            background: lightslategray;
            transition: 0.3s;
        }

        .select-btn.open .arrow-down {
            transform: rotate(-180deg);
        }

        .list-items {
            position: relative;
            background-color: #fff;
            margin-top: 10px;
            border-radius: 8px;
            padding: 10px;
            display: none;
        }

        .select-btn.open~.list-items {
            display: block;
        }



        .list-items .item {
            list-style: none;
            display: flex;
            align-items: center;
            height: 40px;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 8px;
            padding: 0 10px;
        }

        .list-items .item:hover {
            background-color: #e7edfe;
        }

        .item .item-text {
            font-size: 15px;
        }

        .item .checkbox {
            display: flex;
            justify-content: center;
            height: 16px;
            width: 16px;
            align-items: center;
            border-radius: 4px;
            margin-right: 12px;
            border: 1.5px solid #c0c0c0;
            transform: all 0.3s ease-in-out;
        }

        .checkbox .check-icon {
            font-size: 11px;
            transform: scale(0);
            transform: all 0.3s ease-in-out;
        }

        .item.checked .checkbox {
            background-color: lightskyblue;
            border-color: lightskyblue
        }

        .item.checked .check-icon {
            transform: scale(1);
            color: #fff;
        }

        nav {
            padding: 20px;
        }

        h1 {
            margin-bottom: 10px;
            font-weight: bold;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .nav-links a {
            background-color: lightgoldenrodyellow;
            padding: 10px;
            border-radius: 10px;
            margin: 10px;
        }

        .buttons-grp {
            display: flex;
            gap: 10px;
            magin: 10px 0;
        }

        .details-btn a {
            background-color: lightyellow;
            padding: 10px;
            border-radius: 10px;
            margin: 10px;
        }

        .delete-btn a {
            background-color: #e15454;
            padding: 10px;
            border-radius: 10px;
            margin: 10px;
        }

        .update-btn a {
            background-color: #54dfe1;
            padding: 10px;
            border-radius: 10px;
            margin: 10px;
        }

        img {
            margin: 10px;
        }

        .category_selection {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            align-items: center;
        }

        .category_item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    @if (session('success'))
        <div id="flash" class="p-4 text-center bg-green-50 text-green-500 font-bold">{{ session('success') }}</div>
    @endif
    <header>
        <nav>
            <h1>BookNest Online Bookstore</h1>
            @auth
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Logout</button>
                </form>
            @endauth
            <div class="nav-links">
                <a href="/admin/books/index">All Books</a>
                <a href="/admin/books/create">Create New Book</a>
            </div>

        </nav>
    </header>
    <hr>
    <main class="container">
        {{ $slot }}
    </main>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>

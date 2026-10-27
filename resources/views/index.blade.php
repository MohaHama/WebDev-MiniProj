
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>
</head>
<body>
    <h1>Products</h1>

    @auth
        <!-- Show the logged-in user's name -->
        <p>Welcome, {{ auth()->user()->name }}</p>

        <!-- Links for logged-in users -->
        <a href="{{ route('products.create') }}">Create Product</a>
        <a href="{{ route('wishlist.index') }}">My Wishlist</a>

        <!-- Log out the user -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth

    @guest
        <!-- Links for guests -->
        <a href="{{ route('register') }}">Register</a>
        <a href="{{ route('login') }}">Login</a>
    @endguest

    <table border="1">
        <!-- Table headers -->
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Description</th>
            <th>Show</th>
            <th>Wishlist</th>
            <th>Delete</th>
        </tr>

        <!-- Loop through all products from the database -->
        @foreach ($products as $product)
            <tr>
                <td>
                    <!-- Show the product image -->
                    @if($product->image_path)
                        <img
                            src="{{ route('products.image', $product->id) }}"
                            alt="{{ $product->name }}"
                            width="100"
                        >
                    @endif
                </td>

                <td>{{ $product->name }}</td>
                <td>{{ $product->qty }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td>

                <!-- Show the product details -->
                <td>
                    <a href="{{ route('products.show', $product->id) }}">Show</a>
                </td>

                <!-- Add the product to the user's wishlist -->
                <td>
                    @auth
                        <form method="POST" action="{{ route('wishlist.store', $product->id) }}">
                            @csrf

                            <button type="submit">Add to Wishlist</button>
                        </form>
                    @endauth
                </td>

                <!-- Delete the selected product -->
                <td>
                    @auth
                        <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit">Delete</button>
                        </form>
                    @endauth
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>

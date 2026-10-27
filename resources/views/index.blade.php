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
    <p>Welcome, {{ auth()->user()->name }}</p>

    <a href="{{ route('products.create') }}">Create Product</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @endauth

    @guest
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
            <th>Delete</th>
        </tr>

        <!-- Loop through all products from the database -->
        @foreach ($products as $product)
            <tr>
                <td>
                    <!-- Show the product image -->
                @if($product->image_path)
                    <img src="{{ route('products.image', $product->id) }}" alt="{{ $product->name }}" width="100">
                @endif
                </td>

                <td>{{ $product->name }}</td>
                <td>{{ $product->qty }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td>

                <td>
                    <a href="{{ route('products.show', $product->id) }}">Show</a>
                </td>

                <!-- Delete the selected product -->
                <td>
                @auth
                    @if(auth()->user()->isAdmin())
                        <!-- Only admins can see the delete button -->
                        <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                            @csrf
                            @method('DELETE')
                        
                            <button type="submit">Delete</button>
                        </form>
                    @endif
                @endauth
</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
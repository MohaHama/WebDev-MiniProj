
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Wishlist</title>
</head>
<body>
    <h1>My Wishlist</h1>

    <a href="{{ route('products.index') }}">Back to Products</a>

    <!-- Show all products saved by the logged-in user -->
    @foreach($products as $product)
        <div>
            <p>{{ $product->name }} - {{ $product->price }}</p>

            <!-- Remove the product from the wishlist -->
            <form method="POST" action="{{ route('wishlist.destroy', $product->id) }}">
                @csrf
                @method('DELETE')

                <button type="submit">Remove</button>
            </form>
        </div>
    @endforeach
</body>
</html>

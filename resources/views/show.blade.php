<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>
</head>
<body>
    <h1>Product Details</h1>

    <table border="1">
        <tr>
    <th>Image</th>
    <td>
        <!-- Show the product image -->
            @if($product->image_path)
            <img src="{{ route('products.image', $product->id) }}"
                 alt="{{ $product->name }}"
                 width="200">
            @endif
            </td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>{{ $product->qty }}</td>
        </tr>
        <tr>
            <th>Price</th>
            <td>{{ $product->price }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $product->description }}</td>
        </tr>
    </table>

    <a href="{{ route('products.index') }}">Back to Products</a>
</body>
</html>
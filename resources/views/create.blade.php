<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>
</head>
<body>
    <h1>Create a product</h1>
    <a href="{{ route('products.index') }}"><button>Go to index</button></a>

   @if($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
        
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        <!-- 
        enctype="multipart/form-data"
        Det fortæller browseren, hvordan den skal sende formularens data, så filens indhold også bliver sendt korrekt.
        Uden enctype modtager Laravel normalt ikke den uploadede fil som forventet
        -->
    @csrf
        @method('POST')
        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="name">
        </div>
        <div>
            <label for="qty">Qty</label>
            <input type="text" name="qty" placeholder="qty">
        </div>
        <div>
            <label for="price">Price</label>
            <input type="text" name="price" placeholder="price">
        </div>
        <div>
            <label for="description">Description</label>
            <input type="text" name="description" placeholder="description">
        </div>
        <div>
            <input type="submit" value="Save a new Product">
        </div>
    </form>
</body>
</html>
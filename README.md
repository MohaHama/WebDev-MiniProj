### Task 7 Images.


# Image Upload for Products (Laravel)

This guide explains how to upload, save, display, and delete product images in Laravel.

## Step 1: Create a Migration

Run the following command in your terminal - Remember to change "Products" to your resource!:

```bash
php artisan make:migration add_image_path_to_products_table --table=products
```

Open the new migration in `database/migrations` and add:

```php
public function up(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('image_path')->nullable();
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('image_path');
    });
}
```

Run the migration:

```bash
php artisan migrate
```

The database now has a column for storing the image path.

## Step 2: Update the Product (Remember your own resource) Model

In `app/Models/Product.php`, update `$fillable`:

```php
protected $fillable = [
    'name',
    'qty',
    'price',
    'description',
    'image_path'
];
```

## Step 3: Add Image Upload to create.blade.php

Add `enctype="multipart/form-data"` to your existing form:

```html
<form method="POST"
      action="{{ route('products.store') }}"
      enctype="multipart/form-data">
```

Inside the form, add:

```html
<label for="image">Image</label>
<input type="file" name="image" id="image" accept="image/*">
```

The `enctype="multipart/form-data"` attribute allows files to be uploaded.

## Step 4: Save the Image in ProductController

In the `store()` method, after creating `$product` and assigning its other attributes:

```php
// Save the uploaded image
if ($request->hasFile('image')) {
    $product->image_path = $request->file('image')->store('products');
}

// Save product and image path in database
$product->save();
```

**Note:** Make sure `$product = new Product();` appears earlier in the method.

In validation remember:
```php
'image' => 'nullable|image'
```

The `store('products')` method saves the file in Laravel's storage and returns its path.

## Step 5: Create an Image Route

In `routes/web.php`, add:

```php
Route::get('/products/{id}/image', [ProductController::class, 'image'])
    ->name('products.image');
```

This route allows the browser to request a product image.

## Step 6: Create the image() Method

At the top of `ProductController.php`, import Storage:

```php
use Illuminate\Support\Facades\Storage;
```

Add the following method inside the controller:

```php
public function image($id)
{
    // Find product
    $product = Product::findOrFail($id);

    // Check if image exists
    if (!$product->image_path || !Storage::exists($product->image_path)) {
        abort(404);
    }

    // Return image to browser
    return response(
        Storage::get($product->image_path),
        200,
        ['Content-Type' => Storage::mimeType($product->image_path)]
    );
}
```

`Storage::get()` reads the image file, and `response()` sends it to the browser.

## Step 7: Display the Image in index.blade.php

Add an image column to your table header:

```html
<th>Image</th>
```

Inside your `@foreach` loop, add:

```blade
<td>
    @if($product->image_path)
        <img src="{{ route('products.image', $product->id) }}" width="100" alt="Product image">
    @endif
</td>
```

---

### Step 8: Display the Image in show.blade.php

Add the following row to your table:

```blade
<tr>
    <th>Image</th>
    <td>
        @if($product->image_path)
            <img src="{{ route('products.image', $product->id) }}" width="200" alt="Product image">
        @endif
    </td>
</tr>
```

### Step 9: Delete the Image When Deleting a Product

Update the `destroy()` method in `ProductController.php`:

```php
public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Delete image from storage
    if ($product->image_path) {
        Storage::delete($product->image_path);
    }

    // Delete product from database
    $product->delete();

    return redirect()->route('products.index');
}
```

This ensures that the uploaded image is also deleted when the product is removed.

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Edit Product</h1>
    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <form method="post" action="{{ route('product.update', ['product' => $product]) }}">
        @csrf
        @method('put')
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" required value="{{ $product->name }}" /> <br />
        <label for="stock">Stock Available</label>
        <input type="number" name="stock" id="stock" required value="{{ $product->stock }}" /> <br />
        <label for="description">Product Description</label>
        <input type="text" name="description" id="description" value="{{ $product->description }}" /> <br />
        <label for="price">Sales Price</label>
        <input type="number" step="0.01" name="price" id="price" required value="{{ $product->price }}" />
        <br />
        <input type="submit" value="Update Product" />
    </form>
</body>

</html>

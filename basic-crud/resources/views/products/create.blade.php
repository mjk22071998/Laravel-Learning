<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Create Products</h1>
    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <form method="POST" action="{{ route('product.store') }}">
        @csrf
        @method('post')
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" required /> <br />
        <label for="stock">Stock Available</label>
        <input type="number" name="stock" id="stock" required /> <br />
        <label for="description">Product Description</label>
        <input type="text" name="description" id="description" /> <br />
        <label for="price">Sales Price</label>
        <input type="number" step="0.01" name="price" id="price" required /> <br />
        <input type="submit" value="Create Product" />
    </form>
</body>

</html>

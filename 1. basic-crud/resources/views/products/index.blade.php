<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table {
            width: 50%;
            margin: auto;
            border: 2px solid #776655;
        }

        td,
        th {
            padding: 25px;
            border: 2px solid #776655;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <h1>Products page</h1>
    <div>
        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Available Stock</th>
                <th>Sale Price</th>
                <th>Action</th>
            </tr>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->price }}</td>
                    <td><a href="{{ route('product.edit', ['product' => $product]) }}">Edit</a> | <form method="post"
                            action="{{ route('product.delete', ['product' => $product]) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="{{ route('product.create') }}">Create Product</a>
    </div>
</body>

</html>

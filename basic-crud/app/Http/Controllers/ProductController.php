<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view("products.index", ['products' => $products]);
    }

    public function create(): View
    {
        return view("products.create");
    }

    public function edit(Product $product): View
    {
        return view("products.edit", ['product' => $product]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable'
        ]);

        $newProduct = Product::create($data);

        return redirect(route('product.index'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable'
        ]);
        $product->update($data);
        return redirect(route('product.index'))->with('success', 'Product Updated Successfully');
    }

    public function delete(Product $product){
        $product->delete();
        return redirect(route('product.index'));
    }
}
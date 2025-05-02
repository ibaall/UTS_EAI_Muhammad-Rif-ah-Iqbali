<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return response()->json(Product::all());
    }

    public function show($id) {
        $product = Product::find($id);
        if ($product) {
            return response()->json($product);
        }
        return response()->json(['error' => 'Product not found'], 404);
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    $product = Product::create($validated);

    return response()->json([
        'status' => 'success',
        'data' => $product
    ], 201);
}
public function updateStock(Request $request, $id)
{
    $validated = $request->validate([
        'stock' => 'required|integer|min:0',
    ]);

    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->stock = $validated['stock'];
    $product->save();

    return response()->json([
        'status' => 'success',
        'data' => $product
    ]);
}

}

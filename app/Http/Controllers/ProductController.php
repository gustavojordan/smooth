<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->paginate('10');
        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->only('sku', 'price', 'name', 'category_id');
        $validator = Validator::make($fields, [
            'name' => 'required|filled|string',
            'sku' => 'required|string',
            'price' => 'required|filled|numeric',
            'category_id' => 'required|min:1|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $product = Product::create($validator->validated());
        return response()->json($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = Product::with('category')->find($product);
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $fields = $request->only('sku', 'price', 'name', 'category_id');
        $validator = Validator::make($fields, [
            'name' => 'filled|string',
            'sku' => 'filled|string',
            'price' => 'filled|numeric',
            'category_id' => 'filled|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $product->fill($validator->validated())->save();
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}

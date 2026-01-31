<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id')->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        try
        {
            $product = new Product();
            $product->fill($data);
            $product->save();

            return response()->json($product, 201);
        }
        catch(Exception $exception)
        {
            return response()->json([
                'message' => 'Ocorreu um erro ao criar o produto'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try
        {
            $product = Product::findOrFail($id);
            return response()->json($product);
        }
        catch(Exception $exception)
        {
            return response()->json([
                'message' => 'Produto não encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, string $id)
    {
        $data = $request->validated();

        try
        {
            $product = Product::findOrFail($id);
            $product->update($data);

            return response()->json($product, 200);
        }
        catch(Exception $exception)
        {
            return response()->json([
                'message' => 'Ocorreu um erro ao atualizar o produto'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try
        {
            Product::destroy($id);

            return response()->json(null, 204);
        }
        catch(Exception $exception)
        {
            return response()->json([
                'message' => 'Ocorreu um erro ao eliminar o produto'
            ], 400);
        }
    }
}

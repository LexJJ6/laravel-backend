<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check())
        {
            $products = Product::withTrashed()->get();
        }
        else
        {
            $products = Product::all(); // não inclui os soft deleted como acima com withTrashed
        }

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
            if (Auth::check())
            {
                $product = Product::withTrashed()->findOrFail($id);
            }
            else
            {
                $product = Product::findOrFail($id);
            }

            return response()->json($product);
        }
        catch(Exception $exception)
        {
            return response()->json([
                'message' => 'Utilizador não encontrado'
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
        //
    }
}

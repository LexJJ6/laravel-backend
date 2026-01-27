<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        //
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
                'message' => 'Utilizador não encontrado!'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

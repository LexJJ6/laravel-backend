<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        try
        {
            DB::beginTransaction();
            $product = Product::findOrFail($data['product_id']);

            if($product->stock < $data['quantity'])
            {
                throw new Exception('Quantidade não pode ser maior do que o stock');
            }

            $product->stock -= $data['quantity'];
            $product->save();

            $order = new Order();
            $order->fill($data);
            $order->save();
            DB::commit();

            return response()->json($order, 201);
        }
        catch(Exception $exception)
        {
            DB::rollBack();
            if($exception->getMessage() === 'Quantidade não pode ser maior do que o stock')
            {
              return response()->json([
                  'message' => 'Quantidade não pode ser maior do que o stock'
              ], 400);
            }
            else
            {
              return response()->json([
                  'message' => 'Ocorreu um erro ao criar a compra'
              ], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

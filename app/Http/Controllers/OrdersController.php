<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Orders::all();
        return $order;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    * @param \Illuminate\Http\Request $request
    
    
    */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
           
            'products' => 'required|array',
            'total_price' => 'required',
            'comments' => 'nullable',
            'delivered' => 'required|boolean',
            'paid' => 'required|boolean',
            'is_delivered_by' => 'required',
            'location_lat' => 'required',
            'location_long' => 'required',
            "user_phone_number" => 'required'
        ]);

        $order = new Orders();
        $order->user_id = $validatedData['user_id'];
       
        $order->products = $validatedData['products'];
        $order->total_price = $validatedData['total_price'];
        $order->comments = $validatedData['comments'];
        $order->delivered = $validatedData['delivered'];
        $order->paid = $validatedData['paid'];
        $order->is_delivered_by = $validatedData['is_delivered_by'];
        $order->location_lat = $validatedData['location_lat'];
        $order->location_long = $validatedData['location_long'];
        $order->user_phone_number = $validatedData['user_phone_number'];
        $order->save();

        return response()->json([
            'message' => 'Orden created',
            'order' => $order
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Orders::find($id);
        return $order;

    }

    /**
     * Display the specified resorced
     */
    public function code($code)
    {
        $order = Orders::where('user_id', $code)->get();
        return $order;
    }

    /** Show the orders by who is going to delivere the order */

    public function showOrderByRole($deliveredBy)
    {
        $order = Orders::where('is_delivered_by', $deliveredBy)->get();
        return $order;
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Orders::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delivered = $request->delivered;
        $order->paid = $request->paid;
        $order->save();
        $order->touch();

        return response()->json(['message' => 'Order update', 'order' => $order]);

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Orders::findOrFail($id);

        if (!$order) {
            return response()->json([
                "message" => "id not found"
            ]);
        } else {

            $order->delete();

            return response()->json([
                "message" => "Order detele"
            ]);
        }


    }
}
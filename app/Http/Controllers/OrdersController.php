<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


        $order = new Orders();
        $order->user_id = $request->user_id;

        $order->products = $request->products;
        $order->total_price = $request->total_price;
        $order->comments = $request->comments;
        $order->delivered = $request->delivered;
        $order->paid = $request->paid;
        $order->is_delivered_by = $request->is_delivered_by;
        $order->location_lat = $request->location_lat;
        $order->location_long = $request->location_long;
        $order->user_phone_number = $request->user_phone_number;
        $order->is_being_delivering = $request->is_being_delivering;
        $order->client_name=$request->client_name;
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
    public function update($id)
    {
        $order = Orders::find($id);
        return $order;
    }
        
        
    public function statusUpdate(Request $request, $id)
    {
        $orders = Orders::find($id);
    
        if (!$orders) {
            return response()->json([
                "mensaje" => "Order with ID $id doesn't exist"
            ], 404);
        } else {
            $orders->paid = $request->input('paid');
            $orders->delivered = $request->input('delivered');
            $orders->save();
    
            return response()->json([
                "message" => "Order status updated",
                "order" => $id
            ]);
        }
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
    
    /**
    *get all the data with delivered and paid true
    */
    
    function getPaidAndDeliveredData($delivererId)
    {
      $data = Orders::where('paid', true)
                ->where('delivered', true)
                ->where('is_delivered_by', $delivererId)
                ->get();
    return $data;
    }
    
        function getPaidAndDeliveredDataClient($delivererId)
    {
      $data = Orders::where('paid', true)
                ->where('delivered', true)
                ->where('user_id', $delivererId)
                ->get();
    return $data;
    }
    
     /**
    *get all the data with delivered and paid false
    */
    
    function getNoPaidAndDeliveredData($delivererId)
    {
   $data = Orders::where('paid', false)
                ->where('delivered', false)
                ->where('is_delivered_by', $delivererId)
                ->get();
     return $data;
    }
    
        function getNoPaidAndDeliveredDataClient($user_id)
    {
   $data = Orders::where('paid', false)
                ->where('delivered', false)
                ->where('user_id', $user_id)
                ->get();
     return $data;
    }
}
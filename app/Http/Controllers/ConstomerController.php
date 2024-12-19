<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ConstomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return Inertia::render('Customer/Index', [
        //     'ProductModel' => $products,
        // ]);
        $user = Auth::user();
        $products = ProductModel::all();
        return Inertia::render('Customer/Index',[
            'user'=>   $user,
            'ProductModel' => $products,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validate incoming request data
         $validated = $request->validate([
            'name_order' => 'required|string',
            'order_qty' => 'required|integer|min:1',
            'price_product' => 'required|numeric',
            'product_id' => 'required|integer|exists:products,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        // Create a new order
        $order = Order::create($validated);

        // Redirect to a success page or return a JSON response
        return response()->json([
            'message' => 'Order created successfully!',
            'order' => $order,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function orderHistory()
    {
      //  $orders = Auth::user()->orders()->with('product')->get();


        // Return the data to the frontend via Inertia
        // return Inertia::render('OrderHistory', [
        //     'orders' => $orders,
        // ]);
    }

public function create_history($id){

}

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

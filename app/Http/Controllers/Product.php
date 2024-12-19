<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\ProductModel;

class Product extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = ProductModel::all();
        return Inertia::render('Admin/ManageProduct', [
            'ProductModel' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/AddProduct');

    }

    public function  create_card_product(){
        $products = ProductModel::all();
        $user = auth()->user();
        return Inertia::render('Auth/ViewProduct', [
            'ProductModel' => $products,
            'auth' => [
                'user' => $user,
            ],
            'canLogin' => !isset($user),
            'canRegister' => !isset($user),  // Show register option if the user is not logged in
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'product_qty' => 'required|integer|min:1',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
            'product_code' => 'required|string|max:100|unique:products,product_code',
            'product_description' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('product_img')) {
            $imagePath = $request->file('product_img')->store('products', 'public'); // Save image in public storage
            $validated['product_img'] = $imagePath;
        }

        // Save the product
        ProductModel::create($validated);

        // Redirect with a success message
        return redirect()
            ->back()
            ->with('success', 'Product created successfully!');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = ProductModel::findOrFail($id);

        // Remove the image file if it exists
        if ($product->product_img && file_exists(storage_path("app/public/{$product->product_img}"))) {
            unlink(storage_path("app/public/{$product->product_img}"));
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Jobs\FetchProductsJob;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        dispatch(new FetchProductsJob());

        $products=Product::get();
        return view('products',compact('products'));

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
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'total_sales' => $request->total_sales,
            'stock_quantity' => $request->stock_quantity,
            'stock_status' => $request->stock_status,
        ]);
        return to_route("products");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

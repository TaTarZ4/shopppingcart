<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();
        return view('products.index',compact('data'));
    }    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Product::all();
        return view('products.create');
        //
    }

    public function fetchproduct()
    {
        $data = Product::all();
        return response()->json([
            'product'=>$data,
        ]);
        //
    }

    public function edit($id)
    {
        $data = Product::find($id);
        return response()->json([
            'product'=>$data,
        ]);
        //
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $data = Product::find($id);
        $data->name = $request->input('name');
        $data->price = $request->input('price');
        $data->img = $request->input('img');
        $data->update();
        return response()->json([
            'product'=>$data,
        ]);
    }

    public function destroy($id)
        {
            //
            $data = Product::find($id);
            $data->delete();
            return response()->json([
        ]);
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'img' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    // public function edit(Product $product)
    // {
    //     //
    //     return view('products.edit',compact('product'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Product $product)
    // {
    //     //
    //     $request->validate([
    //         'name' => 'required',
    //         'price' => 'required'
    //     ]);
    //     $product->update($request->all);

    //     return redirect()->route('product.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    
}

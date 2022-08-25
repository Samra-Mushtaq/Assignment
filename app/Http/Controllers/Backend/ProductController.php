<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $products = Product::orderBy('id','DESC')->paginate(5);
        return view('backend.products.index',compact('products'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'language' => $request->language,
            'category' => $request->category,
            'price' => $request->price,
        ]);
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $Product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->language = $request->language;
        $product->category = $request->category;
        $product->price = $request->price;
        $res = $product->save();
        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->language = $request->language;
        $product->category = $request->category;
        $product->price = $request->price;
        $res = $product->save();
        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        $res = $product->delete();
        return $res;

    }
}

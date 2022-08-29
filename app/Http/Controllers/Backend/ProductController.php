<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use Illuminate\Http\Request;
use File;
use Image;
use Illuminate\Support\Facades\Storage;
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
        $categories = Category::orderBy('id','DESC')->get();
        return view('backend.products.index',compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::orderBy('id','DESC')->get();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if(isset($request->image)){
            $image      = $request->file('image');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(40, 40, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('local')->put('public'.'/'.$filename, $img, 'public');
        }else{
            $filename  = ""; 
        } 
        // dd($filename);
        $Product = Product::create([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'en_description' => $request->en_description,
            'ar_description' => $request->ar_description,
            'category_id' => $request->category,
            'status' => $request->status,
            'price' => $request->price,
            'image' => $filename,
        ]);
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
       
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
        $product = Product::with('category')->find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        if(isset($request->image)){
            $image      = $request->file('image');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(40, 40, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('local')->put('public'.'/'.$filename, $img, 'public');
        }
        $product = Product::find($id);
        $product->en_name = $request->en_name;
        $product->en_description = $request->en_description;
        $product->ar_name = $request->ar_name;
        $product->ar_description = $request->ar_description;
        $product->status = $request->status;
        $product->category_id = $request->category;
        $product->price = $request->price;
        if(isset($request->image)){
            $product->image = $filename;
        }
        $res = $product->save();
        return 1;
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
        return 1;

    }
}

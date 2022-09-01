<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use Illuminate\Http\Request;
use File;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;


use DataTables;


class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        return view('backend.products.index');
    }

    public function dataTable () {
        $products = Product::orderBy('id', 'desc'); 
        return Datatables::of($products)
            ->addIndexColumn()
            ->addColumn('actions', function ($record) {
                $actions = '';
                if(auth()->user()->hasPermissionTo('product-edit')) {
                    $actions .= '<button class="btn btn-primary mb-1 mr-1 p-1" data-act="ajax-modal" data-method="get"
                            data-action-url="'. route('products.edit', $record->id). '" data-title="Edit Product"
                            data-toggle="tooltip" data-placement="top" title="Edit Product">
                                Edit
                            </button>';
                }
                if(auth()->user()->hasPermissionTo('product-delete')) {
                    $actions .= '<a class="btn btn-danger delete mb-1 p-1" data-table="products-table" data-method="get"
                            data-url="' .route('products.destroy', $record->id). '" data-toggle="tooltip" data-placement="top" title="Delete Product">
                                Delete
                            </a>';
                }
                return $actions;
            })
            ->addColumn('category', function ($record) {
                $category_data = "";
                foreach($record->category as $key=>$category){
                    $category_data .= $category->en_name . " | ". $category->ar_name . " , ";
                }
                $category_data = substr_replace($category_data ,"", -2);
                return $category_data;
            })
            ->addColumn('en_name', function ($record) {
                $name_column = '';
                $url= asset('storage/'.$record->image);
                $name_column .= '<span class="tb-product"><img src="'.$url.'" style="display: block;" alt="" class="thumb"></span>';
                $name_column .= $record->en_name;
                return $name_column;
            })
            ->rawColumns(['actions', 'category', 'en_name'])->make(true);
    }

    public function create()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('backend.products.model',compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        try{
            if(isset($request->image)){
                $image      = $request->file('image');
                $filename  = time() . '.' . $image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $img->resize(40, 40, function ($constraint) {
                    $constraint->aspectRatio();                 
                });
                $img->stream(); 
                Storage::disk('local')->put('public'.'/'.$filename, $img, 'public');
            }else{
                $filename  = ""; 
            } 
            $product = new Product;
            $product->en_name = $request->en_name;
            $product->en_description = $request->en_description;
            $product->ar_name = $request->ar_name;
            $product->ar_description = $request->ar_description;
            $product->status = $request->status;
            $product->price = $request->price;
            if(isset($request->image)){
                $product->image = $filename;
            }
            $res = $product->save();

            $product = Product::orderBy('id', 'desc')->first();
            foreach($request->categories as $category_id){
                $category = Category::where('id', $category_id)->first();
                $product->category()->attach($category);
            }

            return response()->json([
                'message' => 'Product Successfully Added'
            ]); 
        }catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]); 
        }
    }

    public function show(Request $request)
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('backend.products.add',compact('categories'));
    }

    public function edit($id)
    {
        $product = Product::with('category')->find($id);
        $categories = Category::orderBy('id','DESC')->get();
        return view('backend.products.model', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        try{
            if(isset($request->image)){
                $image      = $request->file('image');
                $filename  = time() . '.' . $image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $img->resize(40, 40, function ($constraint) {
                    $constraint->aspectRatio();                 
                });

                $img->stream(); 
                Storage::disk('local')->put('public'.'/'.$filename, $img, 'public');
            }
            $product = Product::with('category')->find($id);
            foreach($product->category as $category){
                $product->category()->where('category_id', $category->id)->detach();
            }
            $product->en_name = $request->en_name;
            $product->en_description = $request->en_description;
            $product->ar_name = $request->ar_name;
            $product->ar_description = $request->ar_description;
            $product->status = $request->status;
            $product->price = $request->price;
            if(isset($request->image)){
                $product->image = $filename;
            }
            $res = $product->save();

            $product = Product::where('id', $id)->first();
            foreach($request->categories as $category_id){
                $category = Category::where('id', $category_id)->first();
                $product->category()->attach($category);
            }

            return response()->json([
                'message' => 'Product Successfully Updated'
            ]); 
        }catch(\Exception $exception) {
            return response()->json([
                'message' => 'Something Went wrong'
            ]); 
        }
    }

    public function destroy($id)
    {
        try{
            $product = Product::find($id);
            $res = $product->delete();
            return response()->json([
                'message' => 'Product Successfully Deleted',
                'status' => 'success',
            ]); 
        }catch(\Exception $exception) {
            return response()->json([
                'message' => 'Something Went wrong',
                'status' => 'error',
            ]); 
        }
    }
}

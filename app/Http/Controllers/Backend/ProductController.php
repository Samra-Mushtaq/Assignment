<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use App\Models\Backend\Attachment;
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

    public function eloquent(Request $request)
    {
        
        $products = Product::orderBy('id', 'desc')->get(); 

        $products = Product::addSelect(['category' => Category::select('en_name')
            ->orderByDesc('created_at')
            ->limit(1)
        ])->get();
        dd($products);

        $products = $products->reject(function ($product) {
            return count($product->images) > 0;
        });
        dd($products);
    }

    public function product_image(Request $request){
        $products = Product::where('id', $request->product_id)->with('images')->first(); 
        return $products;
    }

    public function product_image_remove(Request $request){
        $product = Product::where('id', $request->product_id)->with('images')->first();
        if(Storage::exists('public/'.$request->filename)){
            Storage::delete('public/'.$request->filename);
        }
        $res = 0;
        if($product != null){
            $res = $product->images()->where('filename', $request->filename)->delete();
        }
        return $res;
    }

    public function dataTable () {
        $products = Product::orderBy('id', 'desc'); 
        return Datatables::of($products)
            ->addIndexColumn()
            ->addColumn('actions', function ($record) {
                $actions = '';
                if(auth()->user()->hasPermissionTo('product-edit')) {
                    $actions .= '<a class="btn btn-primary mb-1" href="'. route('products.edit', $record->id). '">
                                Edit
                            </a>';
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
                if(!$record->images->isEmpty()){
                    $url= asset('storage/'.$record->images[0]->filename);
                    $name_column .= '<span class="tb-product"><img src="'.$url.'" style="display: block;" alt="" class="thumb  w-60 h-40"></span>';
                }
                $name_column .= $record->en_name;
                return $name_column;
            })
            ->rawColumns(['actions', 'category', 'en_name'])->make(true);
    }

    public function create()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('backend.products.add',compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        try{
            $product_id = $request->product_id;
            // dd($product_id);
            if($product_id != ""){
                $product = Product::where('id', $product_id)->first();
                foreach($product->images as $image){
                    $product->images()->where('id', '=', $image->id)->delete();
                }
            }else{
                
                $product = new Product;
            } 
            $product->en_name = $request->en_name;
            $product->en_description = $request->en_description;
            $product->ar_name = $request->ar_name;
            $product->ar_description = $request->ar_description;
            $product->status = $request->status;
            $product->price = $request->price;
            $product->lat = $request->lat;
            $product->long = $request->long;
            $res = $product->save();
     
            $product = Product::orderBy('id', 'desc')->first();
            foreach($request->categories as $category_id){
                $category = Category::where('id', $category_id)->first();
                $product->category()->attach($category);
            }
            
            return response()->json([
                'status'=>"success",
                'message' => 'Product Successfully Added',
                'product_id'=> $product->id
            ]);
        }catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]); 
        }
    }

    public function storeimage(Request $request)
    {
        try{
            if($request->file('file')){
                foreach($request->file('file') as $file){
                    $product_id = $request->product_id;
                    $product = Product::where('id', $product_id)->first();

                    $image = $file;
                    $filename  = time() . '=n=' . $image->getClientOriginalName();
                    $ext = $image->extension();
                    $size = $image->getSize();
                    $img = Image::make($image->getRealPath());
                    // $img->resize(40, 40, function ($constraint) {
                    //     $constraint->aspectRatio();                 
                    // });
                    $img->stream(); 
                    Storage::disk('local')->put('public'.'/'.$filename, $img, 'public');

                    $attachment = new Attachment;
                    $attachment->filename = $filename;
                    $attachment->size = $size;
                    $attachment->extension = $ext;
                    $product->images()->save($attachment);
                }
        
                return response()->json([
                    'status'=>"success",
                    'message' => 'Product Successfully Added',
                    'product_id'=>$product_id]);
            }
          
        }catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]); 
        }
    }


    public function show(Request $request)
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('backend.products.map',compact('categories'));
    }

    public function edit($id)
    {
        $product = Product::with('category')->find($id);
        $categories = Category::orderBy('id','DESC')->get();
        return view('backend.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        try{
            
            $product = Product::with('category')->find($id);
            foreach($product->category as $category){
                $product->category()->where('category_id', $category->id)->detach();
            }
           
            $product->en_name = $request->en_name;
            $product->en_description = $request->en_description;
            $product->ar_name = $request->ar_name;
            $product->ar_description = $request->ar_description;
            $product->status = $request->status;
            $product->lat = $request->lat;
            $product->long = $request->long;
            $product->price = $request->price;
            $res = $product->save();

            $product = Product::where('id', $id)->first();
            foreach($request->categories as $category_id){
                $category = Category::where('id', $category_id)->first();
                $product->category()->attach($category);
            }

            return response()->json([
                'status'=>"success",
                'message' => 'Product Successfully Updated',
                'product_id'=> $product->id
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

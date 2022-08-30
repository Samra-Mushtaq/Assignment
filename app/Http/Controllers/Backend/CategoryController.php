<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $categories = Category::orderBy('id','DESC')->paginate(5);
        return view('backend.categories.index',compact('categories'));
            
    }

    // public function dataTable () {
    //     $products = Product::orderBy('id', 'desc'); 
    //     return Datatables::of($products)
    //         ->addIndexColumn()
    //         ->addColumn('actions', function ($record) {
    //             $actions = '';
    //             if(auth()->user()->hasPermissionTo('product-edit')) {
    //                 $actions .= '<button class="btn btn-primary mb-2" data-act="ajax-modal" data-method="get"
    //                         data-action-url="'. route('categories.edit', $record->id). '" data-title="Edit Category"
    //                         data-toggle="tooltip" data-placement="top" title="Edit Category">
    //                             <i class="ri-pencil-fill mr-2"></i>Edit
    //                         </a>';
    //             }
    //             if(auth()->user()->hasPermissionTo('product-delete')) {
    //                 $actions .= '<a class="dropdown-item delete" href="javascript:void(0)" data-table="categories-table" data-method="get"
    //                         data-url="' .route('categories.destroy', $record->id). '" data-toggle="tooltip" data-placement="top" title="Delete Category">
    //                             <i class="ri-delete-bin-6-fill mr-2"></i>Delete
    //                         </a>';
    //             }
    //             return $actions;
    //         })
    //         ->rawColumns(['actions'])->make(true);
    // }
    
    public function create()
    {
        // $categories = Category::orderBy('id','DESC')->get();
        // return $categories;
        // dd("dd");
        return view('backend.categories.model-content');
    }

    public function store(Request $request)
    {
        $category = Category::create([
            'en_name' => $request->en_name,
            'en_detail' => $request->en_detail,
            'ar_name' => $request->ar_name,
            'ar_detail' => $request->ar_detail,
        ]);
        return "Added";
    }

    public function show(Request $request, $id)
    {
        $category = Category::find($id);
        $category->en_name = $request->en_name;
        $category->ar_name = $request->ar_name;
        $category->en_detail = $request->en_detail;
        $category->ar_detail = $request->ar_detail;
        $res = $category->save();
        return $res;
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return $category;
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->en_name = $request->en_name;
        $category->ar_name = $request->ar_name;
        $category->en_detail = $request->en_detail;
        $category->ar_detail = $request->ar_detail;
        $res = $category->save();
        return "Updated";
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $res = $category->delete();
        return "Deleted";

    }
}

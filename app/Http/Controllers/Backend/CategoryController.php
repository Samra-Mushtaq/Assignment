<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

use DataTables;

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
        return view('backend.categories.index');
            
    }

    public function dataTable () {
        $categories = Category::orderBy('id', 'desc'); 
        return Datatables::of($categories)
            ->addIndexColumn()
            ->addColumn('actions', function ($record) {
                $actions = '';
                if(auth()->user()->hasPermissionTo('category-edit')) {
                    $actions .= '<button class="btn btn-primary mr-1 p-1" data-act="ajax-modal" data-method="get"
                            data-action-url="'. route('categories.edit', $record->id). '" data-title="Edit Category"
                            data-toggle="tooltip" data-placement="top" title="Edit Category">
                                Edit
                            </button>';
                }
                if(auth()->user()->hasPermissionTo('category-delete')) {
                    $actions .= '<a class="btn btn-danger delete p-1" data-table="categories-table" data-method="get"
                            data-url="' .route('categories.destroy', $record->id). '" data-toggle="tooltip" data-placement="top" title="Delete Category">
                                Delete
                            </a>';
                }
                return $actions;
            })
            ->rawColumns(['actions'])->make(true);
    }
    
    public function create()
    {
        return view('backend.categories.model');
    }

    public function store(CategoryRequest $request)
    {
        try{
            $category = Category::create([
                'en_name' => $request->en_name,
                'en_detail' => $request->en_detail,
                'ar_name' => $request->ar_name,
                'ar_detail' => $request->ar_detail,
            ]);
            return response()->json([
                'message' => 'Category Successfully Added'
            ]); 
        }catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]); 
        }
    }

    public function show(Request $request, $id)
    {
       
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.categories.model', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        try{
            $category = Category::find($id);
            $category->en_name = $request->en_name;
            $category->ar_name = $request->ar_name;
            $category->en_detail = $request->en_detail;
            $category->ar_detail = $request->ar_detail;
            $res = $category->save();
            return response()->json([
                'message' => 'Category Successfully Updated'
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

            $category = Category::find($id);
            $res = $category->delete();
            if($res){
                return response()->json([
                    'message' => 'Category Successfully Deleted',
                    'status' => 'success',
                ]);
            }else{
                return response()->json([
                    'message' => 'Category cannot be deleted as products exists against this category',
                    'status' => 'error',
                ]);
            }
        }catch(\Exception $exception) {
            return response()->json([
                'message' => 'Something Went wrong',
                'status' => 'error',
            ]); 
        }
        // $exception->getMessage()

    }
}

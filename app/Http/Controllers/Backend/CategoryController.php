<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
         $this->middleware('permission:category-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //
        $categories = Category::orderBy('id','DESC')->paginate(5);
        return view('backend.categories.index',compact('categories'));
        // ->with('i', ($request->input('page', 1) - 1) * 5);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::orderBy('id','DESC')->get();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $category = Category::find($id);
        $category->en_name = $request->en_name;
        $category->ar_name = $request->ar_name;
        $category->en_detail = $request->en_detail;
        $category->ar_detail = $request->ar_detail;
        $res = $category->save();
        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request->all());
        $category = Category::find($id);
        $category->en_name = $request->en_name;
        $category->ar_name = $request->ar_name;
        $category->en_detail = $request->en_detail;
        $category->ar_detail = $request->ar_detail;
        $res = $category->save();
        return "Updated";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);
        $res = $category->delete();
        return "Deleted";

    }
}

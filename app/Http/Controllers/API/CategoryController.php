<?php

namespace App\Http\Controllers\API;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index(Request $request)
    {
        $categories =  CategoryResource::collection(Category::paginate(10));
        return $categories;
    }

    public function store(Request $request)
    {

    }

    public function show(Request $request, $id)
    {
        $category = new CategoryResource(Category::findOrFail($id));
        return $category;
    }

  
    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        
    }
}

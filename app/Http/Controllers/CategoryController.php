<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Category $model)
    {
        $categories = $model->get();
        return view('categories', ['categories' => $categories]);
    }

    public function createCategoryByAjax(Request $request){
        $result = Category::create([
            'name' => $request->name,
        ]);
        return response()->json($result); 
    }

    public function updateCategoryByAjax(Request $request){
        $category = Category::find($request->id);
        $result = $category->update([
            'name' => $request->name,
        ]);
        return response()->json($result); 
    }

    public function deleteCategoryByAjax(Request $request){
        $category = Category::find($request->id);
        $result = $category->delete();
        return response()->json($result); 
    }
}

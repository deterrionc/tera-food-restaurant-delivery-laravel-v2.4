<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function index(Recipe $model)
    {
        // $recipes = $model->get();
        $recipes = DB::table('recipes')
        ->leftJoin('categories','categories.id','=','recipes.category')
        ->select('recipes.*', 'categories.name as categoryName', 'categories.id as categoryID')
        ->get();
        // dd($recipes);
        $categories = Category::get();
        $tags = Tag::get();
        return view('recipes', ['recipes' => $recipes, 'categories' => $categories, 'tags' => $tags]);
    }

    public function createRecipeByAjax(Request $request){
        $result = Recipe::create([
            'title' => $request->title,
        ]);
        return response()->json($result); 
    }

    public function updateRecipeByAjax(Request $request){
        // dd ("test");
        $recipe = Recipe::find($request->id);
        $result = $recipe->update([
            'title' => $request->title,
            'youtube' => $request->youtube,
            'category' => $request->category,
        ]);
        if ($files = $request->file('file')) {
            $file = $request->file->store('public/images');
            $result = $recipe->update([
                'image' => $file,
            ]);
            return response()->json([
                "success" => true,
            ]);
        }
        return response()->json($request); 
    }

    public function deleteRecipeByAjax(Request $request){
        $recipe = Recipe::find($request->id);
        $result = $recipe->delete();
        return response()->json($result); 
    }
}

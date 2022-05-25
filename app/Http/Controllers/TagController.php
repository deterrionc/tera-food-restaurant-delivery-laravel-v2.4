<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(Tag $model)
    {
        $tags = $model->get();
        return view('tags', ['tags' => $tags]);
    }

    public function createTagByAjax(Request $request){
        $result = Tag::create([
            'name' => $request->name,
        ]);
        return response()->json($result); 
    }

    public function updateTagByAjax(Request $request){
        $tag = Tag::find($request->id);
        $result = $tag->update([
            'name' => $request->name,
        ]);
        return response()->json($result); 
    }

    public function deleteTagByAjax(Request $request){
        $tag = Tag::find($request->id);
        $result = $tag->delete();
        return response()->json($result); 
    }
}

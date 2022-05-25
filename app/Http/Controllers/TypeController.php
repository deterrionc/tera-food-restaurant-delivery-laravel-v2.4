<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    public function index(Type $model)
    {
        $types = $model->get();
        return view('types', ['types' => $types]);
    }

    public function createTypeByAjax(Request $request){
        $result = Type::create([
            'name' => $request->name,
        ]);
        return response()->json($result); 
    }

    public function updateTypeByAjax(Request $request){
        $type = Type::find($request->id);
        $result = $type->update([
            'name' => $request->name,
        ]);
        return response()->json($result); 
    }

    public function deleteTypeByAjax(Request $request){
        $type = Type::find($request->id);
        $result = $type->delete();
        return response()->json($result); 
    }
}

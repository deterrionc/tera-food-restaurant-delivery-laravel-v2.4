<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $users = $model->get();
        return view('users.index', ['users' => $users]);
    }

    public function createCustomerByAjax(Request $request){
        $result = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'customer'
        ]);
        return response()->json($result); 
    }

    public function updateCustomerByAjax(Request $request){
        $user = User::find($request->id);
        $result = $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json($result); 
    }

    public function deleteCustomerByAjax(Request $request){
        $user = User::find($request->id);
        $result = $user->delete();
        return response()->json($result); 
    }

    public function updateCustomerStatusByAjax(Request $request){
        $user = User::find($request->id);
        $result = $user->update([
            'status' => $request->status,
        ]);
        return response()->json($result); 
    }
}

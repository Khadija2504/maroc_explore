<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' =>'required|string|min:2|max:20',
            'email' =>'required|email|max:100|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => hash::make($request->password),
        ]);
        return response()->json([
            'msg' => 'User created successfully',
            'user' => $user,
        ]);
    }
    public function login (Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|min:5|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        if(!$token = auth()->attempt($validator->validated())){
            return response()->json(['seccess'=>false, 'msg' => 'username and password are incorrect']);
        }
        return $this->responseWithToken($token);
    }
    protected function responseWithToken($token){
        return response()->json([
            'seccess' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_at' => auth()->factory()->getTTL() * 60,
        ]);
    }
    public function logout(){
        try {
            auth()->logout();
            return response()->json(['seccess' => true, 'msg' => 'User logged out successfully']);
        } catch (\Exception $e) {
            return response()->json(['seccess' => false, 'msg' => $e->getMessage()]);
        }
    }
}

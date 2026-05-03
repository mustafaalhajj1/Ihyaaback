<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $r)
    {
        $data = $r->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return $user->createToken('api')->plainTextToken;
    }

    public function login(Request $r)
    {
        $user = User::where('email',$r->email)->first();

        if(!$user || !Hash::check($r->password,$user->password)){
            return response()->json(['error'=>'invalid'],401);
        }

        return $user->createToken('api')->plainTextToken;
    }

    public function logout(Request $r)
    {
        $r->user()->tokens()->delete();
        return ['message'=>'logged out'];
    }
}
<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
// use Auth support Authenticated
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function signup(Request $req) {
        $validate_req = $req->validate([
            'name' => 'required|string',
	        'email' => 'required|string|unique:users,email|max:50',
            'password' => 'required|string|confirmed',
        ]);
        
        $user = User::create([
        'name' => $validate_req['name'],
        'email' => $validate_req['email'],
        'password' => bcrypt($validate_req['password']),
        ]);
        //generate token to string
        $user_token = $user->createToken('myapptoken')->plainTextToken;

        $res = [
            'success' => true,
            'user' => $user,
            'token' => $user_token,
        ];

        return response($res, 201);
    }

    public function login(Request $req) {
        $validate_req = $req->validate([
	        'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //check email 
        $user = User::where('email', $validate_req['email'])->first();

        // check password
        if(!$user || !Hash::check($validate_req['password'], $user->password)) {
            return response([
                'message' => "Email and password doesn't matched ",
            ], 401);
        }
        $user_token = $user->createToken('myappToken')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $user_token,
        ];

        return response($res, 201);
    }


    public function logout(Request $req) {

        Auth::user()->tokens()->delete();
        return [
            'message' => 'Logout Successfully'
        ];

    }
}

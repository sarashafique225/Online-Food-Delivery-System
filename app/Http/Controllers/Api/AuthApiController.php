<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 

class AuthApiController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // If User.php has HasApiTokens, this works!
        $token = $user->createToken('food-delivery-token')->plainTextToken;
        
        return response()->json(['token' => $token, 'user' => $user], 201);
    }

    public function login(Request $request) {
        if(!Auth::attempt($request->only('email','password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        
        /** @var \App\Models\User $user */
        $user  = Auth::user();
        $token = $user->createToken('food-delivery-token')->plainTextToken;
        
        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
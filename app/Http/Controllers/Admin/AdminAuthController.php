<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $admin = Auth::guard('admin')->user();
            $token = $admin->createToken('admin-token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'admin' => $admin
            ], 200);
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }

    public function logout(Request $request)
    {
       if($request->user()){
        $request->user()->currentAccessToken()->delete();
       }
        return response()->json(['message' => 'Logged out successfully']);
    }
    //
}

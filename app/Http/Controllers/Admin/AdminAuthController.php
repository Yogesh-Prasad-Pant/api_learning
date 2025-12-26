<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
class AdminAuthController extends Controller
{
    public function index(Request $request){
        $admins = Admin::query()->when($request->search, function ($query, $search){
            $query->where(function($q) use ($search){
                $q->where('name','like',"%{$search}%")
                ->orWhere('email','like',"%{$search}%");
            });
        })->latest()->paginate(10);
        return response()->json([
            'status' => 'success',
            'data' => $admins
        ],200);
    }
    // function for login 
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



// function for logout
    public function logout(Request $request)
    {
       if($request->user()){
        $request->user()->currentAccessToken()->delete();
       }
        return response()->json(['message' => 'Logged out successfully']);
    }




// function for updating the admins detail
    public function updateProfile(Request $request){

        $admin = $request->user(); 
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'contact_no' => ['sometimes', 'string', 'max:15'],
            'address' => ['sometimes', 'string'],
            'email' => ['sometimes','email','unique:admins,email,' . $admin->id],
        ]);
        $admin->update($data);
        $admin->refresh();
        return response()->json([
            'message'=> 'Profile updated Successfully',
            'admin' => $admin],200);
    }
    //
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
class AdminAuthController extends Controller
{
    public function index(Request $request){
        $admins = Admin::query()->when($request->search, function ($query, $search){
            $query->where(function($q) use ($search){
                $q->where('name','like',"%{$search}%")
                ->orWhere('email','like',"%{$search}%");
            });
        })->latest()->paginate(10);

        $admins->getCollection()->transform(function ($admin){
            if($admin->image){
                 $admin->image = asset('storage/'. str_replace('\\','/',$admin->image));
            }
            return $admin;
        });
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


// function for changing password using old password
    public function changePassword(Request $request)
    {
        $request->validate(['old_password' => 'required',
                            'new_password' => 'required|min:6|confirmed',
        ]);
        $admin = auth()->user();
        if(!Hash::check($request->old_password, $admin->password)){
            return response()->json([
                'status' => 'error',
                'message' => 'OLD password does not match'
            ],400);
        }
        $admin->update(['password' => $request->new_password]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password changed successfully'
        ]);

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


// function for updating the profile image
    public function updateImage(Request $request)
    {
        $request->validate(['image'=> ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
    ]);
    $admin = $request->user();
    if ($request->hasFile('image')){
        if($admin->image && Storage::disk('public')->exists($admin->image)){
            Storage::disk('public')->delete($admin->image);
        }
        $path = $request->file('image')->store('admins','public');
        $admin->update(['image'=> $path]);
    }
        return response()->json(['status' => 'success', 
                                 'message' =>'Profile image updated successfully',
                                 'image_url' => asset('storage/' . $admin->image)],200);
    }


    //Delete admin logic
    public function deleteAdmin($id){
        $admin = Admin::find($id);
        if(!$admin){
            return response()->json(['message' => 'Admin not found'], 404);
        }
        if($admin->image){
            if(Storage::disk('public')->exists($admin->image)){
                Storage::disk('public')->delete($admin->image);
            }
        }
        $admin->delete();
        return response()->json(['status'=> 'success',
                                 'message'=> 'Admin deleted successfully'
        ]);
    }

}

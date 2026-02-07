<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AdminResource;


class AdminAuthController extends Controller
{
    //function for the regeistering new admin
    public function registerRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
            'contact_no' => 'required',
            'address' => 'nullable|string',
        ]);
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = $request->password;
            $admin->contact_no = $request->contact_no;
            $admin->address = $request->address;
            $admin->role = 'admin';
            $admin->status = 'pending';
            $admin->email_verified_at = null;
            $admin->save();
       
        return response()->json(['message' => 'Your application has been submitted and is waiting for Super Admin approval.'
        ],201);

    }

    //function for uploading kyc
    public function uploadKyc(Request $request)
    {
        $request->validate(['id_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',]);
        $admin = auth('admin')->user();
        if($request->kyc_status === 'verified'){
            return response()->json(['message' => 'your KYC is already verified. Contact support to change it.'], 403);
        }
        if($request->hasFile('id_proof')){
            if($admin->id_proof_path){
                Storage::disk('private')->delete($admin->id_proof_path);
            }
           $fileName = 'kyc_' . $admin->id . '_' . time() . '.' . $request->file('id_proof')->getClientOriginalExtension();
           $path = $request->file('id_proof')->storeAs('kyc_documents', $fileName, 'private');

            $admin->update([
                'id_proof_path' => $path,
                'kyc_status' => 'pending',
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'KYC document uploaded successfully. Verification is now pending.'
            ]);
        }
        return response()->json(['message' => 'File upload failed.'], 400);

    }
    // function for login 
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            if($admin->status === 'pending'){
                return response()->json(['message' => 'Access Denied. Your account status is: ' . $admin->status . '. Please wait for approval.'
            ], 403);
            }
            if ($admin->status === 'suspended') {
                 return response()->json(['message' => 'Your account has been suspended. Please contact the Super Admin.'], 403);
            }
            if($admin->email_verified_at == null){
                return response()->json(['message'=> 'Please verify your email before logging in.'],403);
            }
            $token = $admin->createToken('admin-token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'admin' => new AdminResource($admin),
            ], 200);
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }

// function for logout
    public function logout(Request $request)
    {
       if(auth('admin')->check()){
        auth('admin')->user()->currentAccessToken()->delete();
       }
        return response()->json(['message' => 'Logged out successfully']);
    }

// function for changing password using old password
    public function changePassword(Request $request)
    {
        $request->validate(['old_password' => 'required',
                            'new_password' => 'required|min:8|confirmed',
        ]);
        $admin = auth('admin')->user();
        if(!Hash::check($request->old_password, $admin->password)){
            return response()->json([
                'status' => 'error',
                'message' => 'OLD password does not match'
            ],400);
        }
        $admin->password = $request->new_password;
        $admin->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password changed successfully',
            'logged_in_as_id' => $admin->id,
            'logged_in_as_role' => $admin->role
        ]);

    }

// function for updating the admins detail
    public function updateProfile(Request $request){

        $admin = auth('admin')->user(); 
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
            'admin' => new AdminResource($admin)
        ],200);
    }


// function for updating the profile image
    public function updateImage(Request $request)
    {
        $request->validate(['image'=> ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],]);
        $admin = auth('admin')->user();
        if ($request->hasFile('image')){
            if($admin->image && Storage::disk('public')->exists($admin->image)){
                Storage::disk('public')->delete($admin->image);
            }
            $path = $request->file('image')->store('admins','public');
            $admin->update(['image'=> $path]);
        }
            return response()->json(['status' => 'success', 
                                 'message' =>'Profile image updated successfully',
                                 'image_url' => asset('storage/' . $path),
                                 'logged_in_as_id' => auth('admin')->id()
                                ],200);
    }


}

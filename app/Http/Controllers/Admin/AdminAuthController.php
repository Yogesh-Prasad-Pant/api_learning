<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AdminResource;
use Symfony\Component\HttpFoundation\StreamedResponse;


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

    //function for uploading kyc and business lisence
    public function uploadKyc(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'id_proof'         => ($admin->id_proof_path ? 'nullable' : 'required_without:business_license') . '|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'business_license' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'id_proof_type'    => ($admin->id_proof_path ? 'nullable' : 'required_with:id_proof') . '|string|max:50',
        ]);

   
        if ($admin->kyc_status !== 'rejected' && $admin->kyc_status !== 'not_submitted' && $admin->kyc_status !== null) {
            if($request->hasFile('id_proof')&& $admin->id_proof_path){
                return response()->json(['message' => "ID Proof is already {$admin->kyc_status}. Changes blocked."], 403);
            }
            if($request->hasFile('business_license') && $admin->business_license_path){
                return response()->json(['message' => "Business License is already {$admin->kyc_status}. Changes blocked."],403);
            }
        }

        $updateData = [];
        $hasChanged = false;

        if ($request->hasFile('id_proof') && $request->file('id_proof')->isValid()) {
            if ($admin->id_proof_path) {
                Storage::disk('private')->delete($admin->id_proof_path);
            }
            $fileName = 'kyc_' . $admin->id . '_' . bin2hex(random_bytes(8)) . '.' . $request->file('id_proof')->getClientOriginalExtension();
            $updateData['id_proof_path'] = $request->file('id_proof')->storeAs('kyc_documents', $fileName, 'private');
            $updateData['id_proof_type'] = $request->id_proof_type;
            $hasChanged = true;
        }

   
        if ($request->hasFile('business_license') && $request->file('business_license')->isValid()) {
            if ($admin->business_license_path) {
                Storage::disk('private')->delete($admin->business_license_path);
            }
            $fileName = 'license_' . $admin->id . '_' . bin2hex(random_bytes(8)) . '.' . $request->file('business_license')->getClientOriginalExtension();
            $updateData['business_license_path'] = $request->file('business_license')->storeAs('kyc_documents/license', $fileName, 'private');
            $hasChanged = true;
        }

  
        if ($hasChanged) {
            $updateData['kyc_status'] = 'pending'; 
            $updateData['is_verified'] = false;
            foreach($updateData as $key => $value){
                $admin->{$key} = $value;
            }
            if($admin->save()){
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Documents uploaded successfully. Verification is now pending.'
                ]);
            }else{
                return response()->json(['message' => 'Database save failed.'], 500);
            }
        }
        return response()->json(['message' => 'No new files provided.'], 400);
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

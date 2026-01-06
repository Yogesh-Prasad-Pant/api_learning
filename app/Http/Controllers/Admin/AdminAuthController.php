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
            $admin->save();
       
        return response()->json(['message' => 'Your application has been submitted and is waiting for Super Admin approval.'
        ],201);

    }

    // function for Super Admin to approve a pending account
    public function changeStatus(Request $request, $id)
    {   
        $request->validate(['status' => 'required|in:active,pending,suspended']);

        $admin = Admin::find($id);
        if(!$admin){
            return response()->json(['message' => 'Admin account not found'], 404);
        }
        if((int)auth('admin')->id() === (int)$id && $request->status !== 'active'){
            return response()->json(['message' => 'You can not suspend or deactive your own super admin account'],400);
        }
        $admin->status = $request->status;
        $admin->save();
        return response()->json([
            'status' => 'success',
            'message' => "Admin {$admin->name} is now {$request->status}.",
            'approved_by' => auth('admin')->user()->name
        ], 200);
    }

    //function for showing the admins
    public function index(Request $request)
    {
        $admins = Admin::query()
             ->when($request->search, function ($query, $search){
                $query->where(function($q) use ($search){
                    $q->where('name','like',"%{$search}%")
                    ->orWhere('email','like',"%{$search}%")
                    ->orWhere('contact_no', 'like', "%{$search}%");
                });
            })
            ->when($request->status, function ($qu,$status){
                $qu->where('status', $status);
            })
            ->latest()->paginate(10);

         
        return AdminResource::collection($admins)->additional([
            'status' => 'success',
            'search_query' => $request->search
        ]);
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
                                 'image_url' => asset('storage/' . $admin->image),
                                 'logged_in_as_id' => auth('admin')->id()
                                ],200);
    }


    //Delete admin logic
    public function deleteAdmin($id){
        $admin = Admin::find($id);
        if(!$admin){
            return response()->json(['message' => 'Admin not found'], 404);
        }
        $currentUser = auth('admin')->user();
        if($currentUser->role === 'super_admin' || (int)$currentUser->id === (int)$id){

            if($admin->image){
                if(Storage::disk('public')->exists($admin->image)){
                    Storage::disk('public')->delete($admin->image);
                }
            }
            $admin->delete();
            return response()->json(['status'=> 'success',
                                 'message'=> 'Account deleted successfully'
            ]);
        }
        return response()->json(['message' => 'Unauthorized. You can not delete other account'], 403);
        
    }

}

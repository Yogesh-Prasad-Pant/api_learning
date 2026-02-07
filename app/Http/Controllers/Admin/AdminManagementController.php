<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Resources\AdminResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminManagementController extends Controller
{
      //function for showing the admins
    public function index(Request $request)
    {
        $query = Admin:: query();
        if(auth('admin')->user()->role === 'super_admin' && $request->has('only_trashed') ){
            $query->onlyTrashed();
        }
        $admins = $query
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
        if($request->status === 'active' && $admin->email_verified_at === null){
            $admin->email_verified_at = now();
        }
        $admin->save();
        return response()->json([
            'status' => 'success',
            'message' => "Admin {$admin->name} is now {$request->status}.",
            'approved_by' => auth('admin')->user()->name
        ], 200);
    }

    //Delete admin logic Temporarly
    public function deleteAdmin(Request $request,$id = null)
    {
        $currentUser = auth('admin')->user();
        $targetId = $id ?? $currentUser->id;
        $admin = Admin::find($targetId);
        if(!$admin){
            return response()->json(['message' => 'Account not found'], 404);
        }
        
        if($currentUser->role === 'super_admin' && (int)$currentUser->id === (int)$targetId){
            return response()->json(['message' => 'Super admins can not delete themselves'], 403);  
        }

        if($currentUser->role !== 'super_admin' && (int)$currentUser->id !== (int)$targetId){
            return response()->json(['message' => 'Unauthorized. You can not delete other account'], 403);
        }

        $admin->shops()->update(['status' => 'inactive']);
        $hasActiveOrders = $admin->shops()->whereHas('orders', function($q){
            $q->whereIn('status', ['pending','processing','shipped','shipping']);
            })->exists();

        if ($hasActiveOrders) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Your shop has been taken offline to prevent new orders. However, you still have pending orders to fulfill. You can only delete your account permanently once all orders are "Delivered" or "Cancelled".'
            ], 400);
        }
        
        $admin->delete();
        if((int)$currentUser->id === (int)$targetId){
            $currentUser->tokens()->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Your account has been deactivated and you have been logged out.'
            ]);
        }
        return response()->json(['status'=> 'success',
                                 'message'=> 'Account moved to trash (soft Deleted) successfully'
            ]);    
    }

    //Delete admin permanently 
    public function forceDeleteAdmin($id){
        $admin = Admin::withTrashed()->find($id);
        if(!$admin) return response()->json(['message' => 'Admin not found'], 404);
        if(auth('admin')->user()->role !== 'super_admin') {
            return response()->json(['message' => 'Only Super Admin can Permanently delete accounts'], 403);
        }
        
       $filesToDelete = [$admin->image, $admin->id_proof_path];
        foreach ($filesToDelete as $file) {
            if ($file && Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
         }

        $admin->forceDelete();
        return response()->json(['message' => 'Admin and associated data  is permanently deleted ']);
    }

    // Restore a soft-deleted admin
    public function restoreAdmin($id){
    
        $admin = Admin::withTrashed()->find($id);
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        if (auth('admin')->user()->role !== 'super_admin') {
            return response()->json(['message' => 'Unauthorized. Only Super Admin can restore accounts'], 403);
        }
        $admin->restore();
        return response()->json([
            'status' => 'success',
            'message' => "Admin {$admin->name} has been restored successfully. Note: Shops remain 'inactive' until manually reactivated.",
            'admin' => new AdminResource($admin)
        ]);
    }



}
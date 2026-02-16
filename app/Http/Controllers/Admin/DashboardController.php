<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //function to return detail to logined user or dasboard
    public function index(Request $request)
    {
        $admin = $request->user();
        return response()->json([
            'status' => 'success',
            'message' => 'Admin Dashboard Data Fetched',
            'data' => [
                'user' => [
                    'name' => $admin->name,
                    'email'=> $admin->email,
                    'status' => $admin->status,
                ],
                'notifications' => [
                    'message' =>  $admin->kyc_status === 'verified'
                    ? 'Welcome! Your account is fully verified.'
                    : 'Action Required: Please complete your KYC.'

                ]
            ]
        ]);
    }

    //function to show superadmin control pannel
    public function superIndex()
    {
        return response()->json([
            'stats' => [
                'total_admin' => Admin::count(),
                'pending_kyc' => Admin::where('kyc_status','pending')->count(),
                'active_now' => Admin::where('status', 'active')->count(),
                'suspended' => Admin::where('status', 'suspended')->count(),
            ],
            'quick_links'=>[
                'search_admins' => url('/api/admin/list/search'),
            ]
        ]);

    }
}

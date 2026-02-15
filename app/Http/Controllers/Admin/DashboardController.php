<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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
    //
}

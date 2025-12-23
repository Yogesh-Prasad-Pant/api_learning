<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function sendResetLink(Request $request){
        $request->validate(['email'=>'required|email']);
        $admin = Admin::where('email',$request->email)->first();
        if (!$admin){
            return response()->json(['message'=>'Admin email not found.'],404);
        }
        $token = Str::random(60);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at'=>now()]
        );
        $admin->notify(new AdminResetPasswordNotification($token));
        return response()->json(['message' => 'Reset token sent to your email!']);
    }//


    public function resetPassword(Request $request){
       
        $request->validate(['email' => 'required|email',
                            'token' => 'required',
                            'password'=> 'required|min:8|confirmed',
                        ]);
        $resetData = DB::table('password_reset_tokens')
                        ->where('email', $request->email)
                        ->where('token', $request->token)
                        ->first();

        if(!$resetData){
            return response()->json(['message' => 'Invalid token or email.'],400); 
        }
        $admin = Admin::where('email', $request->email)->first();
        
            $admin->password = $request->password;
            $admin->save();
     
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return response()->json(['message'=>'Password resett sucessfully!']);

    }
}

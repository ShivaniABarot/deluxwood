<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use DB;
use Illuminate\Support\Facades\Auth;

use Hash;
class ResetPasswordController extends Controller
{
    public function edit()
    {
        $pagename = "Reset Password";
        $id = Auth::user()->id;
        $user = User::select('users.*','customer.*')->leftjoin('customer','customer.user_id','users.id')->where('id',$id)->first();

        return view('backend.reset_password.edit',compact('pagename'));
    }
    public function update(Request $request)
    {
   
       
     $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);
        $user = Auth::user();

        if (!(Hash::check($request->current_password, $user->password))) {
            return redirect()->back()->with("error","Your current password is not match with the password.");
        }

        if(strcmp($request->current_password, $request->new_password_confirmation) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }
       //dd($request->new_password, $request->new_password_confirmation);
        if(strcmp($request->new_password, $request->new_password_confirmation) == 0)
        {
            $validatedData = $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed',
                'new_password_confirmation' => ['same:new_password'],
            ]);
    
            //Change Password
            $user = Auth::user();
            $user->update(['password' => Hash::make($request->new_password)]);
           
            return redirect("admin/home");
        }
        else
        {     // New password and Condirm password are not same
            return redirect()->back()->with("error","New Password and Confirm Password are not same .");
        }
    }    
}    
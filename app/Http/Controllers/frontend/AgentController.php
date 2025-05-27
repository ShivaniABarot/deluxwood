<?php

namespace App\Http\Controllers\frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerEditProfileForm;    
use DB;


use Hash;

class AgentController  extends BaseController {
   
   
    public function view() { 
        $pagename = "Account Manager Profile ";
        $id = Auth::user()->id;
        //dd($id);
        $user = User::select('users.*','agent.*')->leftjoin('agent','agent.user_id','users.id')->where('id',$id)->first();
        //dd($user);
        
                          
		return view('frontend.agent.profile',compact('pagename','user'));
	}
	
   
}

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

class CustomerEditProfileController extends BaseController {
   
    
    public function edit() { 
        $pagename = "Customer Profile Edit";
        $id = Auth::user()->id;
        //dd($id);
        $user = User::select('users.*','customer.*')->leftjoin('customer','customer.user_id','users.id')->where('id',$id)->first();
        //dd($user);
                          
		return view('frontend.customer_edit_profile.edit',compact('pagename','user'));
	}
    public function view() { 
        $pagename = "Customer Profile Edit";
        $id = Auth::user()->id;
        //dd($id);
        $user = User::select('users.*','customer.*')->leftjoin('customer','customer.user_id','users.id')->where('id',$id)->first();
        //dd($user);
        
                          
		return view('frontend.customer_edit_profile.view',compact('pagename','user'));
	}
	
    public function update(CustomerEditProfileForm  $request,$id)
    {
        if($request->ajax()){
            return true;
        }
        if(Auth::user() != ""){
            $updated_by = Auth::user()->id;
        }else{
            $updated_by =1;
        }
        $user = User::find(Auth::user()->id); 
        $user->name = $request->company_name;
        $user->email = $request->email;
        $user->save();
       
        $customer = Customer::find($id); 
        //dd($customer);
        $customer->company_name = $request->company_name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->contact_number = $request->contact_number;
       $customer->representative_name = $request->representative_name;
         $customer->address = $request->address;
        //dd( $request->representative_name);
          if($request->logo != ""){
            $file = $request->logo;
            //dd($file);
            $extension = $file->getClientOriginalExtension();
            $filename = rand().'.'.$extension;
            
            if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
                return back()->withErrors(['logo' => 'Only JPG and PNG files are allowed.']);
            }
            //dd($filename);
            
            $file->move('public/img/companyLogo',$filename);
            $customer->company_logo=$filename;

        
        }
      
        if(Auth::user() != "")
            {  
                $customer->updated_by =Auth::user()->id ;
            }
            else
            {
                $customer->updated_by = 1 ;
            }
       if($customer->save()){
        //dd("HHHHHHHHIIIIIIIIIIIIIIIII");
        $id = Auth::user()->id;
        //dd($id);
        $user = User::select('users.*','customer.*')->leftjoin('customer','customer.user_id','users.id')->where('id',$id)->first();
        $pagename = "Customer Profile Edit";
        return view('frontend.customer_edit_profile.view',compact('pagename','user'))->with('success','Customer Profile Updated Successfully');
       }
}}

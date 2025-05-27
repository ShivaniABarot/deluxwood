<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerForm;
use App\Models\Customer;
use App\Models\User;
use App\Models\Agent;
use App\Models\StateMaster;
use App\Models\EmailAuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use Hash;
use Session;

class CustomerManagementController extends BaseController {
   
    public function downloadFile($filename)
    {
        $filePath = public_path('img/texExemptForm/' . $filename);
        
        if (file_exists($filePath)) {
            return Response::download($filePath, $filename);
        
        } else {
            abort(404, 'File not found ');
        }
    }
    public function user_ip_index() {
        $pagename = "Customer Index";
        $customers = Customer::select('customer.*','users.removed','user_ip_address.ip_address','user_ip_address.date')
                            ->leftjoin('users', 'users.id', 'customer.user_id')
                            ->leftjoin('user_ip_address', 'user_ip_address.user_id', 'customer.user_id')
                            ->where('reg_status', 'Approved')
                            ->where('removed', 'NO')->latest()->get();
        // dd($customers);
        $state = StateMaster::pluck('state_name')->toArray();
    
		return view('backend.customer_management.user_ip_index',compact('pagename','customers','state'));
	}
    public function login_date_index() {
        $pagename = "Customer Index";
        $customers = Customer::select('customer.*','users.last_login_date')->leftjoin('users', 'users.id', 'customer.user_id')->where('reg_status', 'Approved')->where('removed', 'NO')->latest()->get();
        // dd($customers);
        $state = StateMaster::pluck('state_name')->toArray();
    
		return view('backend.customer_management.login_date_index',compact('pagename','customers','state'));
	}
    public function index() {
        $pagename = "Customer Index";
        if( Auth::user()->role_id == 1)
        {
        $customers = Customer::select('customer.*','users.removed')->leftjoin('users', 'users.id', 'customer.user_id')->where('reg_status', 'Approved')->where('removed', 'NO')->latest()->get();
        }else{
            $customers = Customer::select('customer.*','users.removed')->leftjoin('users', 'users.id', 'customer.user_id')->where('reg_status', 'Approved')->where('removed', 'NO')->where('customer.agent_id', Auth::user()->id)->latest()->get();  
        }
        // $customers = Customer::select('*')->where('reg_status', 'Approved')->where('removed', 'NO')->latest()->get();
        // dd($customers);
        $state = StateMaster::pluck('state_name')->toArray();
    
		return view('backend.customer_management.index',compact('pagename','customers','state'));
	}

    public function create()
    {
        $pagename = 'Create Customer';
        $state = StateMaster::pluck('state_name')->toArray();
        // dd($stateNames);
        return view('backend.customer_management.create',compact('pagename','state'));
    }

    public function store(CustomerForm  $request){
      
        if($request->ajax()){
            return true;
        }

        $user = new User();  

        $user->name = $request->company_name;
        $user->role_id = 2;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        $randomNumber = 'D' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        while (Customer::where('dealer_number', $randomNumber)->exists()) {
            $randomNumber = 'D' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        }

        $customer = new Customer(); 
        $customer->user_id =  $user->id;
        // $customer->customer_group_id ="26";
        $customer->dealer_number =$randomNumber;
        $customer->company_name = $request->company_name;
        $customer->address = $request->address;
        $customer->representative_name = $request->representative_name;
        // $customer->showroom = $request->showroom;
        $customer->contact_number = $request->contact_number;
        // $customer->domenstic_lines = $request->domenstic_lines;
        $customer->email = $request->email;
        // $customer->import_lines = $request->import_lines;
        $customer->fax = $request->fax;
        // $customer->date_business_started = $request->date_business_started;
        // $customer->showroom_sq = $request->showroom_sq;
        // $customer->annual_cabinet_sales = $request->annual_cabinet_sales;
        $customer->city = $request->city;
        $customer->state = $request->state;
        if($request->hasfile('company_logo'))
        {
            $file = $request->file('company_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = rand().'.'.$extension;

            if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
                return back()->withErrors(['company_logo' => 'Only JPG and PNG files are allowed.']);
            }
        
            $file->move('public/img/companyLogo',$filename);
            $customer->company_logo=$filename;

        }

        $customer->owner_name = $request->owner_name;
        $customer->owner_address = $request->owner_address;
        $customer->owner_phone = $request->owner_phone;
        $customer->owner_city = $request->owner_city;
        $customer->owner_state = $request->owner_state;
        $customer->owner_zip = $request->owner_zip;
        $customer->owner_email = $request->owner_email;

        $customer->reference_com_name = $request->reference_com_name;
        $customer->reference_address = $request->reference_address;
        $customer->reference_contact_number = $request->reference_contact_number;
        $customer->reference_city = $request->reference_city;
        $customer->reference_state = $request->reference_state;
        $customer->reference_zip = $request->reference_zip;
        $customer->reference_email = $request->reference_email;
        $customer->account_type = $request->account_type;
        $customer->status = $request->status;

        $customer->tex_exempt = $request->tex_exempt;
        if($request->tex_exempt == "Yes")
        {
        $customer->tex_id = $request->tex_id;
        if($request->hasfile('tex_exempt_form'))
        {
            $file = $request->file('tex_exempt_form');
            $extension = $file->getClientOriginalExtension();
            $filename1 = rand().'.'.$extension;
            $file->move('public/img/texExemptForm',$filename1);
            $customer->tex_exempt_form=$filename1;

        }
    }
       if(Auth::user() != "")
       {  
         $customer->created_by =Auth::user()->id ;
       }else{
        $customer->created_by = 1 ;
       }

       if($customer->save()){
        return redirect('/admin/customers')->with('success','Customer Added Successfully');
       }else{
        return redirect('/admin/customers')->with('error', 'Error: Something went wrong. Please try again.');
       }
           
        }
      
    public function destroy($id)
     {
   
       $customer = Customer::find($id);   
       $user = User::find($customer->user_id);
        //    $user->delete();
        $user->removed="Yes";
        $user->email =null;
        if($user->save()){
            Session::flash('success', 'Customer deleted successfully'); 
            return response()->json(['message' => 'Customer deleted successfully']);
        }
        else
        {
            Session::flash('fail', 'Something went wrong. Please try again.'); 
            return response()->json(['message' => ' Something went wrong. Please try again.']);   
        }
         echo json_encode($json);
       
    }
    public function edit($id) {
        $pagename = "Customer Edit";
        $customer = Customer::find($id);
    
        $state = StateMaster::pluck('state_name')->toArray();
		return view('backend.customer_management.edit',compact('pagename','customer','state'));
	}
	
    public function update(CustomerForm  $request,$id){
        if($request->ajax()){
            return true;
        }
        // $randomNumber = 'D' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        // while (Customer::where('dealer_number', $randomNumber)->exists()) {
        //      $randomNumber = 'D' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        // }

        $customer = Customer::find($id); 
        $user =User::find($customer->user_id);  

        $user->name = $request->company_name;
        $user->email = $request->email;
        $user->save();
        
        // $customer->dealer_number =$randomNumber;
        $customer->company_name = $request->company_name;
        $customer->address = $request->address;
        $customer->representative_name = $request->representative_name;
        // $customer->showroom = $request->showroom;
        $customer->contact_number = $request->contact_number;
        // $customer->domenstic_lines = $request->domenstic_lines;
        $customer->email = $request->email;
        // $customer->import_lines = $request->import_lines;
        $customer->fax = $request->fax;
        // $customer->date_business_started = $request->date_business_started;
        // $customer->showroom_sq = $request->showroom_sq;
        // $customer->annual_cabinet_sales = $request->annual_cabinet_sales;
        $customer->city = $request->city;
        $customer->state = $request->state;
        if($request->hasfile('company_logo'))
        {
            $file = $request->file('company_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = rand().'.'.$extension;

            if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
                return back()->withErrors(['company_logo' => 'Only JPG and PNG files are allowed.']);
            }
        
            $file->move('public/img/companyLogo',$filename);
            $customer->company_logo=$filename;

        }

        $customer->owner_name = $request->owner_name;
        $customer->owner_address = $request->owner_address;
        $customer->owner_phone = $request->owner_phone;
        $customer->owner_city = $request->owner_city;
        $customer->owner_state = $request->owner_state;
        $customer->owner_zip = $request->owner_zip;
        $customer->owner_email = $request->owner_email;

        $customer->reference_com_name = $request->reference_com_name;
        $customer->reference_address = $request->reference_address;
        $customer->reference_contact_number = $request->reference_contact_number;
        $customer->reference_city = $request->reference_city;
        $customer->reference_state = $request->reference_state;
        $customer->reference_zip = $request->reference_zip;
        $customer->reference_email = $request->reference_email;
        $customer->account_type = $request->account_type;
        // $customer->status = $request->status;

        $customer->tex_exempt = $request->tex_exempt;
        $customer->company_note = $request->company_note;
        if($request->tex_exempt == "Yes")
        {
        $customer->tex_id = $request->tex_id;
        if($request->hasfile('tex_exempt_form'))
        {
            $file = $request->file('tex_exempt_form');
            $extension = $file->getClientOriginalExtension();
            $filename1 = rand().'.'.$extension;
            $file->move('public/img/texExemptForm',$filename1);
            $customer->tex_exempt_form=$filename1;

        }
      }

            if(Auth::user() != "")
            {  
                $customer->updated_by =Auth::user()->id ;
            }else{
                $customer->updated_by = 1 ;
            }
      

       if($customer->save()){
        return redirect('/admin/customers')->with('success','Customer updated successfully');
       }else{
        return redirect('/admin/customers')->with('error', 'Error: Something went wrong. Please try again.');
       }
           
    }
    public function view($id) {
            $pagename = "Customer View";
            $customer = Customer::find($id);
         //dd($customer);

            $state = StateMaster::pluck('state_name')->toArray();
            // dd($customers);
            return view('backend.customer_management.view',compact('pagename','customer','state'));
        }
    public function approval_view($id) {
            $pagename = "Customer Approval View";
            $customer = Customer::find($id);
            $state = StateMaster::pluck('state_name')->toArray();
            // dd($customers);
            return view('backend.customer_management.approval_view',compact('pagename','customer','state'));
        }


    public function approvals()
        {
           $pagename = "Customer Approvals";
          // $customer_details = Customer::whereIn('reg_status', ['Pending', 'Rejected'])->latest()->get();
           $customer_details = Customer::select('customer.*','users.removed')->leftjoin('users', 'users.id', 'customer.user_id')->whereIn('reg_status', ['Pending', 'Rejected'])->where('removed', 'NO')->latest()->get();
    
           // dd($customer_details);
           $agents = Agent::select('agent.*','users.id','users.name','users.email')->leftjoin('users', 'users.id', 'agent.user_id')->get();


            return view('backend.customer_management.approvals',compact('customer_details','pagename','agents'));
        }
      
    public function approve($id,$note,$pay_later,$agent_id)
    {
        $user_id = Auth::user()->id;
        $approve = Customer::find($id);

        $approve->reg_status = 'Approved';
        $approve->pay_later = $pay_later;
        $approve->agent_id = $agent_id;
        if($note != "none"){
            $approve->company_note = $note;
        }

        $approve->customer_group_id = '26';

    if ($approve->save()) {
        $data_array = [
            'email' => $approve->email,
            'customer_name' => $approve->representative_name,
            'user_id' => $user_id,
        ];

        try {
            Mail::send('email.approve', $data_array, function ($message) use ($data_array) {
                $message->from('Orders@deluxewoodexpress', 'Deluxewood Cabinetry')
                        ->to($data_array['email'])
                        ->subject('Your Platform Login is Ready!');

             $EmailLog = new EmailAuditLog();  
             $EmailLog->from = 'Orders@deluxewoodexpress';
             $EmailLog->to = $data_array['email'];
             $EmailLog->subject = 'Your Platform Login is Ready!';
             $EmailLog->user_id = $data_array['user_id'];
             $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
             $EmailLog->save();

            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        Session::flash('success', 'Customer approved successfully');
        return response()->json(['message' => 'Customer approved successfully']);
    } else {
        Session::flash('fail', 'Something went wrong. Please try again.');
        return response()->json(['message' => ' Something went wrong. Please try again.']);
    }
    }
     public function reject($id)
     {   
        $user_id = Auth::user()->id;
        $reject = Customer::find($id);
        $reject->reg_status = 'Rejected';

        $data_array = [
            'email' => $reject->email,
            'cust_name' => $reject->representative_name,
            'company_name' => $reject->company_name,
            'user_id' => $user_id,
        ];

        try {
            Mail::send('email.reject', $data_array, function ($message) use ($data_array) {
                $message->from('Orders@deluxewoodexpress', 'Deluxewood Cabinetry')
                        ->to($data_array['email'])
                        ->subject('Application Status Update: Rejected');

             $EmailLog = new EmailAuditLog();  
             $EmailLog->from = 'Orders@deluxewoodexpress';
             $EmailLog->to = $data_array['email'];
             $EmailLog->subject = 'Application Status Update: Rejected';
             $EmailLog->user_id = $data_array['user_id'];
             $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
             $EmailLog->save();
               
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        if ($reject->save()) {
            Session::flash('success', 'Customer rejected successfully');
            return response()->json(['message' => 'Customer rejected successfully']);
        } else {
            Session::flash('fail', 'Something went wrong. Please try again.');
            return response()->json(['message' => ' Something went wrong. Please try again.']);
        }
     }
     public function active($id)
     {

     $active = Customer::find($id);

     $active->status = 'Active';
    
     if($active->save())
     {
        $json = array('status' => 'success'); 
       
     
     }
     else
     {
         $json = array('status' => 'fail');   
     }
     echo json_encode($json);

      
     
  }
      public function inactive($id)
     {

     $Inactive = Customer::find($id);
     $Inactive->status = 'Inactive';
     
     if($Inactive->save())
     {
        $json = array('status' => 'success'); 
     }
     else
     {
         $json = array('status' => 'fail');   
     }
     echo json_encode($json);
     
  }
 
      
}

<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerGroupingForm;
use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\User;
use App\Models\EmailAuditLog;
use App\Models\StateMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Hash;

class CustomerGroupingController extends BaseController {
   
   public function index()
    {
        $pagename = "Customer Grouping";
        $customers_data = Customer::select('customer.*', 'customer_group.group_title')
            ->leftjoin('customer_group', 'customer_group.customer_group_id', 'customer.customer_group_id')
            ->where('reg_status', 'Approved')
            ->latest()
            ->get();

        $customer_group_type = CustomerGroup::select('group_title', 'customer_group_id')->get();
        
        return view('backend.customer_grouping.index', compact('pagename', 'customers_data', 'customer_group_type'));
    }

       public function fetchCustomers(Request $request)
    {
        
        $customer_group_id = $request->customer_group;

        $customers_data = Customer::select('customer.*', 'customer_group.group_title')
            ->leftjoin('customer_group', 'customer_group.customer_group_id', 'customer.customer_group_id')
            ->where('customer.reg_status', 'Approved')
            ->latest();
            if($request->customer_group != null)
              {
                 $customers_data->where('customer.customer_group_id',$customer_group_id);    
              }
            $customers_data =  $customers_data->get();
      
      
         $view = view('backend.customer_grouping.table_rows',['customers_data' => $customers_data])->render();

        return response()->json( array('success' => true, 'html'=>$view));
    }


    public function edit($id) {

        $pagename = "Customer Grouping Edit";
        $customer = Customer::find($id);
        $customer_group_type = CustomerGroup::select('group_title','customer_group_id')->get();

		return view('backend.customer_grouping.edit',compact('pagename','customer','customer_group_type'));
	}
	
    public function update(CustomerGroupingForm $request, $id)
    {
    if ($request->ajax()) {
        return true;
    }
    $user_id = Auth::user()->id;
    $customer_gr_type = Customer::find($id);

    $customer_gr_type->company_name = $request->company_name;
    $customer_gr_type->address = $request->address;
    $customer_gr_type->representative_name = $request->representative_name;

    $customer_gr_type->contact_number = $request->contact_number;

    $customer_gr_type->email = $request->email;
    $customer_gr_type->city = $request->city;
    $customer_gr_type->customer_group_id = $request->customer_group_id;

    // Send an email to the customer
    $customerGrp_name = CustomerGroup::select('group_title')->where('customer_group_id', $request->customer_group_id)->first();
    $Gruop_name = $customerGrp_name->group_title;

    $data_array = [
        'email' => $request->email,
        'customer_name' => $request->representative_name,
        'Gruop_name' => $Gruop_name,
        'user_id' => $user_id,
    ];

    try {
        Mail::send('email.grouping', $data_array, function ($message) use ($data_array) {
            $message->from('info@deluxewoodcabinetry.com', 'Deluxewood Cabinetry')
                    ->to($data_array['email'])
                    ->subject('Your Customer Group has been Successfully Updated');

                 $EmailLog = new EmailAuditLog();  
                 $EmailLog->from = 'info@deluxewoodcabinetry.com';
                 $EmailLog->to = $data_array['email'];
                 $EmailLog->subject = 'Your Customer Group has been Successfully Updated';
                 $EmailLog->user_id = $data_array['user_id'];
                 $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
                 $EmailLog->save();

            });
    } catch (\Exception $e) {
        dd($e->getMessage());
    }

    if (Auth::user() != "") {
        $customer_gr_type->updated_by = Auth::user()->id;
    } else {
        $customer_gr_type->updated_by = 1;
    }

    if ($customer_gr_type->save()) {
        return redirect('/admin/customer-grouping/index')->with('success', 'Customer Grouping Updated Successfully');
    } else {
        return redirect('/admin/customer-grouping/index')->with('error', 'Error: Something went wrong. Please try again.');
    }
} 
      
}

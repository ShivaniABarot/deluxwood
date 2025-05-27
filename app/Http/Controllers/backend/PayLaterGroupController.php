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

class PayLaterGroupController extends BaseController {
   
   public function index()
    {
        $pagename = "Pay Later Group List";
        $customers_data = Customer::select('customer.*')
            ->where('reg_status', 'Approved')
            //->where('pay_later', 'Yes')
            ->latest()
            ->get();

        
        return view('backend.pay_later_group.index', compact('pagename', 'customers_data'));
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

        $pagename = "Pay Later Group Edit";
        $customer = Customer::find($id);

		return view('backend.pay_later_group.edit',compact('pagename','customer'));
	}
	
    public function update(Request $request, $id)
    {
    if ($request->ajax()) {
        return true;
    }
    $user_id = Auth::user()->id;
    $customer = Customer::find($id);

    $customer->pay_later = $request->pay_later;

    // Send an email to the customer
    // $customerGrp_name = CustomerGroup::select('group_title')->where('customer_group_id', $request->customer_group_id)->first();
    // $Gruop_name = $customerGrp_name->group_title;

    // $data_array = [
    //     'email' => $request->email,
    //     'customer_name' => $request->representative_name,
    //     'Gruop_name' => $Gruop_name,
    //     'user_id' => $user_id,
    // ];

    // try {
    //     Mail::send('email.grouping', $data_array, function ($message) use ($data_array) {
    //         $message->from('postmaster@order.prodigycabinetry.com', 'Prodigy Cabinetry')
    //                 ->to($data_array['email'])
    //                 ->subject('Your Customer Group has been Successfully Updated');

    //              $EmailLog = new EmailAuditLog();  
    //              $EmailLog->from = 'postmaster@order.prodigycabinetry.com';
    //              $EmailLog->to = $data_array['email'];
    //              $EmailLog->subject = 'Your Customer Group has been Successfully Updated';
    //              $EmailLog->user_id = $data_array['user_id'];
    //              $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    //              $EmailLog->save();

    //         });
    // } catch (\Exception $e) {
    //     dd($e->getMessage());
    // }

    if (Auth::user() != "") {
        $customer->updated_by = Auth::user()->id;
    } else {
        $customer->updated_by = 1;
    }

    if ($customer->save()) {
        return redirect('/admin/pay-later-group/index')->with('success', 'Pay Later Group Updated Successfully');
    } else {
        return redirect('/admin/pay-later-group/index')->with('error', 'Error: Something went wrong. Please try again.');
    }
} 
      
}

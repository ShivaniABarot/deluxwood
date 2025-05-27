<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerGroupingForm;
use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\TaxGroup;
use App\Http\Requests\TaxGroupForm;
use App\Http\Requests\TaxGroupingForm;

use App\Models\User;
use App\Models\EmailAuditLog;
use App\Models\StateMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Hash;
use Session;

class TaxGroupController extends BaseController {
   
   public function index()
    {
        $pagename = "Tax Group";
        $tax_data = $tax_data = TaxGroup::all();
        $recordCount = TaxGroup::select('tax_group_id')->count();

        return view('backend.tax_group.index', compact('pagename', 'tax_data','recordCount'));
    }

    public function TaxGroupingIndex()
    {
        $pagename = "Tax Grouping";
        $customers_data = Customer::select('customer.*', 'customer_group.group_title')
            ->leftjoin('customer_group', 'customer_group.customer_group_id', 'customer.customer_group_id')
            ->where('reg_status', 'Approved')
            ->latest()
            ->get();

        $customer_group_type = CustomerGroup::select('group_title', 'customer_group_id')->get();
        
        return view('backend.tax_group.tax_grouping_index', compact('pagename', 'customers_data', 'customer_group_type'));
    }

    public function create()
    {
      
        $pagename = 'Tax Group Create';
     
        return view('backend.tax_group.create',compact('pagename'));

    }
    public function store(TaxGroupForm $request)
    {
        if($request->ajax()){
            return true;
         }

        $tax_group = new TaxGroup();  
        $tax_group->tax_group = $request->tax_group;
        //dd($request->tax_group);
        $tax_group->tax_rate = $request->tax_rate;
        //$tax_group->group_description = $request->tax_description;
  

        $tax_group->save();

         return redirect('admin/tax-group/index')->with('success','Tax Group Added Successfully');
           
    }

        public function destroy($id)
        {
            $tax_group = TaxGroup::find($id);
            // $taxType = TaxGroup::select('tax_group')->where('tax_group',$id)->first();
            $affectedCustomers = Customer::where('tax_group', $tax_group->tax_group)->get();
            foreach ($affectedCustomers as $customer) {
                $customer->tax_group = null;
                $customer->tax_rate = null;
                $customer->save();
            }
        
            if ($tax_group->delete()) {
                Session::flash('success', 'Tax Group deleted successfully');
                return response()->json(['message' => 'Tax Group deleted successfully']);
            } else {
                Session::flash('fail', 'Something went wrong. Please try again.');
                return response()->json(['message' => ' Something went wrong. Please try again.']);
            }
        }


        public function edit($id)
        {
          
            $pagename = 'Tax Group Edit';
            $tax_group = TaxGroup::find($id);
            return view('backend.tax_group.edit',compact('pagename','tax_group'));
    
        }

        public function update(TaxGroupForm $request,$id)
        {

            if($request->ajax())
            {
                 return true;
            }
     
            $tax_group = TaxGroup::find($id);
    
            $tax_group->tax_group = $request->tax_group;
            $tax_group->tax_rate = $request->tax_rate;
            $tax_group->save();

            // if ($request->tax_group == 'With Tax') {
            //     Customer::where('tax_group', 'With Tax')
            //         ->update(['tax_rate' => $request->tax_rate]);
            // }
            
            return redirect('admin/tax-group/index')->with('success','Tax Group Updated Successfully');
               
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


    public function TaxGredit($id) {

        $pagename = "Tax Grouping Edit";
        $customer = Customer::find($id);

        $tax_group = TaxGroup::where('tax_group', 'With Tax')->select('tax_group.*')->first();

		return view('backend.tax_group.tax_grouping_edit',compact('pagename','customer', 'tax_group'));
	}
	
    public function TaxGroupingupdate(Request $request, $id)
    {
        
    if ($request->ajax()) {
        return true;
    }
    $request->validate([
        'tax_group' => 'required|in:With Tax,Without Tax',
    ]);

    $user_id = Auth::user()->id;
    $customer_gr_type = Customer::find($id);

    $customer_gr_type->company_name = $request->company_name;
    $customer_gr_type->address = $request->address;
    $customer_gr_type->representative_name = $request->representative_name;

    $customer_gr_type->contact_number = $request->contact_number;
    $customer_gr_type->email = $request->email;
    $customer_gr_type->city = $request->city;
    $customer_gr_type->customer_group_id = $request->customer_group_id;
    $customer_gr_type->tax_group = $request->tax_group;
    if($request->tax_group == 'With Tax')
    {
        $customer_gr_type->tax_rate = $request->tax_rate;
    }
    else{
        $customer_gr_type->tax_rate = null;
    }

    // // Send an email to the customer
    // $customerGrp_name = TaxGroup::select('tax_group')->where('customer_group_id', $request->customer_group_id)->first();
    // $Gruop_name = $customerGrp_name->tax_group;

    // $data_array = [
    //     'email' => $request->email,
    //     'customer_name' => $request->representative_name,
    //     'Gruop_name' => $Gruop_name,
    //     'user_id' => $user_id,
    // ];

    // try {
    //     Mail::send('email.grouping', $data_array, function ($message) use ($data_array) {
    //         $message->from('deluxewoodc@gmail.com', 'Deluxewood Cabinetry')
    //                 ->to($data_array['email'])
    //                 ->subject('Your Customer Group has been Successfully Updated');

    //              $EmailLog = new EmailAuditLog();  
    //              $EmailLog->from = 'deluxewoodc@gmail.com';
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
        $customer_gr_type->updated_by = Auth::user()->id;
    } else {
        $customer_gr_type->updated_by = 1;
    }

    if ($customer_gr_type->save()) {
        return redirect('/admin/tax-grouping/index')->with('success', 'Tax Grouping Updated Successfully');
    } else {
        return redirect('/admin/tax-grouping/index')->with('error', 'Error: Something went wrong. Please try again.');
    }
} 
      
}

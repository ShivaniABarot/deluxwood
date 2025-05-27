<?php

namespace App\Http\Controllers\backend;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\CustomerGroup;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerGroupForm;
use Auth;
use Illuminate\Routing\Controller as BaseController;
use Session;
class CustomerGroupController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function index()
    {
      
        $pagename = 'Customer Group';
        $customer_group = CustomerGroup::select('*')->latest()->get();
     
        return view('backend.customer_group.index',compact('pagename','customer_group'));

    }
    public function create()
    {
      
        $pagename = 'Customer Group Create';
     
        return view('backend.customer_group.create',compact('pagename'));

    }

    public function store(CustomerGroupForm $request){
        if($request->ajax()){
            return true;
         }

        $customer_group = new CustomerGroup();  
        $customer_group->group_title = $request->group_title;
        $customer_group->group_dicount_percent = $request->group_discount_percent;
        $customer_group->group_description = $request->group_description;
  

        $customer_group->save();

         return redirect('admin/customer-group/index')->with('success','Customer Group Added Successfully');
           
        }
      public function destroy($id)
{
    $customer_group = CustomerGroup::find($id);

    // Find customers associated with the group and update their customer_group_id
    $affectedCustomers = Customer::where('customer_group_id', $id)->get();
    foreach ($affectedCustomers as $customer) {
        $customer->customer_group_id = null;
        $customer->save();
    }

    if ($customer_group->delete()) {
        Session::flash('success', 'Customer Group deleted successfully');
        return response()->json(['message' => 'Customer Group deleted successfully']);
    } else {
        Session::flash('fail', 'Something went wrong. Please try again.');
        return response()->json(['message' => ' Something went wrong. Please try again.']);
    }
}
         public function edit($id)
    {
      
        $pagename = 'Customer Group Edit';
        $customer_group = CustomerGroup::find($id);
     
        return view('backend.customer_group.edit',compact('pagename','customer_group'));

    }
    public function update(CustomerGroupForm $request,$id)
    { 
        if($request->ajax())
        {
             return true;
        }
 
        $customer_group = CustomerGroup::find($id);

        $customer_group->group_title = $request->group_title;
        $customer_group->group_dicount_percent = $request->group_discount_percent;
        $customer_group->group_description = $request->group_description;
 
        $customer_group->save();
 
          return redirect('admin/customer-group/index')->with('success','Customer Group Updated Successfully');
            
         }
     

}
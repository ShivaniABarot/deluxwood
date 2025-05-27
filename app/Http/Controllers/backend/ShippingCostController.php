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
use App\Models\DefaultShippingCost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Hash;

class ShippingCostController extends BaseController {
   
   public function index()
    {
        $pagename = "Shipping Cost List";
        $state = StateMaster::all();
        return view('backend.shipping_cost.index', compact('pagename', 'state'));
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

        $pagename = "Shipping Cost Edit";
        $state = StateMaster::find($id);
		return view('backend.shipping_cost.edit',compact('pagename','state'));
	}
	
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            return true;
        }
        $user_id = Auth::user()->id;
        $state = StateMaster::find($id);
        $state->curbside_shipping_cost = $request->curbside_shipping_cost;
        $state->in_house_shipping_cost = $request->in_house_shipping_cost;

        if ($state->save()) {
            return redirect('/admin/shipping-cost/index')->with('success', 'Shipping Cost Updated Successfully');
        } else {
            return redirect('/admin/shipping-cost/index')->with('error', 'Error: Something went wrong. Please try again.');
        }
    } 
    public function edit_default_shipping_cost() {

        $pagename = "Default Shipping Cost Edit";
        $id="1";
        $DefaultShippingCost = DefaultShippingCost::find($id);
		return view('backend.shipping_cost.default_shipping_cost',compact('pagename','DefaultShippingCost'));
	}
	
    public function update_default_shipping_cost(Request $request)
    {
        if ($request->ajax()) {
            return true;
        }
        $user_id = Auth::user()->id;
        $id="1";
        $DefaultShippingCost = DefaultShippingCost::find($id);
        $DefaultShippingCost->curbside_shipping_cost = $request->curbside_shipping_cost;
        $DefaultShippingCost->in_house_shipping_cost = $request->in_house_shipping_cost;
        
        if (Auth::user() != "") {
            $DefaultShippingCost->updated_by = Auth::user()->id;
        } else {
            $DefaultShippingCost->updated_by = 1;
        }

        if ($DefaultShippingCost->save()) {
            return redirect('/admin/shipping-cost/index')->with('success', 'Default Shipping Cost Updated Successfully');
        } else {
            return redirect('/admin/shipping-cost/index')->with('error', 'Error: Something went wrong. Please try again.');
        }
    } 

      
}

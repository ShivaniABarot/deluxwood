<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\ItemForm;
use App\Models\ProductMaster;
use App\Models\ProductItem;
use App\Models\ItemDimensions;
use App\Models\ProductItemFinishSide;
use App\Models\ProductItemHingeSide;
use App\Models\ItemCutDepth;
use App\Models\ItemModification;
use App\Models\ItemAccessories;
use App\Models\Addmodification;
use App\Models\Accessories;
use App\Models\CustomerDraftStyle;
use App\Models\ProductCategory;
use App\Models\DoorStyle;
use App\Models\CustomerDraft;
use App\Models\ProductDoorStyle;
use App\Models\EmailAuditLog;
use App\Models\DraftProduct;
use App\Models\Customer;
use App\Models\StateMaster;
use App\Models\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Hash;
use DB;
use Session;


class ProcessManagementController extends BaseController {
   
    public function index() {
        $pagename = "Process Management";
        $status = ["Quotation","Inprogress","Ready","In Production","Delivered","Return"];

        // $customer_orders = DB::table('customer_draft')
        // ->leftJoin('customer', 'customer.user_id', '=', 'customer_draft.customer_id')
        // ->select('customer_draft.*', 'customer.representative_name')
        // ->whereIn('draft_status', $status)
        // ->latest()
        // ->get();
            
        if( Auth::user()->role_id == 1)
        {
       $customer_orders = CustomerDraft::select('customer.company_name','customer.company_note','customer.tax_group','customer.agent_id','customer_draft.original_price','customer_draft.customer_draft_id','customer_draft.draft_status','customer_draft.order_date','customer_draft.payment_method',
          DB::raw('GROUP_CONCAT(door_style.name) as door_style_names'))
         ->leftJoin('customer', 'customer.user_id', '=', 'customer_draft.customer_id')
         ->leftJoin('customer_draft_style', 'customer_draft_style.customer_draft_Id', '=', 'customer_draft.customer_draft_id')
         ->leftJoin('door_style', 'door_style.doorStyle_id', '=', 'customer_draft_style.door_style_Id')
         ->whereIn('draft_status', $status)
         ->groupBy('customer.company_name','customer.company_note','customer.tax_group','customer.agent_id','customer_draft.original_price', 'customer_draft.customer_draft_id', 'customer_draft.draft_status','customer_draft.order_date','customer_draft.payment_method')
         ->get();
//     $customer_orders_count = CustomerDraft::select('customer.company_name', 'customer.company_note', 'customer.tax_group', 'customer.agent_id', 'customer_draft.original_price', 'customer_draft.customer_draft_id', 'customer_draft.draft_status', 'customer_draft.order_date', 'customer_draft.payment_method', DB::raw('GROUP_CONCAT(door_style.name) as door_style_names'))
//     ->leftJoin('customer', 'customer.user_id', '=', 'customer_draft.customer_id')
//     ->leftJoin('customer_draft_style', 'customer_draft_style.customer_draft_Id', '=', 'customer_draft.customer_draft_id')
//     ->leftJoin('door_style', 'door_style.doorStyle_id', '=', 'customer_draft_style.door_style_Id')
//     // ->whereIn('draft_status', $status)
//     ->whereNull('customer_draft.ship_state') // Adding the whereNull condition
//     ->groupBy('customer.company_name', 'customer.company_note', 'customer.tax_group', 'customer.agent_id', 'customer_draft.original_price', 'customer_draft.customer_draft_id', 'customer_draft.draft_status', 'customer_draft.order_date', 'customer_draft.payment_method')
//     ->get()
//     ->count(); // Get the count of the data

// dd($customer_orders_count);
        }else{
           $customer_orders = CustomerDraft::select('customer.company_name','customer.company_note','customer.tax_group','customer.agent_id','customer_draft.original_price','customer_draft.customer_draft_id','customer_draft.draft_status','customer_draft.order_date','customer_draft.payment_method',
           DB::raw('GROUP_CONCAT(door_style.name) as door_style_names'))
          ->leftJoin('customer', 'customer.user_id', '=', 'customer_draft.customer_id')
          ->leftJoin('customer_draft_style', 'customer_draft_style.customer_draft_Id', '=', 'customer_draft.customer_draft_id')
          ->leftJoin('door_style', 'door_style.doorStyle_id', '=', 'customer_draft_style.door_style_Id')
          ->where('customer.agent_id', Auth::user()->id)
          ->whereIn('draft_status', $status)
          ->groupBy('customer.company_name','customer.company_note','customer.tax_group','customer.agent_id','customer_draft.original_price', 'customer_draft.customer_draft_id', 'customer_draft.draft_status','customer_draft.order_date','customer_draft.payment_method')
          ->get();

        }
          // dd($customer_orders);
        $statuses = [
            "Quotation" => "Quotation",
            "Inprogress" => "In Progress", 
            "Ready" => "Ready",
            "In Production" => "In Production",
            "Delivered" => "Delivered",
            "Return" => "Return"
        ];
        $agents = Agent::select('agent.*','users.name','users.email')->leftjoin('users', 'users.id', 'agent.user_id')->get();
    
    
      return view('backend.process_manage.index',compact('pagename','customer_orders','statuses','agents'));
    }
    public function agent_index($id){
        $pagename = "Process Management";
        $status = ["Quotation","Inprogress","Ready","In Production","Delivered","Return"];
        $customer_orders = CustomerDraft::select('customer.company_name','customer.company_note','customer.tax_group','customer.agent_id','customer_draft.original_price','customer_draft.customer_draft_id','customer_draft.draft_status','customer_draft.order_date','customer_draft.payment_method','customer_draft.customer_id',
        DB::raw('GROUP_CONCAT(door_style.name) as door_style_names'))
       ->leftJoin('customer', 'customer.user_id', '=', 'customer_draft.customer_id')
       ->leftJoin('customer_draft_style', 'customer_draft_style.customer_draft_Id', '=', 'customer_draft.customer_draft_id')
       ->leftJoin('door_style', 'door_style.doorStyle_id', '=', 'customer_draft_style.door_style_Id')
       ->where('customer_draft.customer_id',$id)
       ->where('customer.agent_id', Auth::user()->id)
       ->whereIn('draft_status', $status)
       ->groupBy('customer.company_name','customer.company_note','customer.tax_group','customer.agent_id','customer_draft.original_price', 'customer_draft.customer_draft_id', 'customer_draft.draft_status','customer_draft.order_date','customer_draft.payment_method','customer_draft.customer_id')
       ->get();
       $statuses = [
        "Quotation" => "Quotation",
        "Inprogress" => "In Progress", 
        "Ready" => "Ready",
        "In Production" => "In Production",
        "Delivered" => "Delivered",
        "Return" => "Return"
    ];
    $agents = Agent::select('agent.*','users.name','users.email')->leftjoin('users', 'users.id', 'agent.user_id')->get();
    return view('backend.process_manage.index',compact('pagename','customer_orders','statuses','agents'));
    }

     public function destroy($id){
        
        $customer_draft=CustomerDraft::find($id);
         CustomerDraftStyle::where('customer_draft_Id',$id)->delete();
         DraftProduct::where('customer_draft_Id',$id)->delete();
        if($customer_draft->delete()){
     
             Session::flash('success', 'Order deleted successfully'); 
            return response()->json(['message' => 'Order deleted successfully']);
        }
        else
        {
             Session::flash('fail', 'Something went wrong. Please try again.'); 
            return response()->json(['message' => ' Something went wrong. Please try again.']); 
        }
       
         echo json_encode($json);
    }
    
    public function update(Request $request, $id)
    {

        if ($request->ajax()) {
            return true;
        }
        
        if (Auth::user() != "") {
            $updated_by = Auth::user()->id;
        } else {
            $updated_by = 1;
        }
     
        $user_id = Auth::user()->id;
        $CustomerDraft = CustomerDraft::find($id);
        $previousStatus = $CustomerDraft->draft_status;

        $CustomerDraft->draft_status = $request->Status;
        $CustomerDraft->return_approval = $request->return_approval;
        $CustomerDraft->estimated_time = $request->estimated_time;
        $CustomerDraft->save();
        


        if ($previousStatus !== $request->Status) {
        // Status has changed, send an email notification
        $statusmailData = Customer::select('customer.representative_name', 'customer.email', 'customer_draft.estimated_time','customer_draft.customer_draft_Id','customer_draft.created_at')
            ->leftJoin('customer_draft', 'customer_draft.customer_id', 'customer.user_id')
            ->where('customer_draft.customer_draft_Id', $id)
            ->first();

        $data_array = [
            'email' => $statusmailData->email,
            'customer_name' => $statusmailData->representative_name,
            'new_status' => $request->Status,
            'order_number' => $statusmailData->customer_draft_Id,
            'order_date' => $statusmailData->created_at,
            'user_id' => $user_id,
        ];

            try {
                Mail::send('email.process_status_change', $data_array, function ($message) use ($data_array) {
                    $message->from('Orders@deluxewoodexpress', 'Deluxewood Cabinetry')
                        ->to($data_array['email'])
                         ->subject('Update on Your Order #' . $data_array['order_number']);

                 $EmailLog = new EmailAuditLog();  
                 $EmailLog->from = 'Orders@deluxewoodexpress';
                 $EmailLog->to = $data_array['email'];
                 $EmailLog->subject = 'Update on Your Order #' . $data_array['order_number'];
                 $EmailLog->user_id = $data_array['user_id'];
                 $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
                 $EmailLog->save();

                });
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        $mailData = Customer::select('customer.representative_name', 'customer.email','customer_draft.estimated_time')
        ->leftJoin('customer_draft','customer_draft.customer_id','customer.user_id')
        ->where('customer_draft.customer_draft_Id', $id)
        ->first();

       if ($request->return_approval === 'Yes') {
           
            $data_array = [
                'email' => $mailData->email,
                'customer_name' => $mailData->representative_name,
                'estimated_time' => $mailData->estimated_time,
                'user_id' => $user_id,
            ];

            try {
                Mail::send('email.replace_order', $data_array, function ($message) use ($data_array) {
                    $message->from('Orders@deluxewoodexpress', 'Deluxewood Cabinetry')
                        ->to($data_array['email'])
                        ->subject('Your Item Replacement Request: Approved');

                 $EmailLog = new EmailAuditLog();  
                 $EmailLog->from = 'Orders@deluxewoodexpress';
                 $EmailLog->to = $data_array['email'];
                 $EmailLog->subject = 'Your Item Replacement Request: Approved';
                 $EmailLog->user_id = $data_array['user_id'];
                 $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
                 $EmailLog->save();

                });
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } elseif ($request->return_approval === 'No') {
           
            $data_array = [
                'email' => $mailData->email,
                'customer_name' => $mailData->representative_name,
                'user_id' => $user_id,
                
            ];

            try {
                Mail::send('email.replace_order_reject', $data_array, function ($message) use ($data_array) {
                    $message->from('Orders@deluxewoodexpress', 'Deluxewood Cabinetry')
                        ->to($data_array['email'])
                        ->subject('Update on Your Item Replacement Request');

                     $EmailLog = new EmailAuditLog();  
                     $EmailLog->from = 'Orders@deluxewoodexpress';
                     $EmailLog->to = $data_array['email'];
                     $EmailLog->subject = 'Update on Your Item Replacement Request';
                     $EmailLog->user_id = $data_array['user_id'];
                     $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
                     $EmailLog->save();

                });
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        
        return redirect('admin/process-manage')->with('success', 'Updated Successfully');
    }
      
        public function view($id) {

            $pagename = "View Process";
            $customerDraftId = $id; 
            $customer_draft_Id = $id; 
            $customer_draft = CustomerDraft::where('customer_draft_id',$id)->first();
            $cus_id = Customer::select('user_id')->where('user_id',$customer_draft->customer_id)->first();
            $taxGroup = Customer::select('tax_group','tax_rate')->where('user_id',$cus_id->user_id)->first();
            $product_master = ProductMaster::all();
            $state = StateMaster::select('state_name')->where('state_id',$customer_draft->state)->first();
            $ship_state = StateMaster::select('state_name')->where('state_id',$customer_draft->ship_state)->first();
            $user = DB::table('customer')->where('user_id',$customer_draft->customer_id)->first();
            $user_id = Auth::user()->id;
            
            $customerDraftStyles = CustomerDraftStyle::where('customer_draft_id', $customerDraftId)
            ->get();
            
            $products = [];

            foreach ($customerDraftStyles as $customerDraftStyle) {
            $products[$customerDraftStyle->door_style_Id] = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
            ->leftJoin('product_item_hinge_side', 'draft_product.product_id', '=', 'product_item_hinge_side.product_id')
            ->leftJoin('product_item_finish_side', 'draft_product.product_id', '=', 'product_item_finish_side.product_id')
            ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
            ->leftJoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
            ->leftJoin('door_style','door_style.doorStyle_id','=','customer_draft_style.door_style_Id')
            ->where('draft_product.customer_draft_id', $customerDraftId)
            ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
            ->where('draft_product.customer_id', $cus_id->user_id)
            ->select('draft_product.*','product_master.*',
                     'product_item.product_item_sku as product_item_sku',
                     'product_item.description as product_description','product_item.hinge_side as is_hinge_side','product_item.finish_side as is_finish_side','product_item.product_item_price as product_item_price',
                     'product_item.cut_depth', 'product_item.cut_depth_price','door_style.name','door_style.image',
                     'product_item_hinge_side.right_hinge_side_price', 'product_item_hinge_side.left_hinge_side_price', 'product_item_hinge_side.hinge_side_none',
                     'product_item_finish_side.right_finish_side_price','product_item_finish_side.left_finish_side_price','product_item_finish_side.both_finish_side_price','product_item_finish_side.finish_side_none','customer_draft_style.draft_style_id')
            ->orderBy('draft_product.created_at', 'desc')
            ->get();

             foreach ($products[$customerDraftStyle->door_style_Id] as $product) {
                $modificationNames = DraftProduct::leftJoin('draft_product_modification', 'draft_product_modification.draft_product_id', '=', 'draft_product.draft_product_id')
                    ->leftJoin('modificationmaster', 'modificationmaster.modification_id', '=', 'draft_product_modification.modification_id')
                    ->leftJoin('item_modification', function($join) use ($product) {
                        $join->on('item_modification.modification_id', '=', 'draft_product_modification.modification_id')
                            ->where('item_modification.product_id', '=', $product->product_id);
                    })
                    ->leftJoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
                    ->where('draft_product.customer_draft_id', $customer_draft_Id)
                    ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
                    ->where('draft_product.customer_id', $cus_id->user_id)
                    ->select(
                        'draft_product.draft_product_id',
                        'modificationmaster.modification_nm as modification_nm',
                        'item_modification.modification_price'
                    )
                    ->get()
                    ->groupBy('draft_product_id');
                $accessoriesNames = DraftProduct::leftJoin('draft_product_accessories', 'draft_product_accessories.draft_product_id', '=', 'draft_product.draft_product_id')
                    ->leftJoin('accessoriesmaster', 'accessoriesmaster.accessories_id', '=', 'draft_product_accessories.accessories_id')
                    ->leftJoin('item_accessories', function ($join) use ($product) {
                        $join->on('item_accessories.accessories_id', '=', 'draft_product_accessories.accessories_id')
                            ->where('item_accessories.product_id', '=', $product->product_id);
                    })
                    ->leftJoin('customer_draft_style', 'customer_draft_style.draft_style_id', '=', 'draft_product.draft_style_id')
                    ->where('draft_product.customer_draft_id', $customer_draft_Id)
                    ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
                    ->where('draft_product.customer_id', $cus_id->user_id)
                    ->select(
                        'draft_product.draft_product_id',
                        'accessoriesmaster.accessories_nm as accessories_nm',
                        'item_accessories.accessories_price'
                    )
                    ->get()
                    ->groupBy('draft_product_id');

                 $product->modification_nm = $modificationNames->get($product->draft_product_id, []);
                 $product->accessories_nm = $accessoriesNames->get($product->draft_product_id, []);
              }

           
            foreach ($products[$customerDraftStyle->door_style_Id] as $item) {
                
            $cut_depthIdExists = DB::table('item_cut_depth')
            ->where('product_id', $item->product_id)
            ->exists();
            // dd($cut_depthIdExists);
            $item->cutdepth_id_exists = $cut_depthIdExists;
            // dd($item->cutdepth_id_exists);
            $selectedCutDepth = DraftProduct::select('selected_cut_depth','draft_product_id as cut_depth_draft_id')
                ->where('customer_draft_Id', $customer_draft_Id)
                ->get();

            $item->selectedcut_depth = $selectedCutDepth;
                
            if ($cut_depthIdExists) {
                $item->cut_depth_info = DB::table('item_cut_depth')
                    ->select('item_depth_id', 'depth_name_inch','product_id')
                    ->where('product_id', $item->product_id)
                    ->get();
             }
            }
             $pdf_data = CustomerDraft::select('customer.company_name','customer.representative_name','customer.address as customer_address','customer.contact_number as customer_no','customer.email','customer_draft.client_name','customer_draft.address as client_address','customer_draft.contact_no as client_no','customer_draft.po_number','customer_draft.service_type','customer_draft.designer','customer_draft.configuration','customer_draft.created_at','customer_draft.ship_name','customer_draft.ship_email','customer_draft.ship_contact_no','customer_draft.ship_address','customer_draft.ship_city','customer_draft.ship_zip_code','state_master.state_name as ship_state')
            ->leftjoin('customer','customer.user_id','customer_draft.customer_id')
            ->leftjoin('state_master','state_master.state_id','customer_draft.ship_state')
            ->where('customer_draft.customer_draft_id',$customer_draft_Id)
            ->first();
        }
            $draft_product  = DraftProduct::leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
                              ->leftJoin('product_item', 'product_item.product_id', '=', 'draft_product.product_id')
                              ->select('draft_product.*','product_master.product_name','product_item.product_item_sku')
                              ->where('customer_draft_id',$customerDraftId)->get();
    
            $draft_status = CustomerDraft::where('customer_draft_id', $customerDraftId)->first();

            $draft_seen = CustomerDraft::find($customerDraftId);
            if ($draft_seen) {
                $draft_seen->is_seen = '1';
                $draft_seen->save();
            }

            $statuses = [
                "Quotation" => "Quotation",
                "Inprogress" => "In Progress", 
                "Ready" => "Ready",
                "In Production" => "In Production",
                "Delivered" => "Delivered",
                // "Return" => "Return"
            ];   
            $newdata_arr = $products;
          $without_arr = $products;        
            return view('backend.process_manage.view',compact('pagename','id','product_master','user','draft_status','statuses' ,'draft_product','customer_draft','state','products','without_arr','newdata_arr','pdf_data','customer_draft_Id','taxGroup','ship_state'));
         }
}

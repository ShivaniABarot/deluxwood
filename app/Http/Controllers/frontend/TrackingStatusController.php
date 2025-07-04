<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreditcardForm;
use App\Models\CustomerDraft;
use App\Models\DraftProduct;
use App\Models\Customer;
use DB;
use Illuminate\Support\Facades\Auth;
Use App\Models\CustomerDraftStyle;
use App\Models\StateMaster;
use App\Models\SalesTax;
use App\Models\CustomerGroup;
use App\Models\DoorStyle;
use App\Http\Requests\CheckoutForm;
use App\Http\Requests\ShippingInformationForm;

class TrackingStatusController extends Controller
{
    public function index()
    {
        $pagename = "Tarcking Status";
        $validStatuses = ['Quotation', 'Inprogress', 'Ready', 'In Production', 'Delivered', 'Return'];
        $user = Auth::user()->id;
        
       $tracking_data = DB::table('customer_draft')->select('customer_draft.po_number','customer.representative_name','customer_draft.customer_draft_id','customer_draft.draft_status',
            DB::raw('GROUP_CONCAT(door_style.name) as door_style_names'))
            ->leftJoin('customer', 'customer.user_id', '=', 'customer_draft.customer_id')
            ->leftJoin('customer_draft_style', 'customer_draft_style.customer_draft_Id', '=', 'customer_draft.customer_draft_id')
            ->leftJoin('door_style', 'door_style.doorStyle_id', '=', 'customer_draft_style.door_style_Id')
            ->where('customer_draft.customer_id', $user)
            ->whereIn('draft_status', $validStatuses)
            ->groupBy('customer_draft.po_number','customer.representative_name', 'customer_draft.customer_draft_id', 'customer_draft.draft_status')
            ->get();


          return view('frontend.tracking_status.index',compact('tracking_data','pagename'));
    } 
    public function fetchStyles(Request $request)
    {
        $selectedStatus = $request->input('draft_status');
        $validStatuses = ['Quotation', 'Inprogress', 'Ready', 'In Production', 'Delivered', 'Return'];
        $user = Auth::user()->id;
        $tracking_data = DB::table('customer_draft')->select('customer.representative_name','customer_draft.customer_draft_id','customer_draft.draft_status',
           DB::raw('GROUP_CONCAT(door_style.name) as door_style_names'))
          ->leftJoin('customer', 'customer.user_id', '=', 'customer_draft.customer_id')
          ->leftJoin('customer_draft_style', 'customer_draft_style.customer_draft_Id', '=', 'customer_draft.customer_draft_id')
          ->leftJoin('door_style', 'door_style.doorStyle_id', '=', 'customer_draft_style.door_style_Id')
          ->where('customer_draft.customer_id', $user)
          ->whereIn('draft_status', $validStatuses)
          ->when($selectedStatus, function ($query) use ($selectedStatus) {
            return $query->where('draft_status', $selectedStatus);
            })
          ->groupBy('customer.representative_name', 'customer_draft.customer_draft_id', 'customer_draft.draft_status')
          ->get();
        
         $view = view('frontend.tracking_status.table_rows',['tracking_data' => $tracking_data])->render();

        return response()->json( array('success' => true, 'html'=>$view));
    }

    public function draft_total($id)
    {
        $total_price = 0;
        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
        $user = Auth::user()->id;
        $taxGroup = Customer::select('tax_group', 'tax_rate')->where('user_id', $user)->first();
        // $taxRate = TaxGroup::pluck('tax_rate')->first();
        $taxRate = SalesTax::where('zip_code', '6516')->value('tax_rate');

        $product = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
            ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
            ->leftJoin('customer_draft_style', 'draft_product.draft_style_id', '=', 'customer_draft_style.draft_style_id')
            ->where('draft_product.customer_draft_id', $id)
            ->where('is_shipping_cost', "No")
            ->select(
                'draft_product.*',
                'product_master.*',
                'customer_draft_style.configuration as door_style_configuration',
                'product_item.description as product_description',
                'product_item.hinge_side as is_hinge_side',
                'product_item.finish_side as is_finish_side',
                'product_item.product_item_price as product_item_price',
                'product_item.cut_depth',
                'product_item.cut_depth_price'
            )
            ->get();
        $draft_style_id = "";
        foreach ($product as $data) {
            $grup_discount = Customer::select('customer_group.group_dicount_percent')
                ->leftJoin('customer_group', 'customer_group.customer_group_id', 'customer.customer_group_id')
                ->where('customer.user_id', $user)
                ->first();
            $price = $data->product_item_price;

            $hinge_price = DB::table('product_item_hinge_side')->where('product_id', $data->product_id)->first();
            if ($hinge_price !== null) {
                if ($data->hinge_side == "L") {
                    $price += $hinge_price->left_hinge_side_price;
                } elseif ($data->hinge_side == "R") {
                    $price += $hinge_price->right_hinge_side_price;
                } elseif ($data->hinge_side == "B") {
                    $price += $hinge_price->both_hinge_side_price;
                }
            }
            $finish_price = DB::table('product_item_finish_side')->where('product_id', $data->product_id)->first();
            if ($finish_price !== null) {
                if ($data->finish_side == "L") {
                    $price = $price + $finish_price->left_finish_side_price;
                } elseif ($data->finish_side == "R") {
                    $price = $price + $finish_price->right_finish_side_price;
                } elseif ($data->finish_side == "B") {
                    $price = $price + $finish_price->both_finish_side_price;
                }
            }

            $DoorStylePrice = DraftProduct::selectRaw('SUM(product_door_style.doorstyle_price ) AS total_doorstyle_price')
                ->where('draft_product.draft_product_id', $data->draft_product_id)
                ->where('is_shipping_cost', "No")
                ->join('customer_draft_style', 'draft_product.draft_style_id', '=', 'customer_draft_style.draft_style_id')
                ->join('product_door_style', function ($join) {
                    $join->on('customer_draft_style.door_style_Id', '=', 'product_door_style.door_style_id')
                        ->on('draft_product.product_id', '=', 'product_door_style.product_id');
                })->value('total_doorstyle_price');

            $ModificationPrice = DraftProduct::selectRaw('SUM(item_modification.modification_price ) AS total_modification_price')
                ->where('draft_product.draft_product_id', $data->draft_product_id)
                ->where('is_shipping_cost', "No")
                ->join('draft_product_modification', 'draft_product.draft_product_id', '=', 'draft_product_modification.draft_product_id')
                ->join('item_modification', function ($join) {
                    $join->on('draft_product_modification.modification_id', '=', 'item_modification.modification_id')
                        ->on('draft_product.product_id', '=', 'item_modification.product_id');
                })->value('total_modification_price');

            $AccessoriesPrice = DraftProduct::selectRaw('SUM(item_accessories.accessories_price ) AS total_accessories_price')
                ->where('draft_product.draft_product_id', $data->draft_product_id)
                ->where('is_shipping_cost', "No")
                ->join('draft_product_accessories', 'draft_product.draft_product_id', '=', 'draft_product_accessories.draft_product_id')
                ->join('item_accessories', function ($join) {
                    $join->on('draft_product_accessories.accessories_id', '=', 'item_accessories.accessories_id')
                        ->on('draft_product.product_id', '=', 'item_accessories.product_id');
                })->value('total_accessories_price');

            if ($data->cut_depth == "Yes" && $data->is_cut_depth == "Yes") {
                $price = $price + $data->cut_depth_price;
            }

            $sumOfProductPrice = DB::table('item_dimensions')->where('product_id', $data->product_id)->sum('item_price');

            $price = $price + $sumOfProductPrice;
            $price = $price + $ModificationPrice + $AccessoriesPrice + $DoorStylePrice;
            $sub_total = $price * $data->quantity;

            $total = $sub_total;

            $unassembled_discount = UnassembledDiscount::find(1);
            if ($data->door_style_configuration == "Unassembled") {
                $configurationDiscount = $sub_total * ($unassembled_discount->unassembled_discount / 100);

                $total -= $configurationDiscount;
            }

            $groupDiscount = $total * ($customer_draft->discount / 100);
            $total -= $groupDiscount;
            $shipping_cost = $state = StateMaster::find($customer_draft->ship_state);
            $DefaultShippingCost = DefaultShippingCost::find('1');

            $shippingCost = 0;
            if ($customer_draft->service_type == "Curbside Delivery") {
                // $shippingCost = 250;
                if ($shipping_cost->curbside_shipping_cost != 0) {
                    $shippingCost = $shipping_cost->curbside_shipping_cost;
                } else {

                    $shippingCost = $DefaultShippingCost->curbside_shipping_cost;

                }
            } elseif ($customer_draft->service_type == "In-house Delivery") {
                // $shippingCost = 250;
                if ($shipping_cost->in_house_shipping_cost != 0) {
                    $shippingCost = $shipping_cost->in_house_shipping_cost;
                } else {
                    $shippingCost = $DefaultShippingCost->in_house_shipping_cost;
                }
            }

            $total += $shippingCost; // Add cart Final total Match 
            //dd($price);

            $draft_product = DraftProduct::find($data->draft_product_id);
            $draft_product->unit_price = $price;
            $draft_product->sub_total_price = $sub_total;
            // $additionalGroupDiscount_unit = $price * ($grup_discount->group_dicount_percent / 100);


            $unassembled_discount = UnassembledDiscount::find(1);
            if ($data->door_style_configuration == "Unassembled") {
                $configurationDiscount_unit = $price * ($unassembled_discount->unassembled_discount / 100);

                $price -= $configurationDiscount_unit;

            }
            $unit_discount = $price * ($customer_draft->discount / 100);
            $price -= $unit_discount;



            if ($taxGroup->tax_group == "With Tax") {
                if ($customer_draft->service_type == "Self Pickup") {
                    $taxGroupDiscount = $price * ($taxRate / 100);
                } elseif ($customer_draft->service_type == "Curbside Delivery") {
                    $taxRate = null;
                    $stateTax = DB::table('state_tax')->where('state_tax_id', $customer_draft->ship_state)->first();
                    $taxRate = $stateTax->tax_rate;
                    $taxGroupDiscount = $price * ($taxRate / 100);
                } else {
                    $taxRate = null;
                    $stateTax = DB::table('state_tax')->where('state_tax_id', $customer_draft->ship_state)->first();
                    $taxRate = $stateTax->tax_rate;
                    $taxGroupDiscount = $price * ($taxRate / 100);
                }

                $used_coupon = DB::table('used_coupon_history')->leftJoin('coupon_master', 'coupon_master.coupon_id', '=', 'used_coupon_history.coupon_id')->select('coupon_master.coupon_name', 'coupon_master.discount_type', 'used_coupon_history.*')->where('draft_id', $id)->get();
                if ($used_coupon != null) {
                    foreach ($used_coupon as $used_coupon) {
                        if ($used_coupon->discount_type == "Percentage") {
                            $couponDiscount = $price * ($used_coupon->discount / 100);
                            $price -= $couponDiscount;
                        } else {
                            $price -= $used_coupon->discount;

                        }

                    }
                }
                $draft_product->withoutTax_unit_price = $price;
                $price += $taxGroupDiscount;
            }


            $draft_product->final_unit_price = $price;
            $draft_product->total_price = $total;

            $draft_product->save();
            $total_price += $price;


        }
        $draft_product = DraftProduct::where('customer_draft_Id', $id)->where('is_shipping_cost', 'Yes')->first();

        //$shippingCost= $draft_product->final_unit_price;
        if ($total_price != 0) {
            $total_price += $draft_product->final_unit_price;
        }

        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
        $customer_draft->tax_rate = $taxRate;
        $customer_draft->total_price = $total_price;
        // $customer_draft->original_price =$original_price;
        $customer_draft->save();

        $responseArray = array(

            'message' => "Done"
        );
        // return $responseArray;
        //     dd($responseArray);
        return response()->json($responseArray);

    }

    public function view($id)
    {
        $pagename = "Tarcking Status View";
        $customer_draft = DB::table('customer_draft')->where('customer_draft_id',$id)->first();
        $draft_product = DraftProduct::where('customer_draft_Id', $id)->where('is_shipping_cost','Yes')->first();
        $shippingCost= $draft_product->final_unit_price;
        $total = DB::table('customer_draft')->select('total_price','original_price')->where('customer_draft_id',$id)->first();
        $user = Auth::user()->id;
        $customerDraftId = $id; 
        $taxGroup = Customer::select('tax_group','tax_rate')->where('user_id',$user)->first();
        $taxRate  = SalesTax::where('zip_code', '6516')->value('tax_rate');
        $grup_discount = Customer::select('customer_group.group_dicount_percent')
       ->leftJoin('customer_group','customer_group.customer_group_id','customer.customer_group_id')
       ->where('customer.user_id',$user)
       ->first();
       $customerDraftStyles = CustomerDraftStyle::where('customer_draft_id', $customerDraftId)
       ->get();
        // $customerDraftStyles = DB::table('customer_draft_style')
        //     ->where('customer_draft_id', $customerDraftId)
        //     ->get();
        $products = [];

        foreach ($customerDraftStyles as $customerDraftStyle) {
            $products[$customerDraftStyle->door_style_Id] =  DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
            ->leftJoin('product_item_hinge_side', 'draft_product.product_id', '=', 'product_item_hinge_side.product_id')
            ->leftJoin('product_item_finish_side', 'draft_product.product_id', '=', 'product_item_finish_side.product_id')
            ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
            ->leftJoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
            ->leftJoin('door_style','door_style.doorStyle_id','=','customer_draft_style.door_style_Id')
            ->where('draft_product.customer_draft_id', $customerDraftId)
            ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
            ->where('draft_product.customer_id', $user)
            ->select('draft_product.*','product_master.*',
                     'product_item.product_item_sku as product_item_sku',
                     'product_item.description as product_description','product_item.hinge_side as is_hinge_side','product_item.finish_side as is_finish_side','product_item.product_item_price as product_item_price',
                     'product_item.cut_depth', 'product_item.cut_depth_price','door_style.name','door_style.image',
                     'product_item_hinge_side.right_hinge_side_price', 'product_item_hinge_side.left_hinge_side_price', 'product_item_hinge_side.hinge_side_none',
                     'product_item_finish_side.right_finish_side_price','product_item_finish_side.left_finish_side_price','product_item_finish_side.both_finish_side_price','product_item_finish_side.finish_side_none','customer_draft_style.draft_style_id')
            ->orderBy('draft_product.created_at', 'desc')
            ->get();

             $accessoriesNames = DraftProduct::leftJoin('draft_product_accessories', 'draft_product_accessories.draft_product_id', '=', 'draft_product.draft_product_id')
            ->leftJoin('accessoriesmaster', 'accessoriesmaster.accessories_id', '=', 'draft_product_accessories.accessories_id')
            ->leftJoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
            ->where('draft_product.customer_draft_id', $customerDraftId)
            ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
            ->where('draft_product.customer_id', $user)
            ->select(
                'draft_product.draft_product_id',
                'accessoriesmaster.accessories_nm as accessories_nm',
            )
            ->get()
            ->groupBy('draft_product_id');

            $modificationNames = DraftProduct::leftJoin('draft_product_modification', 'draft_product_modification.draft_product_id', '=', 'draft_product.draft_product_id')
            ->leftJoin('modificationmaster', 'modificationmaster.modification_id', '=', 'draft_product_modification.modification_id')
            ->leftJoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
            ->where('draft_product.customer_draft_id', $customerDraftId)
            ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
            ->where('draft_product.customer_id', $user)
            ->select(
                'draft_product.draft_product_id',
                'modificationmaster.modification_nm as modification_nm'
            )
            ->get()
            ->groupBy('draft_product_id');

           
            foreach ($products[$customerDraftStyle->door_style_Id] as $product) {
                $product->accessories_nm = $accessoriesNames->get($product->draft_product_id, []);
            }
            foreach ($products[$customerDraftStyle->door_style_Id] as $product) {
                $product->modification_nm = $modificationNames->get($product->draft_product_id, []);
            }
        }
        // dd($products);
         
         return view('frontend.tracking_status.view', compact('products','total','pagename','customer_draft','customerDraftId','grup_discount','taxGroup','shippingCost','taxRate'));
    }
    public function checkout_form(Request $request) {
        // Get data from the request
        $pagename = "checkout form";
        $encryptedData = $request->input('data');
        $decryptedData = json_decode(base64_decode($encryptedData), true);
        $action = $decryptedData['action'];
        $customerDraftId = $decryptedData['customerDraftId'];
        $discountedPrice = $decryptedData['discountedPrice'];
        $subTotal = $decryptedData['subTotal'];
        $user_id = Auth::user()->id;
        $customer = Customer:: where('user_id',$user_id)->first();
   
        $state = StateMaster::select('*')->get();
        $CustomerGroup = CustomerGroup::where('customer_group_id',$customer->customer_group_id)->first();
        $customer_draft = CustomerDraft::where('customer_draft_id',$customerDraftId)->first();
        $old_draft ="";
        $old_draft_var = CustomerDraft::where('customer_id',$user_id)->where('showroom','!=',"")->first();
        // if($old_draft_var != ""){
        //     $old_draft = $old_draft_var;
        // }
      
        return view('frontend.draft.checkout_form', compact('action','customerDraftId','discountedPrice','subTotal','state','pagename','CustomerGroup','customer_draft','old_draft'))->with(['status' => 'your_status_here']);
        
    }
    public function store_checkout_form(Request $request){
        $validatedData = $request->validate([
            // 'showroom' => 'required',
            'order_tag' => 'required',
            'dealer_name' => 'required',
            'dealer_email' => 'required|email|regex:/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/',
            'address' => 'required',
            'contact_no' => 'required|digits:10|regex:/^([0-9]*)$/',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required'
          ]);
        //$validatedData = $request->validated();
        $cus_draft = CustomerDraft::find($request->customerDraftId);
        // $cus_draft->showroom = $request->showroom;
        $cus_draft->po_number = $request->po_number;
        $cus_draft->designer = $request->designer;
        $cus_draft->order_tag = $request->order_tag;
        $cus_draft->discount = $request->discount;
        $cus_draft->client_name = $request->dealer_name;
        $cus_draft->client_email = $request->dealer_email;
        $cus_draft->address = $request->address;
        $cus_draft->contact_no = $request->contact_no;
        $cus_draft->city = $request->city;
        $cus_draft->state = $request->state;
        $cus_draft->zip_code = $request->zip_code;
        // $cus_draft->ship_name = $request->ship_name;
        // $cus_draft->ship_email = $request->ship_email;
        // $cus_draft->ship_contact_no = $request->ship_contact_no;
        // $cus_draft->ship_address = $request->ship_address;
        // $cus_draft->ship_state = $request->ship_state;
        // $cus_draft->ship_city = $request->ship_city;
        // $cus_draft->ship_zip_code = $request->ship_zip_code;
       
        if ($request->hasfile('pro_kitchen_pdf')) {
   
               $file = $request->file('pro_kitchen_pdf');
               $extension = $file->getClientOriginalExtension();
               $filename = time() . rand(1, 100) . '.' . $extension;
               $file->move('public/img/draft', $filename);
               $cus_draft->pro_kitchen_pdf = $filename;
           }
        $cus_draft->save();

      
        $status = $request->status;
        $customerDraftId = $request->customerDraftId;
        $discountedPrice = $request->discountedPrice;
        $subTotal = $request->subTotal;
        //dd("ok");
        return redirect()->route('save_draft', [
            'status' => $status,
            'id' => $customerDraftId,
            'price' => $discountedPrice,
            'original_price' => $subTotal
        ]);
    }

    public function addCart(Request $request,$customer_draft_Id)
    {
       
        
        $pagename = "Add Cart";
        $user = Auth::user()->id;
        // dd($user);
        $customer_draft = CustomerDraft::where('customer_draft_id',$customer_draft_Id)->first();
        $tax_rate = SalesTax::where('zip_code', $customer_draft->ship_zip_code)->value('tax_rate');
  
        $customer_draft->zipcode_tax_rate = $tax_rate;
        $customer_draft->save();
        //dd($customer_draft);
        $draft_product = DraftProduct::where('customer_draft_Id', $customer_draft_Id)->where('is_shipping_cost','Yes')->first();

        $shippingCost = $draft_product ? $draft_product->final_unit_price : 0;

        // $shippingCost= $draft_product->final_unit_price;
        $grup_discount = Customer::select('customer_group.group_dicount_percent')
       ->leftJoin('customer_group','customer_group.customer_group_id','customer.customer_group_id')
       ->where('customer.user_id',$user)
       ->first();
        $customerDraftStyles = CustomerDraftStyle::where('customer_draft_id', $customer_draft_Id)
            ->get();
        $taxGroup = Customer::select('tax_group','tax_rate')->where('user_id',$user)->first();
        
        // $taxRate = TaxGroup::pluck('tax_rate')->first();
        $taxRate  = SalesTax::where('zip_code', '6516')->value('tax_rate');
        $products = [];

        foreach ($customerDraftStyles as $customerDraftStyle) {
            $product_available = DraftProduct::where('draft_style_id', $customerDraftStyle->draft_style_id)->first();

      
            if(empty($product_available) || is_null($product_available)){
               return redirect('add-cart/'.$customer_draft_Id);
             }

            $products[$customerDraftStyle->door_style_Id] = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
            ->leftJoin('product_item_hinge_side', 'draft_product.product_id', '=', 'product_item_hinge_side.product_id')
            ->leftJoin('product_item_finish_side', 'draft_product.product_id', '=', 'product_item_finish_side.product_id')
            ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
            ->leftJoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
            ->leftJoin('door_style','door_style.doorStyle_id','=','customer_draft_style.door_style_Id')
            ->where('draft_product.customer_draft_id', $customer_draft_Id)
            ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
            ->where('draft_product.customer_id', $user)
            ->select('draft_product.*','product_master.*',
                     'product_item.product_item_sku as product_item_sku',
                     'product_item.description as product_description','product_item.hinge_side as is_hinge_side','product_item.finish_side as is_finish_side','product_item.product_item_price as product_item_price',
                     'product_item.cut_depth', 'product_item.cut_depth_price','door_style.name','door_style.image',
                     'product_item_hinge_side.right_hinge_side_price', 'product_item_hinge_side.left_hinge_side_price', 'product_item_hinge_side.hinge_side_none',
                     'product_item_finish_side.right_finish_side_price','product_item_finish_side.left_finish_side_price','product_item_finish_side.both_finish_side_price','product_item_finish_side.finish_side_none','customer_draft_style.draft_style_id')
            ->orderBy('draft_product.created_at', 'asc')
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
                    ->where('draft_product.customer_id', $user)
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
                    ->where('draft_product.customer_id', $user)
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
        $status_not_available = ["Pending", "Save"];

        // Query to check for records with the specified statuses and null shipping fields
        $shipping_not_available = CustomerDraft::where('customer_draft_id',$customer_draft_Id)->whereIn('draft_status', $status_not_available)
            ->where(function ($query) {
                $query->whereNull('ship_name')
                      ->orWhereNull('ship_email')
                      ->orWhereNull('ship_contact_no')
                      ->orWhereNull('ship_address')
                      ->orWhereNull('ship_state')
                      ->orWhereNull('ship_city')
                      ->orWhereNull('ship_zip_code');
            })
            ->exists(); //
            if ($shipping_not_available) {
                return redirect('create-shipping-information/'.$customer_draft_Id);
            }
         // dd($products);
        $newdata_arr = $products;
        $without_arr = $products;
        $customer = Customer:: where('user_id',$user)->first();
        $state = StateMaster::select('*')->get();
        $CustomerGroup = CustomerGroup::where('customer_group_id',$customer->customer_group_id)->first();
        $product_available = DraftProduct::where('customer_draft_Id', $customer_draft_Id)->where('is_shipping_cost','NO')->first();

        $doorStyleConfig = CustomerDraftStyle::where('customer_draft_Id', $customer_draft_Id)
        ->where('configuration',null)
         ->get();
         
        $draftCutdepthInch = DraftProduct::where('customer_draft_Id', $customer_draft_Id)
        ->where('is_cut_depth','Yes')
        ->whereNull('selected_cut_depth')
        ->where('is_shipping_cost','No')
        ->get();
        $checkHinge = DraftProduct::leftJoin('product_item','product_item.product_id','draft_product.product_id')
        ->where('draft_product.customer_draft_Id',$customer_draft_Id)
        ->where('draft_product.is_shipping_cost','No')
        ->where('product_item.hinge_side','Yes')
        ->whereNull('draft_product.hinge_side')
        ->select('draft_product.*', 'product_item.product_item_sku')
        ->get();
    
        $checkFinish = DraftProduct::leftJoin('product_item','product_item.product_id','draft_product.product_id')
        ->where('draft_product.customer_draft_Id',$customer_draft_Id)
        ->where('draft_product.is_shipping_cost','No')
        ->where('product_item.finish_side','Yes')
        ->whereNull('draft_product.finish_side')
        ->select('draft_product.*', 'product_item.product_item_sku')
        ->get();
      
    
    
        if(empty($product_available) || is_null($product_available)){
           return redirect('add-cart/'.$customer_draft_Id);

         }elseif (!$doorStyleConfig->isEmpty()) {
            return redirect('add-cart/'.$customer_draft_Id);

         }elseif (!$draftCutdepthInch->isEmpty()) {
            return redirect('add-cart/'.$customer_draft_Id);

         }elseif (!$checkHinge->isEmpty()) {
            return redirect('add-cart/'.$customer_draft_Id);

         }elseif (!$checkFinish->isEmpty()) {
            return redirect('add-cart/'.$customer_draft_Id);

         }
        $statusesToRedirect = ['Quotation', 'Inprogress', 'Ready' ,'In Production' ,'Delivered' ,'Return'];
        if (in_array($customer_draft->draft_status, $statusesToRedirect)) {
            return redirect('tracking-status/view/'.$customer_draft_Id);
        }
        
        return view('frontend.draft.add_cart',compact('customer_draft','customer','products','customer_draft_Id','newdata_arr','without_arr','pagename','pdf_data','grup_discount','taxGroup','CustomerGroup','state','shippingCost','taxRate'));
    }
    public function create_shipping_information($id){
        $pagename = "Add Cart";
        $draft= CustomerDraft::find($id);
        $user_id=Auth::user()->id;
      $state = StateMaster::select('*')->get();
      $customer = Customer:: where('user_id',$user_id)->first();
      $CustomerGroup = CustomerGroup::where('customer_group_id',$customer->customer_group_id)->first();
        return view('frontend.draft.shipping_information',compact("pagename","draft","user_id","state","customer","CustomerGroup","id"));
    }
    public function store_shipping_information(ShippingInformationForm $request,$id){
        $draft= CustomerDraft::find($id);
        $draft->ship_name = $request->ship_name;
        $draft->ship_email = $request->ship_email;
        $draft->ship_contact_no = $request->ship_contact_no;
        $draft->ship_address = $request->ship_address;
        $draft->ship_state = $request->ship_state;
        $draft->ship_city = $request->ship_city;
        $draft->ship_zip_code = $request->ship_zip_code;
        $draft->save();
        if($draft->draft_status == "Pending" || $draft->draft_status == "Save"){
            return redirect('add-cart/'.$id);
        }else{
            return redirect('tracking-status/view/'.$id);
        }


    }
 
}


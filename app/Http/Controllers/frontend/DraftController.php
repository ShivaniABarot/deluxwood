<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerDraftForm;
use App\Http\Requests\CreditcardForm;
use App\Models\CustomerDraft;
use App\Models\StateMaster;
use App\Models\DoorStyle;
use App\Models\ProductMaster;
use App\Models\CustomerDraftStyle;
use App\Models\ProductDoorStyle;
use App\Models\ItemModification;
use App\Models\ItemAccessories;
use App\Models\DraftProduct;
use App\Models\Customer;
use App\Models\ProductItem;
use App\Models\UnassembledDiscount;
use App\Models\EmailAuditLog;
use App\Models\DraftProductModification;
use App\Models\DraftProductAccessories;
use App\Models\CustomerGroup;
use App\Models\ModificationValue;
use App\Models\CreditCard;
use App\Models\ItemCutDepth;
use App\Models\User;
use App\Models\SalesTax;
use App\Models\DefaultShippingCost;
use App\Models\TaxGroup;
use App\Models\UsedCouponHistory;
use App\Models\CouponMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use DB;
use Carbon\Carbon;
use PDF;



class DraftController extends Controller
{
    public function customerDraft()
    {

        $pagename = "customer Draft";
        $user_id = Auth::user()->id;
        $state = StateMaster::select('*')->get();
        $customer = Customer::where('user_id', $user_id)->first();
        $CustomerGroup = CustomerGroup::where('customer_group_id', $customer->customer_group_id)->first();

        return view('frontend.draft.customer_draft', compact('state', 'CustomerGroup', 'pagename'));

    }
    public function store(CustomerDraftForm $request)
    {
        if ($request->ajax()) {
            return true;
        }
        $user_id = Auth::user()->id;

        $cus_draft = new CustomerDraft();
        $cus_draft->customer_id = $user_id;
        $cus_draft->po_number = $request->po_number;
        // $cus_draft->order_tag = $request->order_tag;
        //  $cus_draft->showroom = $request->showroom;
        $cus_draft->designer = $request->designer;
        $cus_draft->discount = $request->discount;
        //  $cus_draft->client_name = $request->client_name;
        //  $cus_draft->client_email = $request->client_email;
        //  $cus_draft->address = $request->address;
        //  $cus_draft->contact_no = $request->contact_no;
        //  $cus_draft->city = $request->city;
        //  $cus_draft->state = $request->state;
        //  $cus_draft->zip_code = $request->zip_code;
        $cus_draft->ship_name = $request->ship_name;
        $cus_draft->ship_email = $request->ship_email;
        $cus_draft->ship_contact_no = $request->ship_contact_no;
        $cus_draft->ship_address = $request->ship_address;
        $cus_draft->ship_state = $request->ship_state;
        $cus_draft->ship_city = $request->ship_city;
        $cus_draft->ship_zip_code = $request->ship_zip_code;
        $cus_draft->is_seen = '0';

        //  if ($request->hasfile('pro_kitchen_pdf')) {

        //         $file = $request->file('pro_kitchen_pdf');
        //         $extension = $file->getClientOriginalExtension();
        //         $filename = time() . rand(1, 100) . '.' . $extension;
        //         $file->move('public/img/draft', $filename);
        //         $cus_draft->pro_kitchen_pdf = $filename;
        //     }
        $tax_rate = SalesTax::where('zip_code', $request->ship_zip_code)->value('tax_rate');
        $cus_draft->zipcode_tax_rate = $tax_rate;
        $cus_draft->save();

        $draft_product = new DraftProduct();
        $draft_product->customer_id = $user_id;
        $draft_product->customer_draft_Id = $cus_draft->customer_draft_id;
        $draft_product->product_id = "Shipping cost";
        $draft_product->final_unit_price = 0;
        $draft_product->is_shipping_cost = "Yes";
        $draft_product->save();




        return redirect('/door-style/' . $cus_draft->customer_draft_id)->with('success', 'Customer Draft Add Successfully');
    }
    public function doorStyle($id)
    {
        $pagename = "Door Style";
        $framed_door_style = DoorStyle::select('*')->where('line', "Framed")->where('removed', 'No')->get();
        $frameless_door_style = DoorStyle::select('*')->where('line', "Frameless")->where('removed', 'No')->get();


        return view('frontend.draft.door_style', compact('id', 'pagename', 'framed_door_style', 'frameless_door_style'));
    }
    public function CustomerDraftStyle(Request $request)
    {
        $customerDraftStyle = CustomerDraftStyle::where('customer_draft_id', $request->draft_id)->where('draft_style_id', $request->doorStyle_id)->first();
        if ($customerDraftStyle) {
            $customerDraftStyle->door_style_Id = $request->doorStyle_id;
            $customerDraftStyle->customer_draft_Id = $request->draft_id;
            $customerDraftStyle->save();
        } else {

            $customerDraftStyle = new CustomerDraftStyle();
            $customerDraftStyle->door_style_Id = $request->doorStyle_id;
            $customerDraftStyle->customer_draft_Id = $request->draft_id;
            $customerDraftStyle->save();
        }

        return redirect('new-draft/' . $request->draft_id);
    }
    public function delete_draft_style($draft_style_id)
    {

        $draft_style = CustomerDraftStyle::where('draft_style_id', $draft_style_id)->first();
        $customer_draft_Id = $draft_style->customer_draft_Id;
        $draft_style->delete();
        DraftProduct::where('draft_style_id', $draft_style_id)
            ->where('customer_draft_Id', $customer_draft_Id)
            ->delete();
        $draft_style_count = CustomerDraftStyle::where('customer_draft_Id', $customer_draft_Id)->count();

        if ($draft_style_count == 0) {
            return redirect('door-style/' . $customer_draft_Id);
        } else {
            return redirect('new-draft/' . $customer_draft_Id);

        }


    }

    public function change_draft_style_get($draft_style_id)
    {
        $pagename = "Door Style";
        $draft_style = CustomerDraftStyle::where('draft_style_id', $draft_style_id)->first();
        $framed_door_style = DoorStyle::select('*')->where('line', "Framed")->where('removed', 'No')->get();
        $frameless_door_style = DoorStyle::select('*')->where('line', "Frameless")->where('removed', 'No')->get();


        $door_style = DoorStyle::select('*')->get();
        $id = $draft_style->customer_draft_Id;
        return view('frontend.draft.change_door_style', compact('door_style', 'id', 'draft_style_id', 'pagename', 'framed_door_style', 'frameless_door_style'));
    }

    public function change_draft_style_post($id, $draft_style_id, Request $request)
    {
        $product_id = ProductDoorStyle::where('door_style_id', $request->doorStyle_id)->pluck('product_id')->toArray();

        $draft_products = DraftProduct::where('customer_draft_Id', $id)->where('draft_style_id', $draft_style_id)->where('is_shipping_cost', 'No')->get();

        foreach ($draft_products as $draft_product) {

            if (!in_array($draft_product->product_id, $product_id)) {
                $draft_product->delete();
            }
        }
        $existingDraftStyle = CustomerDraftStyle::where('door_style_Id', $request->doorStyle_id)->where('customer_draft_Id', $id)->first();

        if (!$existingDraftStyle) {

            $draft_style = CustomerDraftStyle::where('draft_style_id', $draft_style_id)->first();
            $draft_style->door_style_Id = $request->doorStyle_id;
            $draft_style->save();
        }

        return redirect('new-draft/' . $id);
    }


    public function showProduct(Request $request, $customer_draft_Id)
    {
        $pagename = "add draft";
        $draft_style = CustomerDraftStyle::where('customer_draft_Id', $customer_draft_Id)->get();
        if ($draft_style->isEmpty()) {
            return redirect('door-style/' . $customer_draft_Id);
        }
        $user = Auth::user()->id;

        //   $product = DB::table('draft_product')
        //   ->leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
        //   ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
        //   ->where('draft_product.customer_draft_id', $customer_draft_Id)
        //   ->where('draft_product.customer_id', $user)
        //   ->select('draft_product.*','product_master.*',
        //            'product_item.product_item_sku as product_item_sku',
        //            'product_item.hinge_side as is_hinge_side','product_item.finish_side as is_finish_side','product_item.product_item_price as product_item_price')
        //   ->get();
        $customerDraft = CustomerDraft::where('customer_draft_Id', $customer_draft_Id)->first();
        $serviceType = $customerDraft->service_type;
        $configuration = $customerDraft->configuration;



        return view('frontend.draft.add_draft', compact('draft_style', 'customer_draft_Id', 'serviceType', 'configuration', 'pagename', 'customerDraft'));
    }
    public function updateConfiguration(Request $request)
    {
        // dd ($request->input('doorStyleId'));
        $doorStyleId = $request->input('doorStyleId');
        $configuration = $request->input('configuration');

        $CustomerDraftStyle = CustomerDraftStyle::find($doorStyleId);
        $CustomerDraftStyle->configuration = $configuration;
        $CustomerDraftStyle->save();
        return response()->json(['success' => true]);

    }
    public function updateServieConfiguration(Request $request)
    {
        $customer_draft_id = $request->input('customer_draft_id');
        $toggle_group = $request->input('toggle_group');
        $new_value = $request->input('new_value');

        $customerDraft = CustomerDraft::where('customer_draft_Id', $customer_draft_id)->first();

        $shipping_cost = $state = StateMaster::find($customerDraft->ship_state);
        $DefaultShippingCost = DefaultShippingCost::find('1');
        if ($toggle_group === 'service_type') {
            $customerDraft->service_type = $new_value;
            $draft_product = DraftProduct::where('customer_draft_Id', $customer_draft_id)->where('is_shipping_cost', 'Yes')->first();
            if ($new_value == "Self Pickup") {
                $draft_product->final_unit_price = 0;
            } elseif ($new_value == "Curbside Delivery") {

                if ($shipping_cost->curbside_shipping_cost != 0) {
                    $draft_product->final_unit_price = $shipping_cost->curbside_shipping_cost;
                } else {

                    $draft_product->final_unit_price = $DefaultShippingCost->curbside_shipping_cost;

                }
            } elseif ($new_value == "In-house Delivery") {

                if ($shipping_cost->in_house_shipping_cost != 0) {
                    $draft_product->final_unit_price = $shipping_cost->in_house_shipping_cost;
                } else {
                    $draft_product->final_unit_price = $DefaultShippingCost->in_house_shipping_cost;
                }


            }
            $draft_product->save();
        } elseif ($toggle_group === 'configuration') {
            $customerDraft->configuration = $new_value;
        }

        $customerDraft->save();

        return response()->json(['success' => true]);
    }

    public function getProductsBySku(Request $request)
    {
        $sku = $request->input('sku');
        $doorStyleId = $request->input('door_style_id');
        $user_id = Auth::user()->id;
        // Fetch products based on SKU and door_style_id using your existing query
        $products = DB::table('product_master')
            ->leftJoin('product_door_style', 'product_master.product_id', '=', 'product_door_style.product_id')
            ->leftJoin('product_item', 'product_master.product_id', '=', 'product_item.product_id')
            ->leftJoin('product_item_hinge_side', 'product_master.product_id', '=', 'product_item_hinge_side.product_id')
            ->leftJoin('product_item_finish_side', 'product_master.product_id', '=', 'product_item_finish_side.product_id')
            ->where('product_door_style.door_style_id', $doorStyleId)
            ->where('product_master.availability', 'Listed')
            ->where('product_item.product_item_sku', 'LIKE', '%' . $sku . '%')
            ->where(function ($query) {
                $query->where('product_master.inventory_quantity', '!=', 0)
                    ->whereNotNull('product_master.inventory_quantity');
            })
            ->select(
                'product_master.*',
                'product_item.*',
                'product_item_hinge_side.right_hinge_side_price',
                'product_item_hinge_side.left_hinge_side_price',
                'product_item_hinge_side.hinge_side_none',
                'product_item_finish_side.right_finish_side_price',
                'product_item_finish_side.left_finish_side_price',
                'product_item_finish_side.both_finish_side_price',
                'product_item_finish_side.finish_side_none'
            )
            ->get();
        $draftStyleId = $request->input('draft_style_id');
        $customerDraftId = $request->input('customer_draft_Id');

        return response()->json($products);
    }
    public function get_draft_products(Request $request)
    {
        // dd($request);
        $customerDraftId = $request->input('customer_draft_Id');
        $draft_style_id = $request->input('draft_style_id');
        $user = Auth::user()->id;
        $pro_id = DraftProduct::select('product_id')->where('customer_draft_Id', $customerDraftId)->where('is_shipping_cost', 'No')->first();
        // dd($pro_id);
        // $cut_depth = ItemCutDepth::select('depth_name_inch','item_depth_id','product_id')->where('product_id',$pro_id->product_id)->get();
        // dd($cut_depth);
        $product = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
            ->leftJoin('product_item_hinge_side', 'draft_product.product_id', '=', 'product_item_hinge_side.product_id')
            ->leftJoin('product_item_finish_side', 'draft_product.product_id', '=', 'product_item_finish_side.product_id')
            ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
            ->where('draft_product.customer_draft_id', $customerDraftId)
            ->where('draft_product.draft_style_id', $draft_style_id)
            ->where('draft_product.customer_id', $user)
            ->where('draft_product.is_shipping_cost', "No")
            ->select(
                'draft_product.*',
                'product_master.*',
                'product_item.product_item_sku as product_item_sku',
                'product_item.cut_depth as cut_depth',
                'product_item.description as description',
                'product_item.hinge_side as is_hinge_side',
                'product_item.finish_side as is_finish_side',
                'product_item.product_item_price as product_item_price',
                'product_item_hinge_side.right_hinge_side_price',
                'product_item_hinge_side.left_hinge_side_price',
                'product_item_hinge_side.hinge_side_none',
                'product_item_finish_side.right_finish_side_price',
                'product_item_finish_side.left_finish_side_price',
                'product_item_finish_side.both_finish_side_price',
                'product_item_finish_side.finish_side_none',
            )
            ->orderBy('draft_product.created_at', 'asc')
            ->get();
        $modificationNames = DraftProduct::leftJoin('draft_product_modification', 'draft_product_modification.draft_product_id', '=', 'draft_product.draft_product_id')
            ->leftJoin('modificationmaster', 'modificationmaster.modification_id', '=', 'draft_product_modification.modification_id')
            ->where('draft_product.customer_draft_id', $customerDraftId)
            ->where('draft_product.draft_style_id', $draft_style_id)
            ->where('draft_product.customer_id', $user)
            ->where('draft_product.is_shipping_cost', "No")
            ->select(
                'draft_product.draft_product_id',
                'modificationmaster.modification_nm as modification_nm'
            )
            ->get()
            ->groupBy('draft_product_id');

        $accessoriesNames = DraftProduct::leftJoin('draft_product_accessories', 'draft_product_accessories.draft_product_id', '=', 'draft_product.draft_product_id')
            ->leftJoin('accessoriesmaster', 'accessoriesmaster.accessories_id', '=', 'draft_product_accessories.accessories_id')
            ->where('draft_product.customer_draft_id', $customerDraftId)
            ->where('draft_product.draft_style_id', $draft_style_id)
            ->where('draft_product.customer_id', $user)
            ->where('draft_product.is_shipping_cost', "No")
            ->select(
                'draft_product.draft_product_id',
                'accessoriesmaster.accessories_nm as accessories_nm'
            )
            ->get()
            ->groupBy('draft_product_id');

        foreach ($product as $item) {
            $modificationIdExists = DB::table('item_modification')
                ->where('product_id', $item->product_id)
                ->exists();

            $accessoriesIdExists = DB::table('item_accessories')
                ->where('product_id', $item->product_id)
                ->exists();

            $cut_depthIdExists = DB::table('item_cut_depth')
                ->where('product_id', $item->product_id)
                ->exists();
            $is_cutDepthExists = DraftProduct::where('product_id', $item->product_id)
                ->exists();

            $item->modification_id_exists = $modificationIdExists;
            $item->accessories_id_exists = $accessoriesIdExists;
            $item->cutdepth_id_exists = $cut_depthIdExists;
            $item->is_cutdepth_exsts = $is_cutDepthExists;

            $selectedCutDepth = DraftProduct::select('selected_cut_depth', 'draft_product_id as cut_depth_draft_id')
                ->where('customer_draft_Id', $customerDraftId)
                ->where('is_shipping_cost', "No")
                ->get();

            if ($is_cutDepthExists) {
                $item->is_cut_depth = DraftProduct::select('is_cut_depth')
                    ->where('customer_draft_Id', $customerDraftId)
                    ->where('draft_product_id', $item->draft_product_id)
                    ->where('draft_style_id', $draft_style_id)
                    ->value('is_cut_depth'); // Fetch the single value directly
            }

            $item->selectedcut_depth = $selectedCutDepth;
            if ($cut_depthIdExists) {
                $item->cut_depth_info = DB::table('item_cut_depth')
                    ->select('item_depth_id', 'depth_name_inch')
                    ->where('product_id', $item->product_id)
                    ->get();
            }
        }

        foreach ($product as $productItem) {
            $productItem->modification_nm = $modificationNames->get($productItem->draft_product_id, []);
        }

        foreach ($product as $productAcc) {
            $productAcc->accessories_nm = $accessoriesNames->get($productAcc->draft_product_id, []);
        }
        // dd($modificationNames); 
        $responseArray = [
            'status' => 'success',
            'products' => $product,
            'modificationNames' => $modificationNames->toArray(),
            'accessoriesNames' => $accessoriesNames->toArray(),
        ];
        // dd($accessoriesNames);
        return response()->json($responseArray);
    }
    public function updateIsCutDepth(Request $request)
    {
        $productId = $request->input('productId');
        $draftProductId = $request->input('draftProductId');
        $IsselectedDepth = $request->input('IsselectedDepth');

        $isCutDepth = DraftProduct::where('draft_product_id', $draftProductId)
            ->where('product_id', $productId)
            ->where('is_shipping_cost', 'No')
            ->first();

        if ($isCutDepth) {

            $isCutDepth->is_cut_depth = $IsselectedDepth;
            $isCutDepth->selected_cut_depth = 0;
            $isCutDepth->save();

            return response()->json(['success' => true, 'message' => 'Selected cut depth updated successfully']);
        }


        return response()->json(['success' => false, 'message' => 'Failed to update selected cut depth']);
    }
    public function updateSelectedCutDepth(Request $request)
    {
        // dd($request);
        $productId = $request->input('productId');
        $draftProductId = $request->input('draftProductId');
        $selectedDepth = $request->input('selectedDepth');

        $cut_depth = DraftProduct::where('draft_product_id', $draftProductId)
            ->where('product_id', $productId)
            ->where('is_shipping_cost', 'No')
            ->first();

        if ($cut_depth) {
            $cut_depth->selected_cut_depth = $selectedDepth;
            $cut_depth->save();

            return response()->json(['success' => true, 'message' => 'Selected cut depth updated successfully']);
        }


        return response()->json(['success' => false, 'message' => 'Failed to update selected cut depth']);
    }

    public function store_draft_product(Request $request)
    {
        $user = Auth::user()->id;
        $draftStyleId = $request->input('draft_style_id');
        $customerDraftId = $request->input('customer_draft_Id');
        $product_id = $request->input('product_id');

        $draft_count = DraftProduct::where('draft_style_id', $draftStyleId)->where('product_id', $product_id)->where('is_shipping_cost', 'No')->count();



        //if($draft_count == 0){
        DraftProduct::insert([
            'customer_id' => $user,
            'draft_style_id' => $draftStyleId,
            'customer_draft_Id' => $customerDraftId,
            'product_id' => $product_id,
            // Add any other columns you want to insert here
        ]);
        $this->draft_total($customerDraftId);

        $message = "Add to draft successfully..!";
        // }else{
        //     $draft_product = DraftProduct::where('draft_style_id',$draftStyleId)->where('customer_draft_Id',$customerDraftId)->where('product_id',$product_id)->first();
        //     $draft_product->quantity = $draft_product->quantity+1;
        //     $draft_product->save();
        //     $message = "Draft Product quantity increased.";
        // }

        // dd($product);
        $responseArray = array(
            'status' => 'success',
            'message' => $message,
        );
        return response()->json($responseArray);
    }
    public function getModificationsByProduct(Request $request)
    {
        $productId = $request->input('product_id');
        $draftProductId = $request->input('draft_product_id');

        // Retrieve the product by ID
        $product = ProductMaster::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Retrieve the selected modification IDs for the specific draft product
        $selectedModificationIds = DraftProductModification::where('draft_product_id', $draftProductId)
            ->pluck('modification_id')
            ->toArray();

        $modifications = ItemModification::select('item_modification.*', 'modificationmaster.modification_nm', 'modificationmaster.modification_info', 'modificationmaster.info_type', 'modificationmaster.message_label', 'modificationmaster.integer_lable')
            ->leftjoin('modificationmaster', 'modificationmaster.modification_id', 'item_modification.modification_id')
            ->where('product_id', $productId)
            ->get();


        $response = [];
        foreach ($modifications as $modification) {
            $isSelected = in_array($modification->modification_id, $selectedModificationIds);

            $response[] = [
                'modification_id' => $modification->modification_id,
                'modification_nm' => $modification->modification_nm,
                'modification_info' => $modification->modification_info,
                'info_type' => $modification->info_type,
                'message_label' => $modification->message_label,
                'integer_lable' => $modification->integer_lable,
                'modification_price' => $modification->modification_price,
                'is_selected' => $isSelected,
            ];
        }

        return response()->json($response);
    }

    public function getcutdepthByProduct(Request $request)
    {
        $productId = $request->input('product_id');
        $draftProductId = $request->input('draft_product_id');

        $product = ProductMaster::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $selectedCutDepth = DraftProduct::select('selected_cut_depth', 'draft_product_id as cut_depth_draft_id', 'is_cut_depth')
            ->where('draft_product_id', $draftProductId)
            ->where('is_shipping_cost', "No")
            ->first();
        $cut_depth_info = DB::table('item_cut_depth')
            ->select('item_depth_id', 'depth_name_inch')
            ->where('product_id', $productId)
            ->get();

        // Modify here
        $cut_depth_options = [];
        foreach ($cut_depth_info as $cut_depth) {
            $cut_depth_options[$cut_depth->item_depth_id] = $cut_depth->depth_name_inch;
        }

        return response()->json([
            'cut_depth_info' => $cut_depth_options,
            'selectedCutDepth' => $selectedCutDepth,
        ]);
    }

    public function addModificationToDraftProduct(Request $request)
    {
        $modificationId = $request->input('modification_id');
        $productId = $request->input('product_id');
        $draftStyleId = $request->input('draft_style_id');
        $draftProductId = $request->input('draftProductId');
        $modificationInfo = $request->input('modificationInfo');
        $infoType = $request->input('infoType');
        $integer_lable = $request->input('integer_lable');
        $message_lable = $request->input('message_lable');


        // Check if the modification is already added to the draft product
        $draftProductModification = DraftProductModification::where('draft_product_id', $draftProductId)
            ->where('modification_id', $modificationId)
            ->first();

        if (!$draftProductModification) {
            $draft_product_modification = new DraftProductModification();
            $draft_product_modification->draft_product_id = $draftProductId;
            $draft_product_modification->modification_id = $modificationId;

            $draft_product_modification->save();

            return response()->json(['success' => true, 'added' => true]);
        }

        return response()->json(['success' => true, 'added' => false]);
    }

    public function deleteModificationFromDraftProduct(Request $request)
    {
        $modificationId = $request->input('modification_id');
        $productId = $request->input('product_id');
        $draftProductId = $request->input('draft_product_id');
        // Delete the modification from the draft_product_modification table
        DraftProductModification::where('draft_product_id', $draftProductId)
            ->where('modification_id', $modificationId)
            ->delete();


        return response()->json(['deleted' => true]);
    }


    public function getModificationValues(Request $request)
    {
        $modificationId = $request->input('modification_id');
        $draftProductId = $request->input('draft_product_id');

        // Get the size and message values from draft_product_modification table
        $modificationData = DraftProductModification::where('modification_id', $modificationId)
            ->where('draft_product_id', $draftProductId)
            ->select('size', 'message')
            ->first();

        $values = ModificationValue::where('modification_id', $modificationId)
            ->pluck('value')
            ->toArray();


        return response()->json([
            'values' => $values,
            'modificationData' => $modificationData,
        ]);
    }
    public function editModificationInfo(Request $request)
    {
        $modificationId = $request->input('modification_id');
        $draftProductId = $request->input('draft_product_id');
        $size = $request->input('size');
        $message = $request->input('message');

        // Check if the record exists in the database
        $existingRecord = DraftProductModification::where([
            'modification_id' => $modificationId,
            'draft_product_id' => $draftProductId,
        ])->first();

        if ($size != "") {
            $existingRecord->size = $size;
        } else {
            $existingRecord->size = null;
        }
        if ($message != "") {
            $existingRecord->message = $message;
        } else {
            $existingRecord->message = null;
        }
        $existingRecord->save();


        return response()->json(['success' => true]);
    }


    public function getAccessoriesByProduct(Request $request)
    {
        $productId = $request->input('product_id');
        $draftProductId = $request->input('draft_product_id');

        $product = ProductMaster::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }


        $selectedAccessoriesIds = DraftProductAccessories::where('draft_product_id', $draftProductId)
            ->pluck('accessories_id')
            ->toArray();



        $accessories = ItemAccessories::select('item_accessories.*', 'accessoriesmaster.accessories_nm')
            ->leftjoin('accessoriesmaster', 'accessoriesmaster.accessories_id', 'item_accessories.accessories_id')->where('product_id', $productId)->get();

        $response = [];
        foreach ($accessories as $accessories) {
            $isSelected = in_array($accessories->accessories_id, $selectedAccessoriesIds);
            $response[] = [
                'accessories_id' => $accessories->accessories_id,
                'accessories_nm' => $accessories->accessories_nm,
                'accessories_price' => $accessories->accessories_price,
                'is_selected' => $isSelected,
            ];
        }

        return response()->json($response);
    }


    public function addAccessorieToDraftProduct(Request $request)
    {
        $accessoriesId = $request->input('accessorie_id');
        $draftProductId = $request->input('draftProductId');

        $draftProductAccessories = DraftProductAccessories::where('draft_product_id', $draftProductId)
            ->where('accessories_id', $accessoriesId)
            ->first();

        if (!$draftProductAccessories) {
            $draftProductAccessories = new DraftProductAccessories();
            $draftProductAccessories->draft_product_id = $draftProductId;
            $draftProductAccessories->accessories_id = $accessoriesId;

            $draftProductAccessories->save();

            return response()->json(['success' => true, 'added' => true]);
        }

        return response()->json(['success' => true, 'added' => false]);
    }
    public function deleteAccessorieFromDraftProduct(Request $request)
    {
        $accessoriesId = $request->input('accessorie_id');
        $productId = $request->input('product_id');
        $draftProductId = $request->input('draft_product_id');
        // Delete the modification from the draft_product_modification table
        DraftProductAccessories::where('draft_product_id', $draftProductId)
            ->where('accessories_id', $accessoriesId)
            ->delete();


        return response()->json(['deleted' => true]);
    }
    public function designer_update(Request $request)
    {
        $customer_draft_id = $request->input('customer_draft_id');
        $designer = $request->input('designer');
        $customer_draft = CustomerDraft::where('customer_draft_id', $customer_draft_id)->first();
        $customer_draft->designer = $designer;
        $customer_draft->save();
        return response()->json("done");
    }
    public function po_number_update(Request $request)
    {
        $customer_draft_id = $request->input('customer_draft_id');
        $po_number = $request->input('po_number');
        $customer_draft = CustomerDraft::where('customer_draft_id', $customer_draft_id)->first();
        $customer_draft->po_number = $po_number;
        $customer_draft->save();
        return response()->json("done");
    }

    public function customer_note_update(Request $request)
    {
        $customer_draft_id = $request->input('customer_draft_id');
        $note = $request->input('note');
        $customer_draft = CustomerDraft::where('customer_draft_id', $customer_draft_id)->first();
        $customer_draft->customer_note = $note;
        $customer_draft->save();
        return response()->json("done");
    }
    public function quantity_update(Request $request)
    {
        $productId = $request->input('product_id');
        $draftStyleId = $request->input('draft_style_id');
        $newQuantity = $request->input('new_quantity');
        $draftProductId = $request->input('draft_product_id');

        $draft_product = DraftProduct::where('draft_product_id', $draftProductId)->where('draft_style_id', $draftStyleId)->where('is_shipping_cost', 'No')->first();

        $accessory_quantities = DB::table('draft_product_accessories')->where('draft_product_id', $draftProductId)
            ->leftJoin('accessoriesmaster', 'draft_product_accessories.accessories_id', '=', 'accessoriesmaster.accessories_id')
            ->select('accessoriesmaster.accessories_id', 'accessoriesmaster.quantity')
            ->first();
        // dd($accessory_quantities->quantity);
        if ($accessory_quantities) {
            if ($newQuantity > $accessory_quantities->quantity) {
                $quantity = $draft_product->quantity;
                $customer_draft_id = $draft_product->customer_draft_Id;
                $message = "Can not add quantity more than " . $accessory_quantities->quantity;
                return $this->count_price($customer_draft_id, $quantity, $message);
            }
        }

        $draft_product->quantity = $newQuantity;
        $quantity = $draft_product->quantity;
        $customer_draft_id = $draft_product->customer_draft_Id;
        $draft_product->save();
        $message = "";

        // return response()->json(['message' => 'Quantity updated successfully']);
        return $this->count_price($customer_draft_id, $quantity, $message);
    }

    public function count_price($id, $quantity, $message)
    {
        $sub_total = 0;
        $totalModificationPrice = 0;
        $item_price = 0;
        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
        $user = Auth::user()->id;
        $taxGroup = Customer::select('tax_group', 'tax_rate')->where('user_id', $user)->first();
        // $taxRate = TaxGroup::pluck('tax_rate')->first();
        $taxRate = SalesTax::where('zip_code', '6516')->value('tax_rate');
        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
        $product = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
            ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
            ->leftJoin('customer_draft_style', 'draft_product.draft_style_id', '=', 'customer_draft_style.draft_style_id')
            ->where('draft_product.customer_draft_id', $id)
            ->where('draft_product.is_shipping_cost', "No")
            ->select(
                'draft_product.*',
                'product_master.*',
                'customer_draft_style.*',
                'product_item.description as product_description',
                'customer_draft_style.configuration as door_style_configuration',
                'product_item.hinge_side as is_hinge_side',
                'product_item.finish_side as is_finish_side',
                'product_item.product_item_price as product_item_price',
                'product_item.cut_depth',
                'product_item.cut_depth_price'
            )
            ->get();
        // dd($product);
        foreach ($product as $data) {
            $price = $data->product_item_price;

            $hinge_price = DB::table('product_item_hinge_side')->where('product_id', $data->product_id)->first();
            if ($data->hinge_side == "L") {
                $price = $price + $hinge_price->left_hinge_side_price;
            } elseif ($data->hinge_side == "R") {
                $price = $price + $hinge_price->right_hinge_side_price;
            } elseif ($data->hinge_side == "B") {
                $price = $price + $hinge_price->both_hinge_side_price;
            }
            $finish_price = DB::table('product_item_finish_side')->where('product_id', $data->product_id)->first();
            if ($data->finish_side == "L") {
                $price = $price + $finish_price->left_finish_side_price;
            } elseif ($data->finish_side == "R") {
                $price = $price + $finish_price->right_finish_side_price;
            } elseif ($data->finish_side == "B") {
                $price = $price + $finish_price->both_finish_side_price;
            }
            // $DoorStylePrice = DraftProduct::selectRaw('SUM(product_door_style.doorstyle_price ) AS total_doorstyle_price')
            //     ->where('draft_product.draft_product_id', $data->draft_product_id)
            //     ->where('is_shipping_cost',"No")
            //     ->join('customer_draft_style', 'draft_product.draft_style_id', '=', 'customer_draft_style.draft_style_id')
            //     ->join('product_door_style', function ($join) {
            //     $join->on('customer_draft_style.door_style_Id', '=', 'product_door_style.door_style_id')
            //             ->on('draft_product.product_id', '=', 'product_door_style.product_id');
            //     })->value('total_doorstyle_price');

            $DoorStylePrice = DraftProduct::selectRaw('SUM(product_door_style.doorstyle_price * draft_product.quantity) AS total_doorstyle_price')
                ->where('draft_product.draft_product_id', $data->draft_product_id)
                ->join('customer_draft_style', 'draft_product.draft_style_id', '=', 'customer_draft_style.draft_style_id')
                ->join('product_door_style', function ($join) {
                    $join->on('customer_draft_style.door_style_Id', '=', 'product_door_style.door_style_id')
                        ->on('draft_product.product_id', '=', 'product_door_style.product_id');
                })
                ->value('total_doorstyle_price');
            $ModificationPrice = DraftProduct::selectRaw('SUM(item_modification.modification_price ) AS total_modification_price')
                ->where('draft_product.draft_product_id', $data->draft_product_id)
                ->join('draft_product_modification', 'draft_product.draft_product_id', '=', 'draft_product_modification.draft_product_id')
                ->join('item_modification', function ($join) {
                    $join->on('draft_product_modification.modification_id', '=', 'item_modification.modification_id')
                        ->on('draft_product.product_id', '=', 'item_modification.product_id');
                })->value('total_modification_price');

            $AccessoriesPrice = DraftProduct::selectRaw('SUM(item_accessories.accessories_price ) AS total_accessories_price')
                ->where('draft_product.draft_product_id', $data->draft_product_id)
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
            $totalModificationPrice = $totalModificationPrice + $AccessoriesPrice + $DoorStylePrice;

            $itemTotalPrice = $data->product_item_price * $data->quantity;
            $item_price += $itemTotalPrice + $DoorStylePrice;

            $price = $price * $data->quantity;
            $sub_total = $sub_total + $price;
            $sub_total = $sub_total + $ModificationPrice + $AccessoriesPrice + $DoorStylePrice;
        }
        $discountedPrice = $sub_total;


        $discountedPrice = $discountedPrice * (1 - ($customer_draft->discount / 100));
        // $discountedPrice = $sub_total * (1 - ($customer_draft->discount / 100));
        $discount = $customer_draft->discount;
        $unassembled_discount = UnassembledDiscount::find(1);
        $discount_check = $data->door_style_configuration;
        if ($data->door_style_configuration == "Unassembled") {
            $discount_check = 1;
            $configurationDiscount = $sub_total * ($unassembled_discount->unassembled_discount / 100);

            $discountedPrice -= $configurationDiscount;
        }



        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
        $taxGroupDiscount = 0;
        if ($taxGroup->tax_group == "With Tax") {
            if ($customer_draft->service_type == "Self Pickup") {
                $taxGroupDiscount = $discountedPrice * ($taxRate / 100);
            } elseif ($customer_draft->service_type == "Curbside Delivery") {

                $taxGroupDiscount = $discountedPrice * ($customer_draft->zipcode_tax_rate / 100);

            } else {
                $taxGroupDiscount = $discountedPrice * ($customer_draft->zipcode_tax_rate / 100);
            }

            $discountedPrice += $taxGroupDiscount;
        }
        $used_coupon = DB::table('used_coupon_history')->leftJoin('coupon_master', 'coupon_master.coupon_id', '=', 'used_coupon_history.coupon_id')->select('coupon_master.coupon_name', 'coupon_master.discount_type', 'used_coupon_history.*')->where('draft_id', $id)->get();
        if ($used_coupon != null) {
            foreach ($used_coupon as $used_coupon) {
                if ($used_coupon->discount_type == "Percentage") {
                    $CouponDiscount = $discountedPrice * ($used_coupon->discount / 100);
                    $discountedPrice -= $CouponDiscount;
                } else {
                    $discountedPrice -= $used_coupon->discount;
                }
            }
        }
        $shippingCost = 0;
        $draft_product = DraftProduct::where('customer_draft_Id', $id)->where('is_shipping_cost', 'Yes')->first();
        $shippingCost = $draft_product->final_unit_price;
        $discountedPrice += $shippingCost;

        $customer_draft->total_price = $discountedPrice;
        $customer_draft->original_price = $sub_total;
        $customer_draft->save();

        $responseArray = array(
            'taxGroupDiscount' => $taxGroupDiscount,
            'quantity' => $quantity, // Assuming $quantity is already set in your previous function
            'sub_total' => $sub_total,
            'item_price' => $item_price,
            'totalModificationPrice' => $totalModificationPrice,
            'discount' => $discount,
            'shippingCost' => $shippingCost,
            'discountedPrice' => $discountedPrice,
            'message' => $message

        );
        // return $responseArray;
        //     dd($responseArray);
        return response()->json($responseArray);



    }

    public function quantity_plus(Request $request)
    {

        $productId = $request->input('product_id');
        $draftStyleId = $request->input('draft_style_id');
        $draftProductId = $request->input('draft_product_id');

        $draft_product = DraftProduct::where('draft_product_id', $draftProductId)->where('draft_style_id', $draftStyleId)->where('is_shipping_cost', 'No')->first();

        // $draft_product_ids =  DraftProduct::where('customer_draft_id',$customerDraftId)->where('draft_style_id',$draftStyleId)->pluck('draft_product_id')->toArray();
        $accessory_quantities = DB::table('draft_product_accessories')->where('draft_product_id', $draft_product->draft_product_id)
            ->leftJoin('accessoriesmaster', 'draft_product_accessories.accessories_id', '=', 'accessoriesmaster.accessories_id')
            ->select('accessoriesmaster.accessories_id', 'accessoriesmaster.quantity')
            ->first();
        //  dd($accessory_quantities->quantity);
        if ($accessory_quantities) {
            if ($draft_product->quantity >= $accessory_quantities->quantity) {
                $quantity = $draft_product->quantity;
                $customer_draft_id = $draft_product->customer_draft_Id;
                $message = "Can not add more quanity ";
                return $this->count_price($customer_draft_id, $quantity, $message);
            }
        }
        $draft_product->quantity = $draft_product->quantity + 1;
        $quantity = $draft_product->quantity;
        $customer_draft_id = $draft_product->customer_draft_Id;
        $draft_product->save();
        $message = "";
        return $this->count_price($customer_draft_id, $quantity, $message);
    }
    public function quantity_minus(Request $request)
    {

        $productId = $request->input('product_id');
        $draftStyleId = $request->input('draft_style_id');
        $draftProductId = $request->input('draft_product_id');

        $draft_product = DraftProduct::where('draft_product_id', $draftProductId)->where('draft_style_id', $draftStyleId)->where('is_shipping_cost', 'No')->first();
        $customer_draft_id = $draft_product->customer_draft_Id;
        if ($draft_product->quantity >= 2) {
            $draft_product->quantity = $draft_product->quantity - 1;
            $quantity = $draft_product->quantity;
            $draft_product->save();
        } else {
            $quantity = $draft_product->quantity;
        }
        $message = "";
        return $this->count_price($customer_draft_id, $quantity, $message);
    }
    public function count_side_price($id, $side)
    {
        $sub_total = 0;
        $totalModificationPrice = 0;
        $item_price = 0;
        $user = Auth::user()->id;
        $taxGroup = Customer::select('tax_group', 'tax_rate')->where('user_id', $user)->first();
        // $taxRate = TaxGroup::pluck('tax_rate')->first();
        $taxRate = SalesTax::where('zip_code', '6516')->value('tax_rate');
        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
        $product = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
            ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
            ->where('draft_product.customer_draft_id', $id)
            ->select(
                'draft_product.*',
                'product_master.*',
                'product_item.description as product_description',
                'product_item.hinge_side as is_hinge_side',
                'product_item.finish_side as is_finish_side',
                'product_item.product_item_price as product_item_price',
                'product_item.cut_depth',
                'product_item.cut_depth_price'
            )
            ->get();
        // dd($product);
        foreach ($product as $data) {
            $price = $data->product_item_price;

            $hinge_price = DB::table('product_item_hinge_side')->where('product_id', $data->product_id)->first();
            if ($data->hinge_side == "L") {
                $price = $price + $hinge_price->left_hinge_side_price;
            } elseif ($data->hinge_side == "R") {
                $price = $price + $hinge_price->right_hinge_side_price;
            } elseif ($data->hinge_side == "B") {
                $price = $price + $hinge_price->both_hinge_side_price;
            }
            $finish_price = DB::table('product_item_finish_side')->where('product_id', $data->product_id)->first();
            if ($data->finish_side == "L") {
                $price = $price + $finish_price->left_finish_side_price;
            } elseif ($data->finish_side == "R") {
                $price = $price + $finish_price->right_finish_side_price;
            } elseif ($data->finish_side == "B") {
                $price = $price + $finish_price->both_finish_side_price;
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
                ->join('draft_product_modification', 'draft_product.draft_product_id', '=', 'draft_product_modification.draft_product_id')
                ->join('item_modification', function ($join) {
                    $join->on('draft_product_modification.modification_id', '=', 'item_modification.modification_id')
                        ->on('draft_product.product_id', '=', 'item_modification.product_id');
                })->value('total_modification_price');

            $AccessoriesPrice = DraftProduct::selectRaw('SUM(item_accessories.accessories_price ) AS total_accessories_price')
                ->where('draft_product.draft_product_id', $data->draft_product_id)
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
            $totalModificationPrice = $totalModificationPrice + $AccessoriesPrice + $DoorStylePrice;

            $itemTotalPrice = $data->product_item_price * $data->quantity;
            $item_price += $itemTotalPrice + $DoorStylePrice;
            $price = $price * $data->quantity;
            $sub_total += $sub_total + $price;
            $sub_total += $sub_total + $ModificationPrice + $AccessoriesPrice + $DoorStylePrice;
        }
        $discountedPrice = $sub_total * (1 - ($customer_draft->discount / 100));
        $discount = $customer_draft->discount;


        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
        $taxGroupDiscount = 0;
        if ($taxGroup->tax_group == "With Tax") {

            if ($customer_draft->service_type == "Self Pickup") {
                $taxGroupDiscount = $discountedPrice * ($taxRate / 100);
            } elseif ($customer_draft->service_type == "Curbside Delivery") {

                $taxGroupDiscount = $discountedPrice * ($customer_draft->zipcode_tax_rate / 100);
            } else {
                $taxGroupDiscount = $discountedPrice * ($customer_draft->zipcode_tax_rate / 100);
            }

            $discountedPrice += $taxGroupDiscount;
        }
        $shippingCost = 0;
        $draft_product = DraftProduct::where('customer_draft_Id', $id)->where('is_shipping_cost', 'Yes')->first();
        $shippingCost = $draft_product->final_unit_price;
        $discountedPrice += $shippingCost;

        // // $customer_draft->total_price =$discountedPrice;
        // $customer_draft->original_price =$sub_total;
        // dd($sub_total);
        // dd(ceil($sub_total * 100) / 100);
        // $customer_draft->original_price = ceil($sub_total * 100) / 100;
        $customer_draft->save();

        $responseArray = array(
            'side' => $side, // Assuming $quantity is already set in your previous function
            'sub_total' => $sub_total,
            'totalModificationPrice' => $totalModificationPrice,
            'discount' => $discount,
            'discountedPrice' => $discountedPrice,
            'item_price' => $item_price

        );
        // return $responseArray;
        //     dd($responseArray);
        return response()->json($responseArray);



    }
    public function add_hinge(Request $request)
    {
        $hinge = $request->input('hinge');
        $productId = $request->input('product_id');
        $draftProductId = $request->input('draft_product_id');
        $draftStyleId = $request->input('draft_style_id');

        $draft_product = DraftProduct::where('draft_product_id', $draftProductId)->where('draft_style_id', $draftStyleId)->where('is_shipping_cost', 'No')->first();
        $draft_product->hinge_side = $hinge;
        $customer_draft_id = $draft_product->customer_draft_Id;
        $draft_product->save();
        $this->draft_total($customer_draft_id);
        //   dd($customer_draft_id, $hinge);
        // return response()->json($hinge);
        return $this->count_side_price($customer_draft_id, $hinge);
    }
    public function add_finish_side(Request $request)
    {
        $finish_side = $request->input('finish');
        $productId = $request->input('product_id');
        $draftProductId = $request->input('draft_product_id');
        $draftStyleId = $request->input('draft_style_id');


        $draft_product = DraftProduct::where('draft_product_id', $draftProductId)->where('draft_style_id', $draftStyleId)->where('is_shipping_cost', 'No')->first();
        $draft_product->finish_side = $finish_side;
        $customer_draft_id = $draft_product->customer_draft_Id;
        $draft_product->save();
        $this->draft_total($customer_draft_id);
        // return response()->json($finish_side);
        return $this->count_side_price($customer_draft_id, $finish_side);
    }
    public function draft_product_store(Request $request, $customer_draft_id)
    {

        $CustomerDraft = CustomerDraft::where('customer_draft_id', $customer_draft_id)->first();
        $CustomerDraft->service_type = $request->service_type;
        $CustomerDraft->configuration = $request->configuration;
        $CustomerDraft->save();

        $draftCutdepthInch = DraftProduct::where('customer_draft_Id', $customer_draft_id)
            ->where('is_cut_depth', 'Yes')
            ->whereNull('selected_cut_depth')
            ->where('is_shipping_cost', 'No')
            ->get();


        $doorStyleConfig = CustomerDraftStyle::where('customer_draft_Id', $customer_draft_id)
            // ->whereNull('selected_cut_depth')
            ->where('configuration', null)
            ->get();

        $checkHinge = DraftProduct::leftJoin('product_item', 'product_item.product_id', 'draft_product.product_id')
            ->where('draft_product.customer_draft_Id', $customer_draft_id)
            ->where('draft_product.is_shipping_cost', 'No')
            ->where('product_item.hinge_side', 'Yes')
            ->whereNull('draft_product.hinge_side')
            ->select('draft_product.*', 'product_item.product_item_sku')
            ->get();

        $checkFinish = DraftProduct::leftJoin('product_item', 'product_item.product_id', 'draft_product.product_id')
            ->where('draft_product.customer_draft_Id', $customer_draft_id)
            ->where('draft_product.is_shipping_cost', 'No')
            ->where('product_item.finish_side', 'Yes')
            ->whereNull('draft_product.finish_side')
            ->select('draft_product.*', 'product_item.product_item_sku')
            ->get();


        $customerDraftStyleIds = CustomerDraftStyle::where('customer_draft_Id', $customer_draft_id)->pluck('draft_style_id');

        $missingStyleIds = $customerDraftStyleIds->diff(
            DraftProduct::where('customer_draft_Id', $customer_draft_id)->where('is_shipping_cost', 'No')->pluck('draft_style_id')
        );


        $DraftProduct_count = DraftProduct::where('customer_draft_Id', $customer_draft_id)->where('is_shipping_cost', 'No')->count();
        if ($DraftProduct_count == 0) {
            return redirect('new-draft/' . $customer_draft_id)->with('error', 'Error: Please Select Product');
        } elseif (!$draftCutdepthInch->isEmpty()) {
            return redirect('new-draft/' . $customer_draft_id)->with('error', 'Error: Please Select Cut depth inch');
        } elseif (!$doorStyleConfig->isEmpty()) {
            return redirect('new-draft/' . $customer_draft_id)->with('error', 'Error: Please Select configuration');
        } elseif (!$checkHinge->isEmpty()) {
            $missingHingeSkus = $checkHinge->pluck('product_item_sku')->implode(', ');
            return redirect('new-draft/' . $customer_draft_id)
                ->with('error', 'Error: Please Select Hinge Side for SKU(s): ' . $missingHingeSkus);

            // return redirect('new-draft/' . $customer_draft_id)->with('error', 'Error: Please Select Hinge Side');
        } elseif (!$checkFinish->isEmpty()) {

            $missingFinishSkus = $checkFinish->pluck('product_item_sku')->implode(', ');
            return redirect('new-draft/' . $customer_draft_id)
                ->with('error', 'Error: Please Select Finish Side for SKU(s): ' . $missingFinishSkus);
            // return redirect('new-draft/' . $customer_draft_id)->with('error', 'Error: Please Select Finish Side');
        } elseif ($missingStyleIds->isNotEmpty()) {
            return redirect('new-draft/' . $customer_draft_id)->with('error', 'Error: Please Select Product');
        } else {
            return redirect('add-cart/' . $customer_draft_id);
        }
    }
    public function addCart(Request $request, $customer_draft_Id)
    {
        //$custmer_draft_Id = CustomerDraftStyle::find($custmer_draft_Id);
        $pagename = "Add Cart";
        $user = Auth::user()->id;
        // dd($user);
        // $grup_discount = Customer::select('customer_group.group_dicount_percent')
        // ->leftJoin('customer_group','customer_group.customer_group_id','customer.customer_group_id')
        // ->where('customer.user_id',$user)
        // ->first();
        $customer_draft = CustomerDraft::where('customer_draft_id', $customer_draft_Id)->first();
        //    $customer = Customer:: where('user_id',$user)->first();
        //    $CustomerGroup = CustomerGroup::where('customer_group_id',$customer->customer_group_id)->first();


        // dd($customer_draft);
        //dd($customer_draft);
        $product = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
            ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
            ->where('draft_product.customer_draft_id', $customer_draft_Id)
            ->where('draft_product.customer_id', $user)
            ->select(
                'draft_product.*',
                'product_master.*',
                'product_item.description as product_description',
                'product_item.hinge_side as is_hinge_side',
                'product_item.finish_side as is_finish_side',
                'product_item.product_item_price as product_item_price',
                'product_item.cut_depth',
                'product_item.cut_depth_price'
            )
            ->get();
        // dd($product);


        return view('frontend.draft.add_cart', compact('customer_draft', 'product', 'customer_draft_Id', 'pagename'));
    }

    public function draft_product_destroy($id)
    {
        $DraftProduct = DraftProduct::find($id);
        $customer_draft_Id = $DraftProduct->customer_draft_Id;
        $DraftProduct->delete();
        //  $this->draft_total($id);
        $draft_product_count = DraftProduct::where('customer_draft_Id', $customer_draft_Id)->count();

        //   dd($draft_product_count);
        if ($draft_product_count == 0) {
            $this->draft_total($customer_draft_Id);
            // $json = array('status' => 'null'); 
            // echo json_encode($json);
            //    return redirect('new-draft/'.$customer_draft_Id);

            echo $customer_draft_Id;
        } else {
            $this->draft_total($customer_draft_Id);
            $customer_draft_Id = 0;
            echo $customer_draft_Id;

            // $json = array('status' => 'success'); 
            // echo json_encode($json);

        }

        //    echo $draft_product_count;
        // $responseData = [
        //     'status' => 'success',
        //     'count' => $draft_product_count,
        //     'customer_draft_id' => $customer_draft_Id,
        // ];

        // echo json_encode($responseData);

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

    public function order_mail($id)
    {
        $customer_draft_Id = $id;
        // $customer_draft_Id=598;
        $user = Auth::user()->id;
        $customer_draft = CustomerDraft::where('customer_draft_id', $customer_draft_Id)->first();
        $shippingCost = 0;
        $draft_product = DraftProduct::where('customer_draft_Id', $id)->where('is_shipping_cost', 'Yes')->first();
        $shippingCost = $draft_product->final_unit_price;
        //dd($customer_draft);
        $customerDraftStyles = CustomerDraftStyle::where('customer_draft_id', $customer_draft_Id)
            ->get();


        $taxGroup = Customer::select('tax_group', 'tax_rate')->where('user_id', $user)->first();
        $taxRate = TaxGroup::pluck('tax_rate')->first();
        $products = [];

        foreach ($customerDraftStyles as $customerDraftStyle) {
            $products[$customerDraftStyle->door_style_Id] = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
                ->leftJoin('product_item_hinge_side', 'draft_product.product_id', '=', 'product_item_hinge_side.product_id')
                ->leftJoin('product_item_finish_side', 'draft_product.product_id', '=', 'product_item_finish_side.product_id')
                ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
                ->leftJoin('customer_draft_style', 'customer_draft_style.draft_style_id', '=', 'draft_product.draft_style_id')
                ->leftJoin('door_style', 'door_style.doorStyle_id', '=', 'customer_draft_style.door_style_Id')
                ->where('draft_product.customer_draft_id', $customer_draft_Id)
                ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
                ->where('draft_product.customer_id', $user)
                ->select(
                    'draft_product.*',
                    'product_master.*',
                    'product_item.product_item_sku as product_item_sku',
                    'product_item.description as product_description',
                    'product_item.hinge_side as is_hinge_side',
                    'product_item.finish_side as is_finish_side',
                    'product_item.product_item_price as product_item_price',
                    'product_item.cut_depth',
                    'product_item.cut_depth_price',
                    'door_style.name',
                    'door_style.image',
                    'product_item_hinge_side.right_hinge_side_price',
                    'product_item_hinge_side.left_hinge_side_price',
                    'product_item_hinge_side.hinge_side_none',
                    'product_item_finish_side.right_finish_side_price',
                    'product_item_finish_side.left_finish_side_price',
                    'product_item_finish_side.both_finish_side_price',
                    'product_item_finish_side.finish_side_none',
                    'customer_draft_style.draft_style_id'
                )
                ->orderBy('draft_product.created_at', 'desc')
                ->get();
            foreach ($products[$customerDraftStyle->door_style_Id] as $product) {
                $modificationNames = DraftProduct::
                    leftJoin('draft_product_modification', 'draft_product_modification.draft_product_id', '=', 'draft_product.draft_product_id')
                    ->leftJoin('modificationmaster', 'modificationmaster.modification_id', '=', 'draft_product_modification.modification_id')
                    ->leftJoin('item_modification', function ($join) use ($product) {
                        $join->on('item_modification.modification_id', '=', 'draft_product_modification.modification_id')
                            ->where('item_modification.product_id', '=', $product->product_id);
                    })
                    ->leftJoin('customer_draft_style', 'customer_draft_style.draft_style_id', '=', 'draft_product.draft_style_id')
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
            //   $products = collect($products);
            //  dd($products);
            foreach ($products[$customerDraftStyle->door_style_Id] as $item) {

                $cut_depthIdExists = DB::table('item_cut_depth')
                    ->where('product_id', $item->product_id)
                    ->exists();
                // dd($cut_depthIdExists);
                $item->cutdepth_id_exists = $cut_depthIdExists;
                // dd($item->cutdepth_id_exists);
                $selectedCutDepth = DraftProduct::select('selected_cut_depth', 'draft_product_id as cut_depth_draft_id')
                    ->where('customer_draft_Id', $customer_draft_Id)
                    ->get();

                $item->selectedcut_depth = $selectedCutDepth;

                if ($cut_depthIdExists) {
                    $item->cut_depth_info = DB::table('item_cut_depth')
                        ->select('item_depth_id', 'depth_name_inch', 'product_id')
                        ->where('product_id', $item->product_id)
                        ->get();
                }
            }
            $pdf_data = CustomerDraft::select('customer.company_name', 'customer.representative_name', 'customer.address as customer_address', 'customer.contact_number as customer_no', 'customer.email', 'customer_draft.client_name', 'customer_draft.address as client_address', 'customer_draft.contact_no as client_no', 'customer_draft.po_number', 'customer_draft.service_type', 'customer_draft.designer', 'customer_draft.configuration', 'customer_draft.created_at', 'customer_draft.ship_name', 'customer_draft.ship_email', 'customer_draft.ship_contact_no', 'customer_draft.ship_address', 'customer_draft.ship_city', 'customer_draft.ship_zip_code', 'state_master.state_name as ship_state')
                ->leftjoin('customer', 'customer.user_id', 'customer_draft.customer_id')
                ->leftjoin('state_master', 'state_master.state_id', 'customer_draft.ship_state')
                ->where('customer_draft.customer_draft_id', $customer_draft_Id)
                ->first();

        }
        // dd($products);
        $newdata_arr = $products;
        $without_arr = $products;
        if ($customer_draft->payment_method == "Pay Later") {
            $watermark = "Pay Later";
        } else {
            $watermark = "Paid";
        }

        $data = [
            // 'title' => 'Welcome to .com',
            'pdf_data' => $pdf_data,
            'customer_draft' => $customer_draft,
            'products' => $products,
            'customer_draft_Id' => $customer_draft_Id,
            'newdata_arr' => $newdata_arr,
            'taxGroup' => $taxGroup,
            'watermark' => $watermark,
            'shippingCost' => $shippingCost,
            'taxRate' => $taxRate
        ];




        $pdf = PDF::loadView('frontend.pdf.Withprice', $data);
        $pdf->setPaper('L');
        $pdf->output();

        $domPdf = $pdf->getDomPDF();

        $canvas = $domPdf->get_canvas();

        $canvas->set_opacity(0.1);
        $pdfContent = $pdf->output();

        $cust = Customer::select('*')->where('user_id', $customer_draft->customer_id)->first();
        //dd( $cust);
        $approve = Customer::find($cust->customer_id);  //102 is customer id

        //dd($approve->email);

        $mail_draft = CustomerDraft::find($customer_draft_Id);
        $state = StateMaster::find($mail_draft->ship_state);

        $mail_products = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
            ->where('draft_product.customer_draft_id', $customer_draft_Id)
            ->where('draft_product.customer_id', $user)
            ->where('is_shipping_cost', "No")
            ->select('product_item.product_item_sku as product_item_sku')
            ->get();
        //dd($mail_products);
        $user_id = Auth::user()->id;
        $custEmail = [
            'custEmail' => $approve->email,
            'representative_name' => $approve->representative_name,
            'payment_method' => $mail_draft->payment_method,
            'user_id' => $user_id,
            'customer_draft_id' => $customer_draft->customer_draft_id,
            'created_at' => $customer_draft->created_at,
            'products' => $mail_products,
            'service_type' => $customer_draft->service_type,
            'total_price' => $customer_draft->total_price,
            'ship_address' => $mail_draft->ship_address,
            'ship_city' => $mail_draft->ship_city,
            'state_name' => $state,
            'ship_zip_code' => $mail_draft->ship_zip_code,
            'shippingCost' => $shippingCost,
            'customer_note' => $customer_draft->customer_note
        ];

        $pdf_name = $mail_draft->client_name . '_' . $mail_draft->po_number . '.pdf';

        Mail::send('email.place', $custEmail, function ($message) use ($custEmail, $pdfContent, $pdf_name) {
            $message->from('deluxewoodc@gmail.com', 'Deluxewood Cabinetry')
                ->to($custEmail['custEmail'])
                ->subject('Order Confirmation: DeluxeWood Cabinetry - Your Purchase is Successful!')
                ->attachData($pdfContent, $pdf_name, [
                    'mime' => 'application/pdf',
                ]);
        });




    }
    public function draft_destroy($id)
    {
        $customer_draft = CustomerDraft::find($id);
        $coupons = UsedCouponHistory::where('draft_id', $id);

        if ($coupons->exists()) {
            $coupons->delete();
        }
        CustomerDraftStyle::where('customer_draft_Id', $id)->delete();
        DraftProduct::where('customer_draft_Id', $id)->where('is_shipping_cost', 'No')->delete();
        if ($customer_draft->delete()) {

            $json = array('status' => 'success');
        } else {
            $json = array('status' => 'fail');
        }

        echo json_encode($json);
    }
    public function use_coupon($id, Request $request)
    {
        //UsedCouponHistory
        $total = $request->total_price;
        //    / dd($total);
        $coupon = CouponMaster::where('coupon_code', $request->coupon_code)->first();
        $user_id = Auth::user()->id;
        if ($coupon != null) {
            $expiryDate = Carbon::parse($coupon->expiry_date);
            $startingDate = Carbon::parse($coupon->starting_date);


            if ($expiryDate->isBefore(Carbon::today())) {
                return redirect('/add-cart/' . $id)->with('error', 'Error: This coupon has expired');
            }
            if ($startingDate->isAfter(Carbon::today())) {
                return redirect('/add-cart/' . $id)->with('error', 'Error: This coupon is not available ');
            }

            // Check time limit: how many times the user has used the coupon in the last 24 hours
            $timeLimit = $coupon->time_limit; // This should be fetched from the database

            // Calculate the start time based on the time limit
            $timeLimitStart = Carbon::now()->subHours($timeLimit);

            // Check the number of times the coupon was used by the user within the time limit
            $timeUsageCount = UsedCouponHistory::where('coupon_id', $coupon->coupon_id)
                ->where('user_id', $user_id)
                ->where('created_at', '>=', $timeLimitStart)
                ->count();

            if ($timeUsageCount >= 1) {
                return redirect('/add-cart/' . $id)->with('error', 'Error: This coupon has reached the time limit for your account.');
            }

            // Check use limit: how many times the user has used the coupon in total
            $totalUsageCount = UsedCouponHistory::where('coupon_id', $coupon->coupon_id)
                ->where('user_id', $user_id)
                ->where('created_at', '<=', $expiryDate)
                ->count();

            if ($totalUsageCount >= $coupon->use_limit) {
                return redirect('/add-cart/' . $id)->with('error', 'Error: This coupon has reached the usage limit for your account.');
            }

            $is_coupon_used = UsedCouponHistory::where('coupon_id', $coupon->coupon_id)->where('user_id', $user_id)->where('status', "Completed")->first();
            if ($is_coupon_used == null) {
                $is_coupon_applied = UsedCouponHistory::where('coupon_id', $coupon->coupon_id)->where('draft_id', $id)->first();
                if ($is_coupon_applied == null) {
                    if ($coupon->discount_type == "Fixed Amount") {
                        $discount = $coupon->discount;

                        // Check if the discount is greater than the order total
                        if ($discount > $total) {
                            return redirect('/add-cart/' . $id)->with('error', 'Error: This coupon cannot be applied as the discount exceeds the order total amount.');

                        }
                    }
                    $use_coupon = new UsedCouponHistory();
                    $use_coupon->user_id = $user_id;
                    $use_coupon->coupon_id = $coupon->coupon_id;
                    $use_coupon->discount = $coupon->discount;
                    $use_coupon->draft_id = $id;
                    $use_coupon->save();
                    return redirect('/add-cart/' . $id)->with('success', 'Coupon applied!');
                } else {
                    return redirect('/add-cart/' . $id)->with('error', 'Error: This coupon code has already been used.');
                }
            } else {
                return redirect('/add-cart/' . $id)->with('error', 'Error: This coupon code has already been used.');
            }
        } else {

            return redirect('/add-cart/' . $id)->with('error', 'Error: This coupon code is not available.');
        }

    }
    public function remove_coupon($id)
    {
        $used_coupon = UsedCouponHistory::find($id);
        $customer_draft_Id = $used_coupon->draft_id;


        if ($used_coupon->delete()) {
            echo $customer_draft_Id;
        } else {
            echo $customer_draft_Id;
        }

    }
    public function save_draft($status, $id, $total_price, $original_price)
    {


        //  $baseUrl = 'https://api.api-ninjas.com/v1/salestax';
        //  $zipCode = 10801;
        // $totalRate = 0;
        //     $response = Http::withHeaders([
        //         'X-Api-Key' =>env('API_NINJAS_KEY'),
        //     ])->get($baseUrl, [
        //         'zip_code' => $zipCode,
        //     ]);
        //     if ($response->successful()) {
        //         $taxInfo = $response->json();
        //         $totalRate = isset($taxInfo[0]['total_rate']) ? $taxInfo[0]['total_rate'] : null;

        //         if ($totalRate !== null) {
        //             $totalRateDivided = floatval($totalRate) * 100;
        //             return response()->json(['total_rate_divided_by_100' => $totalRateDivided]);
        //         } else {
        //             return response()->json(['error' => 'Total rate not found in API response'], 500);
        //         }
        //     }
        //     dd($totalRate);



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

        // dd($product);
        foreach ($product as $data) {
            // $door_style_Id = $data->door_style_configuration;
            // dd($door_style_Id);
            // if($draft_style_id != $data->draft_style_id){
            //     $draft_style_id = $data->draft_style_id;
            // }

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


        }


        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
        $customer_draft->tax_rate = $taxRate;
        $customer_draft->total_price = $total_price;
        $customer_draft->original_price = $original_price;


        // $DraftProduct = DraftProduct::where('customer_draft_id',$id)->first();
        // $DraftProduct->total_price =$price;
        // $DraftProduct->save();
        $draft_payment_method = CustomerDraft::where('customer_draft_id', $id)->first();
        if ($status == "save") {
            $customer_draft->draft_status = "Save";
            $customer_draft->save();
            return redirect('/dashboard')->with('success', 'Draft Save!');
        } elseif ($status == "pay_later") {

            $draft_payment_method->payment_method = "Pay Later";
            $customer_draft->draft_status = "Quotation";
            $customer_draft->order_date = Carbon::today();
            $customer_draft->save();
            $draft_payment_method->save();
            $this->order_mail($customer_draft->customer_draft_id);
            $custEmail = CustomerDraft::select('customer.email', 'customer.representative_name', 'customer_draft.customer_draft_id', 'customer_draft.created_at', 'customer_draft.payment_method', 'customer_draft.ship_address', 'customer_draft.ship_city', 'customer_draft.ship_zip_code', 'state_master.state_name', 'customer_draft.client_name', 'customer_draft.client_email', 'customer_draft.po_number', 'customer_draft.service_type', 'customer_draft.total_price')
                ->leftJoin('customer', 'customer.user_id', 'customer_draft.customer_id')
                ->leftJoin('state_master', 'state_master.state_id', 'customer_draft.ship_state')
                ->where('customer_draft_id', $id)
                ->first();
            $products = DraftProduct::select('product_master.product_name')
                ->leftJoin('product_master', 'product_master.product_id', 'draft_product.product_id')
                ->where('draft_product.customer_draft_Id', $id)
                ->get();
            $user_id = Auth::user()->id;
            $data_array = [
                'id' => $id,
                'email' => $custEmail->email,
                'custEmail' => $custEmail,
                'products' => $products,
                'user_id' => $user_id,
            ];


            try {
                Mail::send('email.new_order_alert', $data_array, function ($message) use ($data_array) {
                    $message->from('deluxewoodc@gmail.com', 'Deluxewood Cabinetry')
                        ->to('info@deluxewoodcabinetry.com')
                        ->subject('New Order Alert: DeluxeWood Cabinetry - Order #' . $data_array['id']);

                    $EmailLog = new EmailAuditLog();
                    $EmailLog->from = 'deluxewoodc@gmail.com';
                    $EmailLog->to = 'info@deluxewoodcabinetry.com';
                    $EmailLog->subject = 'New Order Alert: DeluxeWood Cabinetry - Order #' . $data_array['id'];
                    $EmailLog->user_id = $data_array['user_id'];
                    $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
                    $EmailLog->save();
                });
            } catch (\Exception $e) {
                dd($e->getMessage());
            }





            return redirect('/dashboard')->with('success', 'Order Placed !');

        } elseif ($status == "quickbooks") {
            $user_data = User::find($user);
            $user_data->quickbooks_draft_id = $id;
            $user_data->save();
            $draft_payment_method->payment_method = "Card";
            $draft_payment_method->save();
            $product = DraftProduct::where('customer_draft_Id', $id)->get();
            return redirect()->route('initiate-payment', ['id' => $id]);
        } else {
            $draft_payment_method->payment_method = "Card";
            $draft_payment_method->save();
            // $customer_draft->draft_status ="Quotation";
            $customer_draft->order_date = Carbon::today();
            $customer_draft->save();


            $product = DraftProduct::where('customer_draft_Id', $id)->get();
            // return redirect('card-payment/'.$id);

            return redirect()->route('card-payment', ['id' => $id]);
            return redirect('/credit-card/authentication/' . $id);
        }
    }

    public function save_stay_draft($status, $id, $total_price, $original_price)
    {

        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
        $user = Auth::user()->id;
        $taxGroup = Customer::select('tax_group', 'tax_rate')->where('user_id', $user)->first();

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

        // dd($product);
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
            if ($customer_draft->configuration == "Unassembled") {
                $configurationDiscount = $sub_total * ($unassembled_discount->unassembled_discount / 100);

                $total -= $configurationDiscount;
            }

            $groupDiscount = $total * ($customer_draft->discount / 100);
            $total -= $groupDiscount;

            $shippingCost = 0;
            if ($customer_draft->service_type == "Curbside Delivery") {
                $shippingCost = 150;
            } elseif ($customer_draft->service_type == "In-house Delivery") {
                $shippingCost = 250;
            }

            $total += $shippingCost; // Add cart Final total Match 

            $draft_product = DraftProduct::find($data->draft_product_id);
            $draft_product->unit_price = $price;
            $draft_product->sub_total_price = $sub_total;
            // $additionalGroupDiscount_unit = $price * ($grup_discount->group_dicount_percent / 100);


            $unassembled_discount = UnassembledDiscount::find(1);
            if ($data->door_style_configuration == "Unassembled") {
                $configurationDiscount_unit = $price * ($unassembled_discount->unassembled_discount / 100);

                $price -= $configurationDiscount_unit;

                // $draft_product->final_unit_price = $price * (1 - ($customer_draft->discount / 100)) - $configurationDiscount_unit;
            }
            $unit_discount = $price * ($customer_draft->discount / 100);
            $price -= $unit_discount;

            $taxRate = $taxGroup->tax_rate;
            $taxGroupDiscount = $price * ($taxRate / 100);
            $price += $taxGroupDiscount;

            $draft_product->final_unit_price = $price;
            $draft_product->total_price = $total;
            $draft_product->save();


        }


        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();

        $customer_draft->total_price = $total_price;
        $customer_draft->original_price = $original_price;

        if ($status == "save") {
            $customer_draft->draft_status = "Save";
            $customer_draft->save();
            return redirect()->back()->with('success', 'Draft saved!');
        }
    }

    public function card_payment($id)
    {
        try {
            // Authenticate user
            $user = Auth::user();
            if (!$user) {
                return redirect('/add-cart/' . $id)->with('error', 'User not authenticated.');
            }
    
            // Fetch customer draft and tax group
            $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
            if (!$customer_draft) {
                return redirect('/add-cart/' . $id)->with('error', 'Customer draft not found.');
            }
    
            $taxGroup = Customer::select('tax_group', 'tax_rate')
                ->where('user_id', $user->id)
                ->first();
            if (!$taxGroup) {
                return redirect('/add-cart/' . $id)->with('error', 'Tax group not found.');
            }
    
            // Fetch draft products
            $items = DraftProduct::leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
                ->leftJoin('product_item', 'product_master.product_id', '=', 'product_item.product_id')
                ->select(
                    'product_master.product_name',
                    'draft_product.final_unit_price',
                    'draft_product.withoutTax_unit_price',
                    'product_item.product_item_price',
                    'draft_product.quantity'
                )
                ->where('customer_draft_Id', $id)
                ->where('is_shipping_cost', 'No')
                ->get();
    
            if ($items->isEmpty()) {
                return redirect('/add-cart/' . $id)->with('error', 'No items found in the draft.');
            }
    
            // Initialize Stripe
            $stripeKey = config('services.stripe.key');
            if (!$stripeKey) {
                \Log::error('Stripe key is not configured in services.stripe.key or .env');
                return redirect('/add-cart/' . $id)->with('error', 'Stripe configuration error. Please contact support.');
            }
    
            // Validate that the key is a secret key
            if (strpos($stripeKey, 'pk_') === 0) {
                \Log::error('Invalid Stripe key: Publishable key used instead of secret key');
                return redirect('/add-cart/' . $id)->with('error', 'Invalid Stripe configuration: Publishable key detected. Please contact support.');
            }
    
            \Stripe\Stripe::setApiKey($stripeKey);
    
            // Validate address fields (required for customer creation, even if not using automatic tax)
            $address = [
                'line1' => $customer_draft->ship_address,
                'city' => $customer_draft->ship_city,
                'state' => $customer_draft->ship_state,
                'postal_code' => $customer_draft->ship_zip_code,
                'country' => 'US',
            ];
    
            // Log address for debugging
            \Log::info('Customer address for Stripe: ' . json_encode($address));
    
            // Check if address is complete
            $requiredAddressFields = ['line1', 'city', 'state', 'postal_code', 'country'];
            foreach ($requiredAddressFields as $field) {
                if (empty($address[$field])) {
                    \Log::error("Missing or empty address field: {$field}");
                    return redirect('/add-cart/' . $id)->with('error', 'Please provide a complete shipping address (address, city, state, postal code, country).');
                }
            }
    
            // Prepare line items
            $lineItems = [];
            $taxRateKey = env('TAX_RATE');
            $applyTax = $taxGroup->tax_group === 'With Tax' && !empty($taxRateKey);
    
            foreach ($items as $item) {
                // Calculate unit price in cents and ensure it's an integer
                $unit_price = ($taxGroup->tax_group === 'With Tax' ? $item->withoutTax_unit_price : $item->final_unit_price) * 100;
                $unit_price = (int) round($unit_price); // Ensure integer for Stripe
    
                // Log for debugging
                \Log::info("Line item price for {$item->product_name}: {$unit_price} cents");
    
                $lineItem = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item->product_name,
                        ],
                        'unit_amount' => $unit_price,
                    ],
                    'quantity' => (int) $item->quantity, // Ensure quantity is an integer
                ];
    
                if ($applyTax) {
                    $lineItem['tax_rates'] = [$taxRateKey];
                }
    
                $lineItems[] = $lineItem;
            }
    
            // Create or update Stripe customer
            $customer = \Stripe\Customer::create([
                'email' => $user->email,
                'name' => $user->name,
                'address' => $address,
            ]);
    
            $user->customer_stripe_id = $customer->id;
            $user->save();
    
            // Fetch shipping cost
            $shipping_cost = DraftProduct::where('customer_draft_Id', $id)
                ->where('is_shipping_cost', 'Yes')
                ->first();
    
            if (!$shipping_cost) {
                return redirect('/add-cart/' . $id)->with('error', 'Shipping cost not found.');
            }
    
            // Calculate shipping amount in cents and ensure it's an integer
            $shipping_amount = (int) round($shipping_cost->final_unit_price * 100);
            \Log::info("Shipping amount: {$shipping_amount} cents");
    
            // Create Stripe Checkout session
            $sessionParams = [
                'customer' => $customer->id,
                'line_items' => $lineItems,
                'payment_method_types' => ['card'],
                'mode' => 'payment',
                'success_url' => route('success', ['id' => $id]) . '?payment_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('add-cart', ['customer_draft_Id' => $id]),
                'shipping_options' => [
                    [
                        'shipping_rate_data' => [
                            'type' => 'fixed_amount',
                            'fixed_amount' => [
                                'amount' => $shipping_amount,
                                'currency' => 'usd',
                            ],
                            'display_name' => 'Standard Shipping',
                        ],
                    ],
                ],
                // Allow Stripe to update the customer’s address from the checkout form (still useful for customer data)
                'customer_update' => [
                    'address' => 'auto',
                    'shipping' => 'auto',
                ],
                // Add order ID to the payment intent description
                'payment_intent_data' => [
                    'description' => "Order ID: {$id}",
                ],
            ];
    
            $session = \Stripe\Checkout\Session::create($sessionParams);
    
            // Update draft status
            $customer_draft->draft_status = 'Save';
            $customer_draft->save();
    
            // Redirect to Stripe Checkout
            return redirect()->away($session->url);
    
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $errorMessage = $e->getError()->code === 'parameter_invalid_address'
                ? 'Please enter a valid shipping address.'
                : 'An error occurred during payment processing: ' . $e->getMessage();
            \Log::error('Stripe Error: ' . $e->getMessage());
            return redirect('/add-cart/' . $id)->with('error', $errorMessage);
        } catch (\Exception $e) {
            \Log::error('Unexpected Error: ' . $e->getMessage());
            return redirect('/add-cart/' . $id)->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }
    
    public function bank_payment()
    {
        $pagename = "Bank Payment";
        return view('frontend.draft.bank_payment', compact('pagename'));
    }
    public function success(Request $request, $id, $payment_id = null)
    {
        // dd($id);
        $user_id = Auth::user()->id;
        $pagename = "Payment Sucess";
        $payment_id = $request->get('payment_id');


        // dd($paymentMethodId);
        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
        $customer_draft->checkout_session_id = $payment_id;
        $customer_draft->draft_status = 'Quotation';
        $customer_draft->save();

        $quantity = CustomerDraft::select('draft_product.quantity', 'product_master.inventory_quantity', 'draft_product.product_id')
            ->leftJoin('draft_product', 'draft_product.customer_draft_id', 'customer_draft.customer_draft_id')
            ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
            ->where('customer_draft.customer_draft_id', $id)->get();

        // Update the inventory_quantity in ProductMaster
        foreach ($quantity as $item) {
            $product = ProductMaster::find($item->product_id);
            if ($product) {
                $newInventoryQuantity = $product->inventory_quantity - $item->quantity;
                // Make sure the inventory quantity doesn't go below 0
                $newInventoryQuantity = max(0, $newInventoryQuantity);
                $product->inventory_quantity = $newInventoryQuantity;
                $product->save();
            }
        }

        $custEmail = CustomerDraft::select('customer.email', 'customer.representative_name', 'customer_draft.customer_draft_id', 'customer_draft.created_at', 'customer_draft.ship_address', 'customer_draft.ship_city', 'customer_draft.ship_zip_code', 'state_master.state_name', 'customer_draft.client_name', 'customer_draft.client_email', 'customer_draft.po_number', 'customer_draft.service_type', 'customer_draft.total_price')
            ->leftJoin('customer', 'customer.user_id', 'customer_draft.customer_id')
            ->leftJoin('state_master', 'state_master.state_id', 'customer_draft.ship_state')
            ->where('customer_draft_id', $id)
            ->first();
        $products = DraftProduct::select('product_master.product_name')
            ->leftJoin('product_master', 'product_master.product_id', 'draft_product.product_id')
            ->where('draft_product.customer_draft_Id', $id)
            ->get();


        // Send Mail Customer

        $data_array = [
            'email' => $custEmail->email,
            'custEmail' => $custEmail,
            'products' => $products,
            'user_id' => $user_id,
        ];
        $cust_id = $customer_draft->customer_draft_id;

        // try {
        //     Mail::send('email.place_order', $data_array, function ($message) use ($data_array) {
        //         $message->from('deluxewoodc@gmail.com', 'Deluxewood Cabinetry')
        //                 ->to($data_array['email'])
        //                 ->subject('Order Confirmation: DeluxeWood Cabinetry - Your Purchase is Successful!');

        //      $EmailLog = new EmailAuditLog();  
        //      $EmailLog->from = 'deluxewoodc@gmail.com';
        //      $EmailLog->to = $data_array['email'];
        //      $EmailLog->subject = 'Order Confirmation: DeluxeWood Cabinetry - Your Purchase is Successful!';
        //      $EmailLog->user_id = $data_array['user_id'];
        //      $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        //      $EmailLog->save();

        //     });
        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        // }
        try {

            $this->order_mail($cust_id);


            $EmailLog = new EmailAuditLog();
            $EmailLog->from = 'deluxewoodc@gmail.com';
            $EmailLog->to = $data_array['email'];
            $EmailLog->subject = 'Order Confirmation: DeluxeWood Cabinetry - Your Purchase is Successful!';
            $EmailLog->user_id = $data_array['user_id'];
            $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
            $EmailLog->save();

            // });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }


        // Send Mail Admin

        $data_array = [
            'id' => $id,
            'email' => $custEmail->email,
            'custEmail' => $custEmail,
            'products' => $products,
            'user_id' => $user_id,
        ];

        try {
            Mail::send('email.new_order_alert', $data_array, function ($message) use ($data_array) {
                $message->from('deluxewoodc@gmail.com', 'Deluxewood Cabinetry')
                    ->to('info@deluxewoodcabinetry.com')
                    ->subject('New Order Alert: DeluxeWood Cabinetry - Order #' . $data_array['id']);

                $EmailLog = new EmailAuditLog();
                $EmailLog->from = 'deluxewoodc@gmail.com';
                $EmailLog->to = 'info@deluxewoodcabinetry.com';
                $EmailLog->subject = 'New Order Alert: DeluxeWood Cabinetry - Order #' . $data_array['id'];
                $EmailLog->user_id = $data_array['user_id'];
                $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
                $EmailLog->save();
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return view('frontend.draft.success', compact('pagename'));

    }

    public function credit_card_authentication($customer_draft_Id)
    {
        $pagename = "Credit Card Authentication";
        $customer_id = Auth::user()->id;
        $credit_card = CreditCard::where('customer_id', $customer_id)->get();


        return view('frontend.draft.credit_card_authentication', compact('customer_draft_Id', 'credit_card', 'pagename'));
    }


    public function store_credit_card($customer_draft_Id, CreditcardForm $request)
    {
        if ($request->ajax()) {
            return true;
        }
        $customer_id = Auth::user()->id;

        $payment = new CreditCard();
        $payment->customer_id = $customer_id;
        $payment->credit_card_number = $request->credit_card_number;
        $payment->credit_card_type = $request->credit_card_type;
        $payment->card_member_name = $request->card_member_name;
        $payment->expiration_date = $request->expiration_date;
        $payment->billing_address = $request->billing_address;
        $payment->phone = $request->phone;

        $payment->save();



        return redirect('payment/' . $customer_draft_Id);
    }

    public function order($customer_draft_Id)
    {
        $pagename = "Order";
        $customer_id = Auth::user()->id;
        $credit_card = CreditCard::where('customer_id', $customer_id)->get();
        $customer_draft = CustomerDraft::where('customer_draft_id', $customer_draft_Id)->first();

        return view('frontend.draft.order', compact('customer_draft_Id', 'credit_card', 'customer_draft', 'pagename'));
    }

    public function AddServices(Request $request)
    {
        $service = CustomerDraft::where('customer_draft_id', $request->draft_id)->first();
        dd($request->draft_id);
        $service->service_type = $request->service;
        $service->configuration = $request->configuration;
        $service->save();
    }
    public function refresh_draft($status, $id, $total_price, $original_price)
    {



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

        // dd($product);
        foreach ($product as $data) {
            // $door_style_Id = $data->door_style_configuration;
            // dd($door_style_Id);
            // if($draft_style_id != $data->draft_style_id){
            //     $draft_style_id = $data->draft_style_id;
            // }

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


        }


        $customer_draft = CustomerDraft::where('customer_draft_id', $id)->first();
        $customer_draft->tax_rate = $taxRate;
        $customer_draft->total_price = $total_price;
        $customer_draft->original_price = $original_price;


        // $DraftProduct = DraftProduct::where('customer_draft_id',$id)->first();
        // $DraftProduct->total_price =$price;
        // $DraftProduct->save();
        $draft_payment_method = CustomerDraft::where('customer_draft_id', $id)->first();
        if ($status == "save") {
            $customer_draft->draft_status = "Save";
            $customer_draft->save();
            $responseArray = array(
                'status' => 'success',
                'message' => "done",
            );
            return response()->json($responseArray);
        }
    }


    // EDIT AND UPDATE DRAFT FUCNTION ADDED BY SHIVANI ON 27-5-25
    public function edit($id)
    {
        $customerDraft = CustomerDraft::findOrFail($id);
        $CustomerGroup = CustomerDraft::where('customer_id', $customerDraft->customer_id)->first();
        $states = StateMaster::all();
        // return view('frontend.draft.customer_edit_draft', compact('customerDraft', 'CustomerGroup','states'));
        return view('frontend.draft.customer_edit_draft', [
            'customerDraft' => $customerDraft,
            'CustomerGroup' => $CustomerGroup,
            'states' => $states,
            'pagename' => 'Customer Profile Edit', // or whatever the page name is
        ]);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'po_number' => 'required|string|max:255',
            'designer' => 'nullable|string|max:255',
            'ship_name' => 'required|string|max:255',
            'ship_email' => 'required|email',
            'ship_contact_no' => 'required|string|max:20',
            'ship_address' => 'required|string|max:255',
            'ship_state' => 'required',
            'ship_city' => 'required|string|max:255',
            'ship_zip_code' => 'required|string|max:20',
        ]);

        $cus_draft = CustomerDraft::findOrFail($id);
        $cus_draft->po_number = $request->po_number;
        $cus_draft->designer = $request->designer;
        $cus_draft->discount = $request->discount;
        $cus_draft->ship_name = $request->ship_name;
        $cus_draft->ship_email = $request->ship_email;
        $cus_draft->ship_contact_no = $request->ship_contact_no;
        $cus_draft->ship_address = $request->ship_address;
        $cus_draft->ship_state = $request->ship_state;
        $cus_draft->ship_city = $request->ship_city;
        $cus_draft->ship_zip_code = $request->ship_zip_code;

        $tax_rate = SalesTax::where('zip_code', $request->ship_zip_code)->value('tax_rate');
        $cus_draft->zipcode_tax_rate = $tax_rate;

        $cus_draft->save();

        return redirect('/door-style/' . $cus_draft->customer_draft_id)->with('success', 'Customer Draft Updated Successfully');
    }


}


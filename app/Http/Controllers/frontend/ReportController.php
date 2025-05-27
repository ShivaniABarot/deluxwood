<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreditcardForm;
use App\Models\CustomerDraft;
use App\Models\Customer;
use App\Models\DraftProduct;
use App\Models\ProductMaster;
use DB;
Use App\Models\CustomerDraftStyle;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    public function index()
    {   
        $pagename = "Report";
        return view('frontend.report.index',compact('pagename'));
    } 
    public function orderHistory(Request $request)
    {
        $pagename = "Order History";
        $user_id = Auth::user()->id;
        $order_nu = CustomerDraft::select('customer_draft_id')
         ->leftjoin('customer', 'customer.user_id', 'customer_draft.customer_id')
        ->where('customer_draft.customer_id', $user_id)
        ->where(function($query) {
            $query->where('customer_draft.draft_status', 'Quotation')
                  ->orWhere('customer_draft.draft_status', 'Save');
        })
        ->get();
         // dd($order_nu);
        $query = CustomerDraft::select('customer_draft.customer_draft_id', 'customer_draft.created_at', 'customer.representative_name as customer_name', 'customer_draft.total_price')
        ->leftjoin('customer', 'customer.user_id', 'customer_draft.customer_id')
        ->where('customer_draft.customer_id', $user_id)
        ->where(function($query) {
            $query->where('customer_draft.draft_status', 'Quotation')
                  ->orWhere('customer_draft.draft_status', 'Save');
        })
        ->get();

        if ($request->filled('customer_draft_id')) {
            $query->where('customer_draft.customer_draft_id', $request->input('customer_draft_id'));
        }
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('customer_draft.created_at', [$request->input('from_date'), $request->input('to_date')]);
        }

        $order_history = $query->sortByDesc('created_at');

       
        return view('frontend.report.order_history',compact('order_history','order_nu','pagename'));
    }
    public function salesOrders($id)
    {
        $pagename = "Sales Orders";
        $customer_id = Auth::user()->id;

        $sales_data = DraftProduct::select('draft_product.product_id','product_item.product_item_name','product_item.description','draft_product.quantity','product_item.product_item_sku','customer_draft.total_price','draft_product.hinge_side','draft_product.finish_side','customer_draft.configuration','draft_product.draft_product_id')
        ->leftjoin('product_item','product_item.product_id','=','draft_product.product_id')
        ->leftjoin('customer_draft_style','customer_draft_style.draft_style_id','draft_product.draft_style_id')
        ->leftjoin('customer_draft','customer_draft.customer_draft_id','draft_product.customer_draft_id')
        ->where('draft_product.customer_draft_id',$id)
        ->get();

        $accessoriesNames = DraftProduct::leftJoin('draft_product_accessories', 'draft_product_accessories.draft_product_id', '=', 'draft_product.draft_product_id')
        ->leftJoin('accessoriesmaster', 'accessoriesmaster.accessories_id', '=', 'draft_product_accessories.accessories_id')
        ->where('draft_product.customer_draft_id', $id)
        ->where('draft_product.customer_id', $customer_id)
        ->select(
            'draft_product.draft_product_id',
            'accessoriesmaster.accessories_nm as accessories_nm'
        )
        ->get()
        ->groupBy('draft_product_id');

        $ModificationNames = DraftProduct::leftJoin('draft_product_modification', 'draft_product_modification.draft_product_id', '=', 'draft_product.draft_product_id')
        ->leftJoin('modificationmaster', 'modificationmaster.modification_id', '=', 'draft_product_modification.modification_id')
        ->where('draft_product.customer_draft_id', $id)
        ->where('draft_product.customer_id', $customer_id)
        ->select(
            'draft_product.draft_product_id',
            'modificationmaster.modification_nm as 	modification_nm'
        )
        ->get()
        ->groupBy('draft_product_id');

        // dd($accessoriesNames);

        $pdf_data = CustomerDraft::select('customer.company_name','customer.representative_name','customer.address as customer_address','customer.contact_number as customer_no','customer.email','customer_draft.client_name','customer_draft.address as client_address','customer_draft.contact_no as client_no','customer_draft.po_number','customer_draft.service_type','customer_draft.designer','customer_draft.configuration','customer_draft.created_at')
        ->leftjoin('customer','customer.user_id','customer_draft.customer_id')
        ->where('customer_draft.customer_draft_id',$id)
        ->first();

        $door_style = DraftProduct::select('door_style.name')
        ->leftjoin('customer_draft_style','customer_draft_style.draft_style_id','draft_product.draft_style_id')
        ->leftjoin('door_style','door_style.doorStyle_id','=','customer_draft_style.door_style_Id')
        ->where('draft_product.customer_draft_id',$id)
        ->first();
        // dd($door_style);

        
        return view('frontend.report.sales_orders',compact('sales_data','pdf_data','pagename','door_style','accessoriesNames','ModificationNames'));
    }
    public function inventoryLevels()
    {
        $pagename = "Inventory Levels";
        $product = ProductMaster::select('product_name')->get();
        return view('frontend.report.inventory_levels',compact('product','pagename'));
    }
    public function salesTest()
    {
        $pagename = "Add Cart";
        $customer_draft_Id = '457';
        $user = Auth::user()->id;
        $customer_draft = CustomerDraft::where('customer_draft_id',$customer_draft_Id)->first();
        $grup_discount = Customer::select('customer_group.group_dicount_percent')
       ->leftJoin('customer_group','customer_group.customer_group_id','customer.customer_group_id')
       ->where('customer.user_id',$user)
       ->first();
        $customerDraftStyles = CustomerDraftStyle::where('customer_draft_id', $customer_draft_Id)
            ->get();
       
        $products = [];

        foreach ($customerDraftStyles as $customerDraftStyle) {
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

           
            // $accessoriesNames = DB::table('draft_product')
            // ->leftJoin('draft_product_accessories', 'draft_product_accessories.draft_product_id', '=', 'draft_product.draft_product_id')
            // ->leftJoin('accessoriesmaster', 'accessoriesmaster.accessories_id', '=', 'draft_product_accessories.accessories_id')
            // ->leftJoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
            // ->where('draft_product.customer_draft_id', $customer_draft_Id)
            // ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
            // ->where('draft_product.customer_id', $user)
            // ->select(
            //     'draft_product.draft_product_id',
            //     'accessoriesmaster.accessories_nm as accessories_nm',
            // )
            // ->get()
            // ->groupBy('draft_product_id');

            // $modificationNames = DB::table('draft_product')
            // ->leftJoin('draft_product_modification', 'draft_product_modification.draft_product_id', '=', 'draft_product.draft_product_id')
            // ->leftJoin('modificationmaster', 'modificationmaster.modification_id', '=', 'draft_product_modification.modification_id')
            // ->leftJoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
            // ->where('draft_product.customer_draft_id', $customer_draft_Id)
            // ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
            // ->where('draft_product.customer_id', $user)
            // ->select(
            //     'draft_product.draft_product_id',
            //     'modificationmaster.modification_nm as modification_nm'
            // )
            // ->get()
            // ->groupBy('draft_product_id');

           
            // foreach ($products[$customerDraftStyle->door_style_Id] as $product) {
            //     $product->accessories_nm = $accessoriesNames->get($product->draft_product_id, []);
            // }

            // foreach ($products[$customerDraftStyle->door_style_Id] as $product) {
            //     $product->modification_nm = $modificationNames->get($product->draft_product_id, []);
            // }
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
         // dd($products);
        $newdata_arr = $products;
        $without_arr = $products;

        return view('frontend.report.test',compact('customer_draft','products','customer_draft_Id','newdata_arr','without_arr','pagename','pdf_data','grup_discount'));
    }
 
}


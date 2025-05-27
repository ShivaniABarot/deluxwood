<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreditcardForm;
use App\Models\CustomerDraft;
use App\Models\Customer;
use App\Models\DraftProduct;
use App\Models\ProductMaster;
use DB;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    public function index()
    {
        $pagename = "Report";
        return view('backend.report.index',compact('pagename'));
    } 
    public function orderHistory(Request $request)
    {
        $pagename = "Order History";
        $order_nu = CustomerDraft::select('customer_draft_id')->get();
        $query = CustomerDraft::select('customer_draft.customer_draft_id', 'customer_draft.created_at', 'customer.representative_name as customer_name', 'customer_draft.total_price')
        ->leftjoin('customer', 'customer.user_id', 'customer_draft.customer_id');
        

        if ($request->filled('customer_draft_id')) {
            $query->where('customer_draft.customer_draft_id', $request->input('customer_draft_id'));
        }
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('customer_draft.created_at', [$request->input('from_date'), $request->input('to_date')]);
        }

        $order_history = $query->latest()->get();
        return view('backend.report.order_history',compact('order_nu','order_history','pagename'));  
    }
    public function salesPerformance($id)
    {
        $pagename = "Sales Performance";

        $sales_data = DraftProduct::select('draft_product.product_id','product_item.product_item_name','product_item.description','draft_product.quantity','product_item.product_item_sku','customer_draft.total_price','draft_product.hinge_side','draft_product.finish_side')
        ->leftjoin('product_item','product_item.product_id','=','draft_product.product_id')
        ->leftjoin('customer_draft_style','customer_draft_style.draft_style_id','draft_product.draft_style_id')
        ->leftjoin('customer_draft','customer_draft.customer_draft_id','draft_product.customer_draft_id')
        ->where('draft_product.customer_draft_id',$id)
        ->get();    

        $pdf_data = CustomerDraft::select('customer.company_name','customer.representative_name','customer.address as customer_address','customer.contact_number as customer_no','customer.email','customer_draft.client_name','customer_draft.address as client_address','customer_draft.contact_no as client_no','customer_draft.po_number','customer_draft.service_type','customer_draft.designer','customer_draft.configuration','customer_draft.created_at')
        ->leftjoin('customer','customer.user_id','customer_draft.customer_id')
        ->where('customer_draft.customer_draft_id',$id)
        ->first();

        return view('backend.report.sales_performance',compact('sales_data','pagename','pdf_data'));
    }
    public function customerList()
    {
        $pagename = "Customer List";
        $customer_list = Customer::select('customer_id','company_name','representative_name','contact_number','email','address')->latest()->get();

        return view('backend.report.customer_list',compact('customer_list','pagename'));
    }
    public function orderPdf()
    {
         $customer_draft_Id = '297';
         $pagename = "pdf";
         $customer_draft = CustomerDraft::where('customer_draft_id',$customer_draft_Id)->first();
         $user = Auth::user()->id;

         $pdf_data = CustomerDraft::select('customer.company_name','customer.representative_name','customer.address as customer_address','customer.contact_number as customer_no','customer.email','customer_draft.client_name','customer_draft.address as client_address','customer_draft.contact_no as client_no','customer_draft.po_number','customer_draft.service_type','customer_draft.designer','customer_draft.configuration','customer_draft.created_at')
         ->leftjoin('customer','customer.user_id','customer_draft.customer_id')
         ->where('customer_draft.customer_draft_id',$customer_draft_Id)
         ->first();

          $grup_discount = Customer::select('customer_group.group_dicount_percent')
         ->leftJoin('customer_group','customer_group.customer_group_id','customer.customer_group_id')
         ->where('customer.user_id',$customer_draft->customer_id)
         ->first();
         // dd($grup_discount);
          $customerDraftStyles = DB::table('customer_draft_style')
              ->where('customer_draft_id', $customer_draft_Id)
              ->get();
         
          $products = [];
  
          foreach ($customerDraftStyles as $customerDraftStyle) {
              $products[$customerDraftStyle->door_style_Id] =     DB::table('draft_product')
              ->leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
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
           
             
              $accessoriesNames = DB::table('draft_product')
              ->leftJoin('draft_product_accessories', 'draft_product_accessories.draft_product_id', '=', 'draft_product.draft_product_id')
              ->leftJoin('accessoriesmaster', 'accessoriesmaster.accessories_id', '=', 'draft_product_accessories.accessories_id')
              ->leftJoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
              ->where('draft_product.customer_draft_id', $customer_draft_Id)
              ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
              ->where('draft_product.customer_id', $user)
              ->select(
                  'draft_product.draft_product_id',
                  'accessoriesmaster.accessories_nm as accessories_nm',
              )
              ->get()
              ->groupBy('draft_product_id');
  
              $modificationNames = DB::table('draft_product')
              ->leftJoin('draft_product_modification', 'draft_product_modification.draft_product_id', '=', 'draft_product.draft_product_id')
              ->leftJoin('modificationmaster', 'modificationmaster.modification_id', '=', 'draft_product_modification.modification_id')
              ->leftJoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
              ->where('draft_product.customer_draft_id', $customer_draft_Id)
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
              foreach ($products[$customerDraftStyle->door_style_Id] as $item) {
                  
              $cut_depthIdExists = DB::table('item_cut_depth')
              ->where('product_id', $item->product_id)
              ->exists();
              // dd($cut_depthIdExists);
              $item->cutdepth_id_exists = $cut_depthIdExists;
              // dd($item->cutdepth_id_exists);
              $selectedCutDepth = DB::table('draft_product')
                  ->select('selected_cut_depth','draft_product_id as cut_depth_draft_id')
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
              $pdf_data = CustomerDraft::select('customer.company_name','customer.representative_name','customer.address as customer_address','customer.contact_number as customer_no','customer.email','customer_draft.client_name','customer_draft.address as client_address','customer_draft.contact_no as client_no','customer_draft.po_number','customer_draft.service_type','customer_draft.designer','customer_draft.configuration','customer_draft.created_at')
              ->leftjoin('customer','customer.user_id','customer_draft.customer_id')
              ->where('customer_draft.customer_draft_id',$customer_draft_Id)
              ->first();
             
          }
           // dd($products);
          $newdata_arr = $products;
          $without_arr = $products;
          
        return view('backend.process_manage.pdf',compact('pagename','pdf_data','customer_draft','products','customer_draft_Id','newdata_arr','without_arr','pagename','pdf_data','grup_discount'));
    }

}
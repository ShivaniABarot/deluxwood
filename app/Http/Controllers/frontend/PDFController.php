<?php
    
namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;
use PDF;
use App\Models\User;
use App\Models\CustomerDraft;
use Illuminate\Support\Facades\Auth;
Use App\Models\CustomerDraftStyle;
use DB;
use App\Models\Customer;
use App\Models\SalesTax;
use App\Models\DraftProduct;

class PDFController extends Controller
{
    public function withPrice($customer_draft_Id)
    {

        $user = Auth::user()->id;
        $customer_draft = CustomerDraft::where('customer_draft_id',$customer_draft_Id)->first();
       // dd($customer_draft->discount );
       $shippingCost = 0;
       $draft_product = DraftProduct::where('customer_draft_Id', $customer_draft_Id)->where('is_shipping_cost','Yes')->first();
       $shippingCost= $draft_product->final_unit_price;
       
       
        $customerDraftStyles = CustomerDraftStyle::where('customer_draft_id', $customer_draft_Id)
            ->get();
          
        $taxGroup = Customer::select('tax_group','tax_rate')->where('user_id',$user)->first();
        $taxRate  = SalesTax::where('zip_code', '6516')->value('tax_rate');
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
            ->orderBy('draft_product.created_at', 'asc')
            ->get();
              foreach ($products[$customerDraftStyle->door_style_Id] as $product) {
                $modificationNames = DraftProduct::
                    leftJoin('draft_product_modification', 'draft_product_modification.draft_product_id', '=', 'draft_product.draft_product_id')
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
            $pdf_data = CustomerDraft::select('customer.company_name','customer.representative_name','customer.address as customer_address','customer.city as customer_city','customer.state as customer_state','customer.contact_number as customer_no','customer.email','customer_draft.client_name','customer_draft.address as client_address','customer_draft.contact_no as client_no','customer_draft.po_number','customer_draft.service_type','customer_draft.designer','customer_draft.configuration','customer_draft.created_at','customer_draft.ship_name','customer_draft.ship_email','customer_draft.ship_contact_no','customer_draft.ship_address','customer_draft.ship_city','customer_draft.ship_zip_code','state_master.state_name as ship_state')
            ->leftjoin('customer','customer.user_id','customer_draft.customer_id')
            ->leftjoin('state_master','state_master.state_id','customer_draft.ship_state')
            ->where('customer_draft.customer_draft_id',$customer_draft_Id)
            ->first();
           
        }
         // dd($products);
        $newdata_arr = $products;
        $without_arr = $products;
        $watermark = "";

        $data = [
            // 'title' => 'Welcome to .com',
            'pdf_data' => $pdf_data,
            'customer_draft' => $customer_draft,
            'products' => $products,
            'customer_draft_Id' => $customer_draft_Id,
            'newdata_arr' => $newdata_arr,
            'taxGroup' => $taxGroup,
            'watermark'=>$watermark,
            'shippingCost'=>$shippingCost,
            'taxRate'=>$taxRate
        ]; 
        // /return view('frontend.pdf.Withprice', $data);
        $pdf = PDF::loadView('frontend.pdf.Withprice', $data);
        $pdf->output();
        $domPdf = $pdf->getDomPDF();
        $canvas = $domPdf->get_canvas();
        $canvas->page_text(50, 790, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
        return $pdf->download($pdf_data->client_name . '_' . $pdf_data->po_number . '.pdf');

        // $pdf = PDF::loadView('frontend.pdf.Withprice', $data);
        // $pdf->setPaper('L');
        // $pdf->output();
        // $domPdf = $pdf->getDomPDF();
        // $canvas = $domPdf->get_canvas();
        // $canvas->set_opacity(0.1);
        // $canvas->page_text($canvas->get_width() / 3, $canvas->get_height() / 3, 'PAID', null, 80,  [0.398, 0.000, 0.455, 0.043], 2, 2, -30 ,['opacity' => 0.3]);
        // return $pdf->download($pdf_data->client_name . '_' . $pdf_data->po_number . '.pdf');

    }

    public function withoutPrice($customer_draft_Id)
    {
        
        $user = Auth::user()->id;
        $customer_draft = CustomerDraft::where('customer_draft_id',$customer_draft_Id)->first();
       
        $customerDraftStyles = CustomerDraftStyle::where('customer_draft_id', $customer_draft_Id)
            ->get();
        

        $taxGroup = Customer::select('tax_group','tax_rate')->where('user_id',$user)->first();
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
            $pdf_data = CustomerDraft::select('customer.company_name','customer.representative_name','customer.address as customer_address','customer.city as customer_city','customer.state as customer_state','customer.contact_number as customer_no','customer.email','customer_draft.client_name','customer_draft.address as client_address','customer_draft.contact_no as client_no','customer_draft.po_number','customer_draft.service_type','customer_draft.designer','customer_draft.configuration','customer_draft.created_at','customer_draft.ship_name','customer_draft.ship_email','customer_draft.ship_contact_no','customer_draft.ship_address','customer_draft.ship_city','customer_draft.ship_zip_code','state_master.state_name as ship_state')
            ->leftjoin('customer','customer.user_id','customer_draft.customer_id')
            ->leftjoin('state_master','state_master.state_id','customer_draft.ship_state')
            ->where('customer_draft.customer_draft_id',$customer_draft_Id)
            ->first();
           
        }
         // dd($products);
        $newdata_arr = $products;
        $without_arr = $products;

        $data = [
            // 'title' => 'Welcome to .com',
            'pdf_data' => $pdf_data,
            'customer_draft' => $customer_draft,
            'products' => $products,
            'customer_draft_Id' => $customer_draft_Id,
            'newdata_arr' => $newdata_arr,
            'taxGroup' => $taxGroup
        ]; 
              
        $pdf = PDF::loadView('frontend.pdf.Without', $data);
        $pdf->output();
        $domPdf = $pdf->getDomPDF();
        $canvas = $domPdf->get_canvas();
        $canvas->page_text(50, 790, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
  
        return $pdf->download($pdf_data->client_name . '_' . $pdf_data->po_number . '.pdf');

    }
 
}
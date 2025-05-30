<?php

namespace App\Http\Controllers\backend;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerDraft;
use App\Models\DraftProduct;
use App\Models\Customer;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerDraftStyle;
use App\Models\StateMaster;
use App\Models\SalesTax;
use App\Models\CustomerGroup;

class AdminDraftsController extends BaseController
{
    public function index()
    {
        $pagename = "Drafts Index";

        $Drafts = CustomerDraft::select(
            'customer_draft.customer_draft_id as customer_draft_id',
            'customer_draft.po_number',
            'customer_draft.original_price',
            'customer_draft.created_at',
            'door_style.name as door_style',
            'customer.company_name as customer_name'
        )
            ->join('customer_draft_style', 'customer_draft.customer_draft_id', '=', 'customer_draft_style.customer_draft_id')
            ->join('door_style', 'customer_draft_style.door_style_id', '=', 'door_style.doorStyle_id')
            ->join('customer', 'customer_draft.customer_id', '=', 'customer.user_id')
            ->get();

        return view('backend.drafts.index', compact('pagename', 'Drafts'));
    }

    public function view(Request $request, $customer_draft_id)
    {
        $pagename = "Drafts View";
        $user = Auth::user()->id;
    
        // Fetch the customer draft
        $customer_draft = CustomerDraft::where('customer_draft_id', $customer_draft_id)->first();
        if (!$customer_draft) {
            abort(404, 'Draft not found');
        }
    
        // Fetch tax rate based on shipping zip code, default to 0 if not found
        $tax_rate = SalesTax::where('zip_code', $customer_draft->ship_zip_code)->value('tax_rate') ?? 0;
        $customer_draft->zipcode_tax_rate = $tax_rate;
    
        // Fetch shipping cost from draft products, default to 0 if not found
        $draft_product = DraftProduct::where('customer_draft_id', $customer_draft_id)
            ->where('is_shipping_cost', 'Yes')
            ->first();
        $shippingCost = $draft_product ? $draft_product->final_unit_price : 0;
    
        // Fetch customer group discount, default to 0 if not found
        $grup_discount = Customer::select('customer_group.group_dicount_percent')
            ->leftJoin('customer_group', 'customer_group.customer_group_id', '=', 'customer.customer_group_id')
            ->where('customer.user_id', $user)
            ->value('group_dicount_percent') ?? 0;
    
        // Fetch tax group and default tax rate for self-pickup
        $taxGroup = Customer::select('tax_group', 'tax_rate')->where('user_id', $user)->first();
    
        if (!$taxGroup) {
            $taxGroup = (object) ['tax_group' => null, 'tax_rate' => 0];
        }
    
        $taxRate = SalesTax::where('zip_code', '6516')->value('tax_rate') ?? 0;
    
        // Fetch customer draft styles
        $customerDraftStyles = CustomerDraftStyle::where('customer_draft_id', $customer_draft_id)->get();
    
        // Initialize products array
        $products = [];
    
        foreach ($customerDraftStyles as $customerDraftStyle) {
            $draftProducts = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
                ->leftJoin('product_item_hinge_side', 'draft_product.product_id', '=', 'product_item_hinge_side.product_id')
                ->leftJoin('product_item_finish_side', 'draft_product.product_id', '=', 'product_item_finish_side.product_id')
                ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
                ->leftJoin('customer_draft_style', 'customer_draft_style.draft_style_id', '=', 'draft_product.draft_style_id')
                ->leftJoin('door_style', 'door_style.doorStyle_id', '=', 'customer_draft_style.door_style_Id')
                ->where('draft_product.customer_draft_id', $customer_draft_id)
                ->where('customer_draft_style.door_style_Id', $customerDraftStyle->door_style_Id)
                ->where('draft_product.customer_id', $user)
                ->select(
                    'draft_product.*',
                    'product_master.*',
                    'product_item.product_item_sku',
                    'product_item.description as product_description',
                    'product_item.hinge_side as is_hinge_side',
                    'product_item.finish_side as is_finish_side',
                    'product_item.product_item_price',
                    'product_item.cut_depth',
                    'product_item.cut_depth_price',
                    'door_style.name',
                    'door_style.image',
                    'product_item_hinge_side.right_hinge_side_price',
                    'product_item_hinge_side.left_hinge_side_price',
                    'product_item_hinge_side.both_hinge_side_price',
                    'product_item_hinge_side.hinge_side_none',
                    'product_item_finish_side.right_finish_side_price',
                    'product_item_finish_side.left_finish_side_price',
                    'product_item_finish_side.both_finish_side_price',
                    'product_item_finish_side.finish_side_none',
                    'customer_draft_style.draft_style_id'
                )
                ->orderBy('draft_product.created_at', 'asc')
                ->get();
    
            // Process each product to add related data
            foreach ($draftProducts as $product) {
                // Fetch modification names and prices
                $modificationData = DB::table('draft_product_modification')
                    ->leftJoin('modificationmaster', 'modificationmaster.modification_id', '=', 'draft_product_modification.modification_id')
                    ->leftJoin('item_modification', function ($join) use ($product) {
                        $join->on('item_modification.modification_id', '=', 'draft_product_modification.modification_id')
                            ->where('item_modification.product_id', '=', $product->product_id);
                    })
                    ->where('draft_product_modification.draft_product_id', $product->draft_product_id)
                    ->select(
                        'modificationmaster.modification_nm',
                        'item_modification.modification_price'
                    )
                    ->get();
    
                // Fetch accessories names and prices
                $accessoriesData = DB::table('draft_product_accessories')
                    ->leftJoin('accessoriesmaster', 'accessoriesmaster.accessories_id', '=', 'draft_product_accessories.accessories_id')
                    ->leftJoin('item_accessories', function ($join) use ($product) {
                        $join->on('item_accessories.accessories_id', '=', 'draft_product_accessories.accessories_id')
                            ->where('item_accessories.product_id', '=', $product->product_id);
                    })
                    ->where('draft_product_accessories.draft_product_id', $product->draft_product_id)
                    ->select(
                        'accessoriesmaster.accessories_nm',
                        'item_accessories.accessories_price'
                    )
                    ->get();
    
                // Assign collections to product
                $product->modification_nm = collect($modificationData);
                $product->accessories_nm = collect($accessoriesData);
    
                // Fetch cut depth information
                $cut_depthIdExists = DB::table('item_cut_depth')->where('product_id', $product->product_id)->exists();
                $product->cutdepth_id_exists = $cut_depthIdExists;
    
                if ($cut_depthIdExists) {
                    $product->cut_depth_info = collect(
                        DB::table('item_cut_depth')
                            ->select('item_depth_id', 'depth_name_inch', 'product_id')
                            ->where('product_id', $product->product_id)
                            ->get()
                    );
                } else {
                    $product->cut_depth_info = collect();
                }
    
                // Fetch selected cut depth
                $selectedCutDepth = DraftProduct::select('selected_cut_depth')
                    ->where('customer_draft_id', $customer_draft_id)
                    ->where('draft_product_id', $product->draft_product_id)
                    ->first();
                $product->selected_cut_depth = $selectedCutDepth ? $selectedCutDepth->selected_cut_depth : null;
    
                // Add product totals and pricing calculations
                $product->item_total_price = $product->product_item_price * $product->quantity;
                
                // Calculate door style price
                $product->door_style_price = DB::table('product_door_style')
                    ->where('door_style_id', $customerDraftStyle->door_style_Id)
                    ->where('product_id', $product->product_id)
                    ->value('doorstyle_price') ?? 0;
                
                $product->door_style_total = $product->door_style_price * $product->quantity;
                
                // Calculate modification total
                $product->modification_total = $product->modification_nm->sum('modification_price') * $product->quantity;
                
                // Calculate accessories total
                $product->accessories_total = $product->accessories_nm->sum('accessories_price') * $product->quantity;
                
                // Calculate cut depth total
                $product->cut_depth_total = 0;
                if($product->cut_depth == "Yes" && $product->is_cut_depth == "Yes"){
                    $product->cut_depth_total = $product->cut_depth_price * $product->quantity;
                }
                
                // Calculate hinge side pricing
                $product->hinge_side_price = 0;
                if ($product->is_hinge_side == "Yes") {
                    $hingePrices = DB::table('product_item_hinge_side')
                        ->where('product_id', $product->product_id)
                        ->first();
                    
                    if ($hingePrices) {
                        switch ($product->hinge_side) {
                            case 'L':
                                $product->hinge_side_price = $hingePrices->left_hinge_side_price ?? 0;
                                break;
                            case 'R':
                                $product->hinge_side_price = $hingePrices->right_hinge_side_price ?? 0;
                                break;
                            case 'B':
                                $product->hinge_side_price = $hingePrices->both_hinge_side_price ?? 0;
                                break;
                        }
                    }
                }
                $product->hinge_side_total = $product->hinge_side_price * $product->quantity;
                
                // Calculate finish side pricing
                $product->finish_side_price = 0;
                if ($product->is_finish_side == "Yes") {
                    $finishPrices = DB::table('product_item_finish_side')
                        ->where('product_id', $product->product_id)
                        ->first();
                    
                    if ($finishPrices) {
                        switch ($product->finish_side) {
                            case 'L':
                                $product->finish_side_price = $finishPrices->left_finish_side_price ?? 0;
                                break;
                            case 'R':
                                $product->finish_side_price = $finishPrices->right_finish_side_price ?? 0;
                                break;
                            case 'B':
                                $product->finish_side_price = $finishPrices->both_finish_side_price ?? 0;
                                break;
                        }
                    }
                }
                $product->finish_side_total = $product->finish_side_price * $product->quantity;
                
                // Calculate product total
                $product->product_total = $product->item_total_price + 
                                       $product->door_style_total + 
                                       $product->modification_total + 
                                       $product->accessories_total + 
                                       $product->cut_depth_total + 
                                       $product->hinge_side_total + 
                                       $product->finish_side_total;
            }
    
            $products[$customerDraftStyle->door_style_Id] = $draftProducts;
        }
    
        // Fetch PDF data for display
        $pdf_data = CustomerDraft::select(
            'customer.company_name',
            'customer.representative_name',
            'customer.address as customer_address',
            'customer.contact_number as customer_no',
            'customer.email',
            'customer_draft.client_name',
            'customer_draft.address as client_address',
            'customer_draft.contact_no as client_no',
            'customer_draft.po_number',
            'customer_draft.service_type',
            'customer_draft.designer',
            'customer_draft.configuration',
            'customer_draft.created_at',
            'customer_draft.ship_name',
            'customer_draft.ship_email',
            'customer_draft.ship_contact_no',
            'customer_draft.ship_address',
            'customer_draft.ship_city',
            'customer_draft.ship_zip_code',
            'state_master.state_name as ship_state'
        )
            ->leftJoin('customer', 'customer.user_id', '=', 'customer_draft.customer_id')
            ->leftJoin('state_master', 'state_master.state_id', '=', 'customer_draft.ship_state')
            ->where('customer_draft.customer_draft_id', $customer_draft_id)
            ->first();
    
        // Fetch customer and related data
        $customer = Customer::where('user_id', $user)->first();
        $state = StateMaster::all();
        $CustomerGroup = null;
    
        if ($customer) {
            $CustomerGroup = CustomerGroup::where('customer_group_id', $customer->customer_group_id)->first();
        }
    
        // Prepare arrays for view (maintaining backward compatibility)
        $newdata_arr = $products;
        $without_arr = $products;
    
        return view('backend.drafts.view', compact(
            'customer_draft',
            'customer',
            'products',
            'customer_draft_id',
            'newdata_arr',
            'without_arr',
            'pagename',
            'pdf_data',
            'grup_discount',
            'taxGroup',
            'CustomerGroup',
            'state',
            'shippingCost',
            'taxRate'
        ));
    }
}
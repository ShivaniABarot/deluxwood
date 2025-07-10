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
use App\Models\UnassembledDiscount;


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
        // dd(87979 ,$request->all());
        // New SKU and door style search logic
        $sku = $request->input('sku');
        $doorStyleId = $request->input('door_style_id');

        if ($sku && $doorStyleId) {
            $user_id = Auth::user()->id;
            // Fetch products based on SKU and door_style_id
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
        $taxGroup = Customer::select('tax_group', 'tax_rate')->where('user_id', $user)->first() ?: (object) ['tax_group' => null, 'tax_rate' => 0];
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

            $products[$customerDraftStyle->door_style_Id] = $draftProducts->isEmpty() ? [] : $draftProducts->all();

            foreach ($products[$customerDraftStyle->door_style_Id] as $product) {
                // Fetch modification data
                $modificationData = DB::table('draft_product_modification')
                    ->leftJoin('modificationmaster', 'modificationmaster.modification_id', '=', 'draft_product_modification.modification_id')
                    ->leftJoin('item_modification', function ($join) use ($product) {
                        $join->on('item_modification.modification_id', '=', 'draft_product_modification.modification_id')
                            ->where('item_modification.product_id', '=', $product->product_id);
                    })
                    ->where('draft_product_modification.draft_product_id', $product->draft_product_id)
                    ->select('modificationmaster.modification_nm', 'item_modification.modification_price')
                    ->get();
                $product->modification_nm = collect($modificationData);

                // Fetch accessories data
                $accessoriesData = DB::table('draft_product_accessories')
                    ->leftJoin('accessoriesmaster', 'accessoriesmaster.accessories_id', '=', 'draft_product_accessories.accessories_id')
                    ->leftJoin('item_accessories', function ($join) use ($product) {
                        $join->on('item_accessories.accessories_id', '=', 'draft_product_accessories.accessories_id')
                            ->where('item_accessories.product_id', '=', $product->product_id);
                    })
                    ->where('draft_product_accessories.draft_product_id', $product->draft_product_id)
                    ->select('accessoriesmaster.accessories_nm', 'item_accessories.accessories_price')
                    ->get();
                $product->accessories_nm = collect($accessoriesData);

                // Fetch cut depth information
                $cut_depthIdExists = DB::table('item_cut_depth')->where('product_id', $product->product_id)->exists();
                $product->cutdepth_id_exists = $cut_depthIdExists;
                $product->cut_depth_info = $cut_depthIdExists ? collect(DB::table('item_cut_depth')
                    ->select('item_depth_id', 'depth_name_inch', 'product_id')
                    ->where('product_id', $product->product_id)
                    ->get()) : collect();

                // Fetch selected cut depth
                $selectedCutDepth = DraftProduct::select('selected_cut_depth')
                    ->where('customer_draft_id', $customer_draft_id)
                    ->where('draft_product_id', $product->draft_product_id)
                    ->first();
                $product->selected_cut_depth = $selectedCutDepth ? $selectedCutDepth->selected_cut_depth : null;

                // Calculate pricing
                $product->item_total_price = $product->product_item_price * ($product->quantity ?? 1);
                $product->door_style_price = DB::table('product_door_style')
                    ->where('door_style_id', $customerDraftStyle->door_style_Id)
                    ->where('product_id', $product->product_id)
                    ->value('doorstyle_price') ?? 0;
                $product->door_style_total = $product->door_style_price * ($product->quantity ?? 1);
                $product->modification_total = $product->modification_nm->sum('modification_price') * ($product->quantity ?? 1);
                $product->accessories_total = $product->accessories_nm->sum('accessories_price') * ($product->quantity ?? 1);
                $product->cut_depth_total = ($product->cut_depth == "Yes" && $product->is_cut_depth == "Yes") ? $product->cut_depth_price * ($product->quantity ?? 1) : 0;

                // Hinge side pricing
                $product->hinge_side_price = 0;
                if ($product->is_hinge_side == "Yes") {
                    $hingePrices = DB::table('product_item_hinge_side')->where('product_id', $product->product_id)->first();
                    if ($hingePrices) {
                        $hingeField = $product->hinge_side . '_hinge_side_price';
                        $product->hinge_side_price = $hingePrices->$hingeField ?? 0;
                    }
                }
                $product->hinge_side_total = $product->hinge_side_price * ($product->quantity ?? 1);

                // Finish side pricing
                $product->finish_side_price = 0;
                if ($product->is_finish_side == "Yes") {
                    $finishPrices = DB::table('product_item_finish_side')->where('product_id', $product->product_id)->first();
                    if ($finishPrices) {
                        $finishField = $product->finish_side . '_finish_side_price';
                        $product->finish_side_price = $finishPrices->$finishField ?? 0;
                    }
                }
                $product->finish_side_total = $product->finish_side_price * ($product->quantity ?? 1);

                // Total price
                $product->product_total = $product->item_total_price +
                    $product->door_style_total +
                    $product->modification_total +
                    $product->accessories_total +
                    $product->cut_depth_total +
                    $product->hinge_side_total +
                    $product->finish_side_total;
            }
        }

        // Calculate totals with safe handling
        $sub_total = array_sum(array_column(array_filter(array_map(function ($item) {
            return is_array($item) ? array_column($item, 'product_total') : [];
        }, $products)), 0) ?? [0]);

        $ItemtotalPrice = array_sum(array_column(array_filter(array_map(function ($item) {
            return is_array($item) ? array_column($item, 'item_total_price') : [];
        }, $products)), 0) ?? [0]);

        $totalCutDepthPrice = array_sum(array_column(array_filter(array_map(function ($item) {
            return is_array($item) ? array_column($item, 'cut_depth_total') : [];
        }, $products)), 0) ?? [0]);

        $totalModificationPrice = array_sum(array_column(array_filter(array_map(function ($item) {
            return is_array($item) ? array_column($item, 'modification_total') : [];
        }, $products)), 0) ?? [0]);

        $totalDoorStylePrice = array_sum(array_column(array_filter(array_map(function ($item) {
            return is_array($item) ? array_column($item, 'door_style_total') : [];
        }, $products)), 0) ?? [0]);

        $totalAccessoriesPrice = array_sum(array_column(array_filter(array_map(function ($item) {
            return is_array($item) ? array_column($item, 'accessories_total') : [];
        }, $products)), 0) ?? [0]);

        $hinge_value = array_sum(array_column(array_filter(array_map(function ($item) {
            return is_array($item) ? array_column($item, 'hinge_side_total') : [];
        }, $products)), 0) ?? [0]);

        $finish_value = array_sum(array_column(array_filter(array_map(function ($item) {
            return is_array($item) ? array_column($item, 'finish_side_total') : [];
        }, $products)), 0) ?? [0]);

        $unassembled_discount = UnassembledDiscount::first();
        $configurationDiscountSum = ($customer_draft->configuration === "Unassembled" && $unassembled_discount) ? $sub_total * ($unassembled_discount->unassembled_discount / 100) : 0;

        // Calculate discounted price
        $discountedPrice = $sub_total;
        if ($configurationDiscountSum > 0) {
            $discountedPrice -= $configurationDiscountSum;
        }
        $groupDiscount = $discountedPrice * (($customer_draft->discount ?? 0) / 100);
        $discountedPrice -= $groupDiscount;

        $taxGroupDiscount = 0;
        if ($customer_draft->service_type === "Self Pickup") {
            $taxGroupDiscount = $discountedPrice * ($taxRate / 100);
        } elseif (in_array($customer_draft->service_type, ["Curbside Delivery", "Other"])) {
            $taxRate = $customer_draft->zipcode_tax_rate ?? 0;
            $taxGroupDiscount = $discountedPrice * ($taxRate / 100);
        }

        $discountedPrice += number_format($taxGroupDiscount, 2, '.', '');
        $discountedPrice += $shippingCost;

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
        $CustomerGroup = $customer ? CustomerGroup::where('customer_group_id', $customer->customer_group_id)->first() : null;

        // Prepare arrays for view (maintaining backward compatibility)
        $newdata_arr = $products;
        $without_arr = $products;

        // Redirect logic from the first block
        $status_not_available = ["Pending", "Save"];
        $shipping_not_available = CustomerDraft::where('customer_draft_id', $customer_draft_id)->whereIn('draft_status', $status_not_available)
            ->where(function ($query) {
                $query->whereNull('ship_name')
                    ->orWhereNull('ship_email')
                    ->orWhereNull('ship_contact_no')
                    ->orWhereNull('ship_address')
                    ->orWhereNull('ship_state')
                    ->orWhereNull('ship_city')
                    ->orWhereNull('ship_zip_code');
            })
            ->exists();
        if ($shipping_not_available) {
            return redirect('create-shipping-information/' . $customer_draft_id);
        }

        $product_available = DraftProduct::where('customer_draft_id', $customer_draft_id)->where('is_shipping_cost', 'NO')->first();
        $doorStyleConfig = CustomerDraftStyle::where('customer_draft_id', $customer_draft_id)->where('configuration', null)->get();
        $draftCutdepthInch = DraftProduct::where('customer_draft_id', $customer_draft_id)
            ->where('is_cut_depth', 'Yes')
            ->whereNull('selected_cut_depth')
            ->where('is_shipping_cost', 'No')
            ->get();
        $checkHinge = DraftProduct::leftJoin('product_item', 'product_item.product_id', 'draft_product.product_id')
            ->where('draft_product.customer_draft_id', $customer_draft_id)
            ->where('draft_product.is_shipping_cost', 'No')
            ->where('product_item.hinge_side', 'Yes')
            ->whereNull('draft_product.hinge_side')
            ->select('draft_product.*', 'product_item.product_item_sku')
            ->get();
        $checkFinish = DraftProduct::leftJoin('product_item', 'product_item.product_id', 'draft_product.product_id')
            ->where('draft_product.customer_draft_id', $customer_draft_id)
            ->where('draft_product.is_shipping_cost', 'No')
            ->where('product_item.finish_side', 'Yes')
            ->whereNull('draft_product.finish_side')
            ->select('draft_product.*', 'product_item.product_item_sku')
            ->get();

        if (empty($product_available) || is_null($product_available) || !$doorStyleConfig->isEmpty() || !$draftCutdepthInch->isEmpty() || !$checkHinge->isEmpty() || !$checkFinish->isEmpty()) {
            return redirect('add-cart/' . $customer_draft_id);
        }

        $statusesToRedirect = ['Quotation', 'Inprogress', 'Ready', 'In Production', 'Delivered', 'Return'];
        if (in_array($customer_draft->draft_status, $statusesToRedirect)) {
            return redirect('tracking-status/view/' . $customer_draft_id);
        }

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
            'taxRate',
            'sub_total',
            'ItemtotalPrice',
            'configurationDiscountSum',
            'discountedPrice'
        ));
    }
}
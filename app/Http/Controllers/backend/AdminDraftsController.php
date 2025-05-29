<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\CouponForm;
use App\Models\Coupon;
use App\Models\User;
use App\Models\CouponMaster;
use App\Models\CustomerDraft;
use Hash;
use Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreditcardForm;
use App\Models\DraftProduct;
use App\Models\Customer;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerDraftStyle;
use App\Models\StateMaster;
use App\Models\SalesTax;
use App\Models\CustomerGroup;
use App\Models\DoorStyle;
use App\Http\Requests\CheckoutForm;
use App\Http\Requests\ShippingInformationForm;
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

        $customer_draft = CustomerDraft::where('customer_draft_id', $customer_draft_id)->first();
        $tax_rate = SalesTax::where('zip_code', $customer_draft->ship_zip_code)->value('tax_rate');
        $customer_draft->zipcode_tax_rate = $tax_rate;
        $customer_draft->save();

        $draft_product = DraftProduct::where('customer_draft_id', $customer_draft_id)->where('is_shipping_cost', 'Yes')->first();
        $shippingCost = $draft_product->final_unit_price;

        $grup_discount = Customer::select('customer_group.group_dicount_percent')
            ->leftJoin('customer_group', 'customer_group.customer_group_id', 'customer.customer_group_id')
            ->where('customer.user_id', $user)
            ->first();

        $customerDraftStyles = CustomerDraftStyle::where('customer_draft_id', $customer_draft_id)->get();
        $taxGroup = Customer::select('tax_group', 'tax_rate')->where('user_id', $user)->first();
        $taxRate = SalesTax::where('zip_code', '6516')->value('tax_rate');

        $products = [];

        foreach ($customerDraftStyles as $customerDraftStyle) {
            $product_available = DraftProduct::where('draft_style_id', $customerDraftStyle->draft_style_id)->first();

            if (empty($product_available)) {
                return redirect('new-draft/' . $customer_draft_id);
            }

            $products[$customerDraftStyle->door_style_Id] = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
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
                ->orderBy('draft_product.created_at', 'asc')
                ->get();

            foreach ($products[$customerDraftStyle->door_style_Id] as $product) {
                $modificationNames = DraftProduct::leftJoin('draft_product_modification', 'draft_product_modification.draft_product_id', '=', 'draft_product.draft_product_id')
                    ->leftJoin('modificationmaster', 'modificationmaster.modification_id', '=', 'draft_product_modification.modification_id')
                    ->leftJoin('item_modification', function ($join) use ($product) {
                        $join->on('item_modification.modification_id', '=', 'draft_product_modification.modification_id')
                            ->where('item_modification.product_id', '=', $product->product_id);
                    })
                    ->leftJoin('customer_draft_style', 'customer_draft_style.draft_style_id', '=', 'draft_product.draft_style_id')
                    ->where('draft_product.customer_draft_id', $customer_draft_id)
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
                    ->where('draft_product.customer_draft_id', $customer_draft_id)
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
                $cut_depthIdExists = DB::table('item_cut_depth')->where('product_id', $item->product_id)->exists();
                $item->cutdepth_id_exists = $cut_depthIdExists;

                $selectedCutDepth = DraftProduct::select('selected_cut_depth', 'draft_product_id as cut_depth_draft_id')
                    ->where('customer_draft_id', $customer_draft_id)
                    ->get();

                $item->selectedcut_depth = $selectedCutDepth;

                if ($cut_depthIdExists) {
                    $item->cut_depth_info = DB::table('item_cut_depth')
                        ->select('item_depth_id', 'depth_name_inch', 'product_id')
                        ->where('product_id', $item->product_id)
                        ->get();
                }
            }

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
                ->leftJoin('customer', 'customer.user_id', 'customer_draft.customer_id')
                ->leftJoin('state_master', 'state_master.state_id', 'customer_draft.ship_state')
                ->where('customer_draft.customer_draft_id', $customer_draft_id)
                ->first();
        }

        $status_not_available = ["Pending", "Save"];
        $shipping_not_available = CustomerDraft::where('customer_draft_id', $customer_draft_id)
            ->whereIn('draft_status', $status_not_available)
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

        $newdata_arr = $products;
        $without_arr = $products;
        $customer = Customer::where('user_id', $user)->first();
        $state = StateMaster::select('*')->get();
        $CustomerGroup = CustomerGroup::where('customer_group_id', $customer->customer_group_id)->first();

        $product_available = DraftProduct::where('customer_draft_id', $customer_draft_id)->where('is_shipping_cost', 'NO')->first();
        $doorStyleConfig = CustomerDraftStyle::where('customer_draft_id', $customer_draft_id)
            ->where('configuration', null)
            ->get();

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

        if (empty($product_available) || is_null($product_available)) {
            return redirect('new-draft/' . $customer_draft_id);
        } elseif (!$doorStyleConfig->isEmpty()) {
            return redirect('new-draft/' . $customer_draft_id);
        } elseif (!$draftCutdepthInch->isEmpty()) {
            return redirect('new-draft/' . $customer_draft_id);
        } elseif (!$checkHinge->isEmpty()) {
            return redirect('new-draft/' . $customer_draft_id);
        } elseif (!$checkFinish->isEmpty()) {
            return redirect('new-draft/' . $customer_draft_id);
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
            'taxRate'
        ));
    }


}

<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreditcardForm;
use App\Models\CustomerDraft;
use App\Models\Customer;
use App\Models\DraftProduct;
use App\Models\ReplaceOrder;
use DB;
use Illuminate\Support\Facades\Auth;


class RMAController extends Controller
{
    public function index()
    {

        $pagename = "RMA";
        $user_id = Auth::user()->id;
        $rma_data = CustomerDraft::select('door_style.name','door_style.image','product_item.product_item_sku','product_item.product_item_name','customer_draft.draft_status','customer_draft.customer_draft_id','draft_product.draft_product_id')
        ->leftjoin('draft_product','draft_product.customer_draft_Id','=','customer_draft.customer_draft_id')
        ->leftjoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
        ->leftjoin('door_style','door_style.doorStyle_id','customer_draft_style.door_style_Id')
        ->leftjoin('product_item','product_item.product_id','draft_product.product_id')
        ->where('customer_draft.customer_id',$user_id)
        ->where('customer_draft.draft_status','Picked')
        ->get();
       
        return view('frontend.rma.index',compact('rma_data','pagename'));
    } 

    public function view($id)
    {
        $pagename = "RMA View";
        $draft_product_id = $id;
        $replace_data = DraftProduct::select('door_style.image','customer_draft.draft_status','door_style.name','draft_product.hinge_side','draft_product.finish_side','product_item.product_item_name','product_item.description')
        ->leftjoin('customer_draft_style','customer_draft_style.draft_style_id','=','draft_product.draft_style_id')
        ->leftjoin('door_style','door_style.doorStyle_id','customer_draft_style.door_style_Id')
        ->leftjoin('customer_draft','customer_draft.customer_draft_id','draft_product.customer_draft_id')
        ->leftjoin('product_item','product_item.product_id','draft_product.product_id')
        ->where('draft_product.draft_product_id',$draft_product_id)
        ->first();
        // dd($replace_data);
        return view('frontend.rma.view',compact('replace_data','draft_product_id','pagename'));
    }

    public function replaceOrder(Request $request) 
    {
        $draftProductId = $request->draft_product_id;

        $draftProduct = DraftProduct::select('draft_product.customer_draft_Id')
            ->leftjoin('product_item','product_item.product_id','=','draft_product.product_id')
            ->where('draft_product.draft_product_id', $draftProductId)
            ->first();

        if ($draftProduct) {
            $status = CustomerDraft::find($draftProduct->customer_draft_Id);
            $status->draft_status = 'Return';

            $replaceOrder = new ReplaceOrder();
            $replaceOrder->reason = $request->reason;
            $replaceOrder->draft_product_id = $draftProductId;

            if ($status->save() && $replaceOrder->save()) {
                return redirect('/rma-s')->with('success', 'Order replaced successfully');
            } else {
                return redirect('/rma-s')->with('error', 'Error: Something went wrong. Please try again.');
            }
        } else {
            return redirect('/rma-s')->with('error', 'Error: Draft product not found.');
        }
    }
}
<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerDraft;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\DefaultShippingCost;
use App\Models\DraftProduct;
use App\Models\UnassembledDiscount;
use App\Models\SalesTax;
use App\Models\StateMaster;


class DashboardController extends Controller
{
   public function index(){
      $user =Auth::user();
      $pagename = "Dashboard";
      if($user){
        // $customer_draft = CustomerDraft::where('customer_id', $user->id)
        //                   // ->whereIn('draft_status', ['Save', 'Quotation','Pending'])
        //                   ->where('customer_draft_style',' customer_draft_style.customer_draft_Id','=','customer_draft->customer_draft_Id')
        //                   ->select('door_style_Id')
        //                   ->get();
        // $customer_draft = CustomerDraft::where('customer_id', $user->id)
        // ->join('customer_draft_style', 'customer_draft_style.customer_draft_Id', '=', 'customer_draft.customer_draft_Id')
        // ->get();
       // $this->draft_total($user->id);
        $customer_draft = CustomerDraft::select(
            'customer_draft.customer_draft_id',
            'customer_draft.customer_id',
            'customer_draft.po_number',
            'customer_draft.total_price',
            'customer_draft.draft_status',
            DB::raw('MAX(customer_draft_style.door_style_Id) AS door_style_Id')
        )
        ->join('customer_draft_style', 'customer_draft_style.customer_draft_Id', '=', 'customer_draft.customer_draft_id')
        ->where('customer_id', $user->id)
        ->whereIn('customer_draft.draft_status', ['Pending', 'Save'])
        ->groupBy('customer_draft.customer_draft_id', 'customer_draft.customer_id', 'customer_draft.po_number', 'customer_draft.total_price', 'customer_draft.draft_status')
        ->get();

  
        
        
        return view('frontend.dashboard',compact('customer_draft','pagename'));
      }else{
        $customer_draft = "";
        return view('frontend.dashboard',compact('customer_draft','pagename'));
      }
    
   }

           public function draft_total($customer_id){
            $all_draft = CustomerDraft::where('customer_id',$customer_id)->get();
            foreach($all_draft as $all_draft){
              $id = $all_draft->customer_draft_id;
            $total_price =0;
                  $customer_draft = CustomerDraft::where('customer_draft_id',$id)->first();
                  $user = Auth::user()->id;
                  $taxGroup = Customer::select('tax_group','tax_rate')->where('user_id',$user)->first();
                  // $taxRate = TaxGroup::pluck('tax_rate')->first();
                  $taxRate  = SalesTax::where('zip_code', '6516')->value('tax_rate');
          
                  $product = DraftProduct::leftJoin('product_item', 'draft_product.product_id', '=', 'product_item.product_id')
                  ->leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
                  ->leftJoin('customer_draft_style', 'draft_product.draft_style_id', '=', 'customer_draft_style.draft_style_id')
                  ->where('draft_product.customer_draft_id', $id)
                  ->where('is_shipping_cost',"No")
                  ->select('draft_product.*','product_master.*','customer_draft_style.configuration as door_style_configuration',
                           'product_item.description as product_description',
                           'product_item.hinge_side as is_hinge_side','product_item.finish_side as is_finish_side','product_item.product_item_price as product_item_price','product_item.cut_depth','product_item.cut_depth_price')
                  ->get();
                  $draft_style_id = "";
                  foreach($product as $data){
                      $grup_discount = Customer::select('customer_group.group_dicount_percent')
                      ->leftJoin('customer_group','customer_group.customer_group_id','customer.customer_group_id')
                      ->where('customer.user_id',$user)
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
                          if($data->finish_side == "L"){
                             $price =$price + $finish_price->left_finish_side_price;
                          }elseif($data->finish_side == "R"){
                             $price =$price + $finish_price->right_finish_side_price;
                          }elseif($data->finish_side == "B"){
                             $price =$price + $finish_price->both_finish_side_price;
                          }
                     }
                
                      $DoorStylePrice = DraftProduct::selectRaw('SUM(product_door_style.doorstyle_price ) AS total_doorstyle_price')
                      ->where('draft_product.draft_product_id', $data->draft_product_id)
                      ->where('is_shipping_cost',"No")
                      ->join('customer_draft_style', 'draft_product.draft_style_id', '=', 'customer_draft_style.draft_style_id')
                      ->join('product_door_style', function ($join) {
                      $join->on('customer_draft_style.door_style_Id', '=', 'product_door_style.door_style_id')
                              ->on('draft_product.product_id', '=', 'product_door_style.product_id');
                      })->value('total_doorstyle_price');
          
                      $ModificationPrice = DraftProduct::selectRaw('SUM(item_modification.modification_price ) AS total_modification_price')
                      ->where('draft_product.draft_product_id', $data->draft_product_id)
                      ->where('is_shipping_cost',"No")
                      ->join('draft_product_modification', 'draft_product.draft_product_id', '=', 'draft_product_modification.draft_product_id')
                      ->join('item_modification', function ($join) {
                      $join->on('draft_product_modification.modification_id', '=', 'item_modification.modification_id')
                              ->on('draft_product.product_id', '=', 'item_modification.product_id');
                      })->value('total_modification_price');
                   
                      $AccessoriesPrice = DraftProduct::selectRaw('SUM(item_accessories.accessories_price ) AS total_accessories_price')
                      ->where('draft_product.draft_product_id', $data->draft_product_id)
                      ->where('is_shipping_cost',"No")
                      ->join('draft_product_accessories', 'draft_product.draft_product_id', '=', 'draft_product_accessories.draft_product_id')
                      ->join('item_accessories', function ($join) {
                      $join->on('draft_product_accessories.accessories_id', '=', 'item_accessories.accessories_id')
                              ->on('draft_product.product_id', '=', 'item_accessories.product_id');
                      })->value('total_accessories_price');
                  
                      if($data->cut_depth =="Yes" && $data->is_cut_depth == "Yes"){
                          $price =$price + $data->cut_depth_price;
                       }
           
                      $sumOfProductPrice = DB::table('item_dimensions')->where('product_id', $data->product_id)->sum('item_price');
                      
                      $price =$price + $sumOfProductPrice;
                      $price =$price + $ModificationPrice +$AccessoriesPrice +$DoorStylePrice;
                      $sub_total =$price * $data->quantity;
          
                      $total = $sub_total;
                      
                      $unassembled_discount = UnassembledDiscount::find(1);
                      if ($data->door_style_configuration  == "Unassembled") {
                       $configurationDiscount = $sub_total * ($unassembled_discount->unassembled_discount / 100); 
                    
                           $total -= $configurationDiscount;
                      }
          
                      $groupDiscount = $total * ($customer_draft->discount / 100);
                      $total -= $groupDiscount;
                      $shipping_cost=  $state = StateMaster::find($customer_draft->ship_state); 
                      $DefaultShippingCost = DefaultShippingCost::find('1');
          
                      $shippingCost = 0;
                      if ($customer_draft->service_type == "Curbside Delivery") {
                          // $shippingCost = 250;
                          if($shipping_cost->curbside_shipping_cost != 0)
                          {
                              $shippingCost =  $shipping_cost->curbside_shipping_cost;
                          }else{
                             
                              $shippingCost =  $DefaultShippingCost->curbside_shipping_cost;
          
                          }
                      } elseif ($customer_draft->service_type == "In-house Delivery") {
                          // $shippingCost = 250;
                          if($shipping_cost->in_house_shipping_cost != 0)
                          {
                              $shippingCost =  $shipping_cost->in_house_shipping_cost;
                          }else{
                              $shippingCost =  $DefaultShippingCost->in_house_shipping_cost;
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
                    
                          $price  -=$configurationDiscount_unit; 
                          
                      } 
                       $unit_discount = $price * ($customer_draft->discount / 100);
                       $price -=$unit_discount;
                      
                     
                  
                    if($taxGroup->tax_group == "With Tax")
                    {
                      if($customer_draft->service_type == "Self Pickup")
                      {
                          $taxGroupDiscount = $price * ($taxRate / 100);
                      }elseif($customer_draft->service_type == "Curbside Delivery")
                      {
                          $taxRate=null;
                          $stateTax = DB::table('state_tax')->where('state_tax_id', $customer_draft->ship_state)->first();
                          $taxRate = $stateTax->tax_rate;
                          $taxGroupDiscount = $price * ($taxRate / 100);
                      }else{
                          $taxRate=null;
                          $stateTax = DB::table('state_tax')->where('state_tax_id', $customer_draft->ship_state)->first();
                          $taxRate = $stateTax->tax_rate;
                          $taxGroupDiscount = $price * ($taxRate / 100);
                      }
          
                         $used_coupon= DB::table('used_coupon_history')->leftJoin('coupon_master', 'coupon_master.coupon_id', '=', 'used_coupon_history.coupon_id')->select('coupon_master.coupon_name','coupon_master.discount_type','used_coupon_history.*')->where('draft_id',$id)->get();
                      if($used_coupon != null){
                         foreach($used_coupon as $used_coupon){
                          if($used_coupon->discount_type == "Percentage")  
                          {
                            $couponDiscount = $price * ($used_coupon->discount / 100); 
                            $price -= $couponDiscount; 
                          }else{
                              $price -= $used_coupon->discount; 
          
                          }
                          
                         }
                      }
                      $draft_product->withoutTax_unit_price = $price;
                      $price += $taxGroupDiscount;
                      }
                   
                       
                       $draft_product->final_unit_price = $price;
                       $draft_product->total_price =  $total;
                      
                       $draft_product->save();
                       $total_price += $price;
          
                      
                  }
                  $draft_product = DraftProduct::where('customer_draft_Id', $id)->where('is_shipping_cost','Yes')->first();
              
                  //$shippingCost= $draft_product->final_unit_price;
                  if($total_price != 0){
                      $total_price +=$draft_product->final_unit_price;
                  }
                  
                  $customer_draft=CustomerDraft::where('customer_draft_id',$id)->first();
                  $customer_draft->tax_rate = $taxRate;
                  $customer_draft->total_price =$total_price;
                  // $customer_draft->original_price =$original_price;
                  $customer_draft->save();
                }
                 
                  $responseArray = array(
                    
                      'message'=>"Done"
                      );
                      // return $responseArray;
                  //     dd($responseArray);
                  return response()->json($responseArray);     
                
              }
}


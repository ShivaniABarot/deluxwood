@extends(backendView('layouts.app'))
@section('title', 'Tracking & Status View')
@section('content')
<div class="container-xxl">
<div class="row align-items-center">
   <div class="border-0 mb-4">
      <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
         <h3 class="fw-bold mb-0">View</h3>
      </div>
      <label class="form-label" name="draft_id" style="margin-left:8px;padding-top:8px">Draft Number  :{{$customerDraftId}} </label>
   </div>
</div>
<div class="row clearfix g-3">
<div class="col-lg-12">
   <div class="card mb-3">
      @php
      $iteration = 0;
      @endphp
      @php $sub_total = 0; @endphp
       @php $ItemtotalPrice  = 0; @endphp
      @php $totalCutDepthPrice = 0; $totalModificationPrice = 0; $totalDoorStylePrice  = 0; $totalAccessoriesPrice = 0; $hinge_value = 0; $finish_value = 0; $configurationDiscountSum= 0;@endphp
      @foreach ($products as $doorStyleId => $products)
    
      <div class="card-body">
         <div class="row g-3 align-items-center">
            <div class="col-md-6">
               <div class="single-item  active">
                  <div class="items-image">
                     @php
                     $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                     @endphp
                     @if($doorStyle->image != null)   
                     <img src="{{asset('public/img/door_style/' . $doorStyle->image)}}" alt="product" style="width: 185px; height: 210px;border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color);cursor: pointer;">
                     @else
                     <div style="width: 185px; height: 210px;border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color);cursor: pointer;">
                        <h5 class="text-center" style="position: absolute; top: 23%; left: 9%;">N/A</h5>
                     </div>
                     @endif
                  </div>
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-md-6">
                           <p class="text dcc_cls">@php
                           $draftStyle = \App\Models\DoorStyle::leftJoin('customer_draft_style','customer_draft_style.door_style_Id','door_style.doorStyle_id') 
                              ->where('customer_draft_style.door_style_Id', '=', $doorStyleId)
                              ->where('customer_draft_style.customer_draft_Id', '=', $customerDraftId)
                              ->select('customer_draft_style.draft_style_id','customer_draft_style.configuration')
                              ->first();
                              $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                              echo $doorStyle->name;
                              @endphp
                           </p>
                        </div>
                       
                     </div>
                     <div class="col-md-6">
                           <label class="form-label" >Configuration</label><br>
                           <a href="#" class="btn btn-secondary w-sm-100">{{$draftStyle->configuration}}</a>
                        </div>
                  </div>
               </div>
            </div>
              @if($iteration === 0)
            <div class="col-md-4">
               <div class="row">
                  <div class="col-md-12">
                     <label class="form-label">Status</label>
                  </div>
                  <div class="col-md-12">
                     @if($customer_draft->draft_status == "Inprogress")
                     <input type="text" class="form-control" name="" value="In Progress" readonly>
                     @else 
                     <input type="text" class="form-control" name="" value="{{$customer_draft->draft_status}}" readonly>
                     @endif
                  </div>
               </div>
            </div>
            @endif
         </div>
      </div>
     <div class="table-container" >
               <table class="table table-hover align-middle mb-0" style="width: 100%;">
                  <thead>
                     <tr>
                        <th class="text-center">QTY.</th>
                        <th class="text-center">Sku</th>
                        <th class="text-center">Cut Depth</th>
                        <th class="text-center">Accessories</th>
                        <th class="text-center">Modification</th>
                        <th class="text-center">Hinge Side</th>
                        <th class="text-center">Finished End</th>
                     
                     </tr>
                  </thead>
                  <tbody>
                     @if(!empty($products))
                     @foreach ($products as $data)
                     @php 
                     $price = $data->product_item_price;
                     $sides = DB::table('product_item')->where('product_id', $data->product_id)->first();
                     if ($sides && property_exists($sides, 'hinge_side') && $sides->hinge_side == "Yes") {
                          $hinge_price = DB::table('product_item_hinge_side')->where('product_id', $data->product_id)->first();
                          if ($data->hinge_side == "L") {
                              $price += $hinge_price->left_hinge_side_price ?? 0;
                          } elseif ($data->hinge_side == "R") {
                              $price += $hinge_price->right_hinge_side_price ?? 0;
                          } elseif ($data->hinge_side == "B") {
                              $price += $hinge_price->both_hinge_side_price ?? 0;
                          }
                      }

                      if ($sides && property_exists($sides, 'finish_side') && $sides->finish_side == "Yes") {
                          $finish_price = DB::table('product_item_finish_side')->where('product_id', $data->product_id)->first();
                          if ($data->finish_side == "L") {
                              $price += $finish_price->left_finish_side_price ?? 0;
                          } elseif ($data->finish_side == "R") {
                              $price += $finish_price->right_finish_side_price ?? 0;
                          } elseif ($data->finish_side == "B") {
                              $price += $finish_price->both_finish_side_price ?? 0;
                          }
                      }
                      $DoorPrice = DB::table('draft_product')
                     ->selectRaw('SUM(product_door_style.doorstyle_price * draft_product.quantity) AS total_doorstyle_price')
                     ->where('draft_product.draft_product_id', $data->draft_product_id)
                     ->join('customer_draft_style', 'draft_product.draft_style_id', '=', 'customer_draft_style.draft_style_id')
                     ->join('product_door_style', function ($join) {
                     $join->on('customer_draft_style.door_style_Id', '=', 'product_door_style.door_style_id')
                     ->on('draft_product.product_id', '=', 'product_door_style.product_id');
                     })
                     ->value('total_doorstyle_price');
                     $totalDoorStylePrice = $totalDoorStylePrice + $DoorPrice;
                     $ModificationPrice = DB::table('draft_product')
                     ->selectRaw('SUM(item_modification.modification_price * draft_product.quantity) AS total_modification_price')
                     ->where('draft_product.draft_product_id', $data->draft_product_id)
                     ->join('draft_product_modification', 'draft_product.draft_product_id', '=', 'draft_product_modification.draft_product_id')
                     ->join('item_modification', function ($join) {
                     $join->on('draft_product_modification.modification_id', '=', 'item_modification.modification_id')
                     ->on('draft_product.product_id', '=', 'item_modification.product_id');
                     })
                     ->value('total_modification_price');
                     $totalModificationPrice = $totalModificationPrice + $ModificationPrice;
                     $AccessoriesPrice = DB::table('draft_product')
                     ->selectRaw('SUM(item_accessories.accessories_price * draft_product.quantity) AS total_accessories_price')
                     ->where('draft_product.draft_product_id', $data->draft_product_id)
                     ->join('draft_product_accessories', 'draft_product.draft_product_id', '=', 'draft_product_accessories.draft_product_id')
                     ->join('item_accessories', function ($join) {
                     $join->on('draft_product_accessories.accessories_id', '=', 'item_accessories.accessories_id')
                     ->on('draft_product.product_id', '=', 'item_accessories.product_id');
                     })
                     ->value('total_accessories_price');
                     $totalAccessoriesPrice = $totalAccessoriesPrice + $AccessoriesPrice;

                     if($data->cut_depth == "Yes" && $data->is_cut_depth == "Yes"){
                     $price =$price + $data->cut_depth_price;
                     $totalCutDepthPrice = $totalCutDepthPrice +$data->cut_depth_price *$data->quantity;
                     }

                     $sumOfProductPrice = DB::table('item_dimensions')->where('product_id', $data->product_id)->sum('item_price');
                     $price =$price + $sumOfProductPrice;
                     $price =$price * $data->quantity;
                     $productTotalPrice = $data->product_item_price * $data->quantity;
                     $ItemtotalPrice += $productTotalPrice + $DoorPrice;
                     @endphp
                     <tr>
                        <td class="text-center">
                          {{$data->quantity}}
                        </td>
                        <td class="text-center">{{$data->product_item_sku}}</td>
                        <!-- {{$data->product_id}} {{$data->draft_product_id}} {{$ModificationPrice}} {{$AccessoriesPrice}} -->
                       
                        <td class="text-center">@if(!empty($data->selected_cut_depth) && $data->is_cut_depth == "Yes")
                             {{$data->selected_cut_depth}}
                         @else
                             None
                         @endif</td>
                        
                        @php
                        $PerAccessoriesPrice = DB::table('draft_product')
                        ->selectRaw('item_accessories.accessories_price')
                        ->where('draft_product.draft_product_id', $data->draft_product_id)
                        ->join('draft_product_accessories', 'draft_product.draft_product_id', '=', 'draft_product_accessories.draft_product_id')
                        ->join('item_accessories', function ($join) {
                        $join->on('draft_product_accessories.accessories_id', '=', 'item_accessories.accessories_id')
                        ->on('draft_product.product_id', '=', 'item_accessories.product_id');
                        })
                        @endphp
                        <td class="text-center"> 
                           @foreach ($data->accessories_nm as $accessoryName)
                           @if($accessoryName->accessories_nm =="")
                           None
                           @else
                           {{ $accessoryName->accessories_nm }}
                           @endif
                           <br>
                           @endforeach
                        </td>
                        <td class="text-center">
                           @foreach ($data->modification_nm as $modificationName)
                           @if($modificationName->modification_nm =="")
                           None
                           @else
                           {{ $modificationName->modification_nm }}
                           @endif
                           <br>
                           @endforeach
                        </td>
                        <td class="text-center">
                           @if($data->is_hinge_side == "Yes")  
                           <div class="size-block">
                              <div class="collapse show" id="size" >
                                 <div class="filter-size" id="filter-size-1">
                                    <ul>
                                    
                                    <li class="hinge_li @if($data->hinge_side === 'L') active @endif " data-hinge="L" data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">L</li>
                                    
                                    <li class="hinge_li @if($data->hinge_side === 'R') active @endif"  data-hinge="R"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">R</li>
                                 
                                    @if($data->hinge_side_none  === 'Yes')
                                    <li  class="hinge_li @if($data->hinge_side === 'None') active @endif" style="width: 47px;"   data-hinge="None" data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">-</li>
                                    @endif
                                 </ul>
                                 </div>
                              </div>
                           </div>
                           @else
                           <center>N/A</center>
                           @endif
                        </td>
                        <td class="text-center">
                           @if($data->is_finish_side == "Yes") 
                           <div class="size-block">
                              <div class="collapse show" id="size" >
                                 <div class="filter-size" id="filter-size-1">
                                    <ul>
                                      
                                       <li class="finish_li @if($data->finish_side === 'L') active @endif"  data-finish="L"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">L</li>
                                    
                                       <li class="finish_li @if($data->finish_side === 'R') active @endif"  data-finish="R"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">R</li>
                                       <li class="finish_li @if($data->finish_side === 'B') active @endif"  data-finish="B"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}" style="width: 39px;">Both</li>
                                       @if($data->finish_side_none  === 'Yes')
                                       <li class="finish_li @if($data->finish_side === 'None') active @endif"  data-finish="None"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}" style="width: 47px;">-</li>
                                       @endif
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           @else
                           <center>N/A</center>
                           @endif
                        </td>
                       
                     </tr>
                     @php $sub_total = $sub_total +$price;
                      $sub_total = $sub_total + $ModificationPrice +$AccessoriesPrice +$DoorPrice;
                     @endphp
                 @if ($sides && property_exists($sides, 'hinge_side') && $sides->hinge_side == "Yes")
                      @if ($data->hinge_side == "L" && isset($hinge_price->left_hinge_side_price))
                          @php $hinge_value += $hinge_price->left_hinge_side_price * $data->quantity @endphp
                      @endif
                      @if ($data->hinge_side == "R" && isset($hinge_price->right_hinge_side_price))
                          @php $hinge_value += $hinge_price->right_hinge_side_price * $data->quantity @endphp
                      @endif
                      @if ($data->hinge_side == "B" && isset($hinge_price->both_hinge_side_price))
                          @php $hinge_value += $hinge_price->both_hinge_side_price * $data->quantity @endphp
                      @endif
                  @endif

                  @if ($sides && property_exists($sides, 'finish_side') && $sides->finish_side == "Yes")
                      @if ($data->finish_side == "L" && isset($finish_price->left_finish_side_price))
                          @php $finish_value += $finish_price->left_finish_side_price * $data->quantity @endphp
                      @endif
                      @if ($data->finish_side == "R" && isset($finish_price->right_finish_side_price))
                          @php $finish_value += $finish_price->right_finish_side_price * $data->quantity @endphp
                      @endif
                      @if ($data->finish_side == "B" && isset($finish_price->both_finish_side_price))
                          @php $finish_value += $finish_price->both_finish_side_price * $data->quantity @endphp
                      @endif
                  @endif

                     @endforeach
                     @endif
                  </tbody>
               </table>
            </div>
            @php 
        
            $unassembled_discount = App\Models\UnassembledDiscount::find(1);
            if ($draftStyle->configuration == "Unassembled") {

                     $configurationDiscount = $sub_total * ($unassembled_discount->unassembled_discount / 100); 
                     
                     $configurationDiscountSum += $configurationDiscount;
                     
                     }
            $iteration++; @endphp
            @endforeach 
   <!-- Row End -->
</div>
         @php
            $used_coupon= DB::table('used_coupon_history')->leftJoin('coupon_master', 'coupon_master.coupon_id', '=', 'used_coupon_history.coupon_id')->select('coupon_master.coupon_name','coupon_master.discount_type','coupon_master.expiry_date','used_coupon_history.*')->where('draft_id',$customerDraftId)->get();
        
            @endphp

         @if(count($used_coupon) != 0)
         <h4><b>Coupons</b></h4><br>

         <div class="card mb-3">
            <div class="table-container" >
               <table class="table table-hover align-middle mb-0" id="coupon_table" style="width: 100%;">
                  <thead>
                     <tr>
                        <th class="">Coupon Name</th>
                        <th class="">Discount </th>
                        <th class="">Expiry Date </th>
                        <!-- <th>Action</th> -->
                     </tr>
                  </thead>
                  <tbody>
                  @foreach($used_coupon as $used_coupon)
                  <tr>
                     <td>{{$used_coupon->coupon_name}}</td>
                     @if($used_coupon->discount_type == "Percentage")
                        <td>{{$used_coupon->discount}}%</td>
                     @else
                        <td>${{$used_coupon->discount}}</td>
                     @endif
                     <td>{{$used_coupon->expiry_date}}</td>
                     
                  </tr>
                  @endforeach
                    
                  </tbody>
               </table>
            </div>
           
         </div>
         @endif
 <div class="card-body">
            <div class="product-cart">
               <div class="checkout-table">
                  <div class="table-responsive">
                     <div id="myCartTable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">
                           <div class="col-sm-12 col-md-6">
                              <div class="dataTables_length" id="myCartTable_length">
                                 <label>
                                    Show 
                                    <select name="myCartTable_length" aria-controls="myCartTable" class="form-select form-select-sm">
                                       <option value="10">10</option>
                                       <option value="25">25</option>
                                       <option value="50">50</option>
                                       <option value="100">100</option>
                                    </select>
                                    entries
                                 </label>
                              </div>
                           </div>
                           <div class="col-sm-12 col-md-6">
                              <div id="myCartTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="myCartTable"></label></div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                              <table id="myCartTable" class="table display dataTable table-hover align-middle nowrap no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="myCartTable_info">
                                 <thead>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 col-md-5">
                              <div class="dataTables_info" id="myCartTable_info" role="status" aria-live="polite">Showing 1 to 4 of 4 entries</div>
                           </div>
                           <div class="col-sm-12 col-md-7">
                              <div class="dataTables_paginate paging_simple_numbers" id="myCartTable_paginate">
                                 <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="myCartTable_previous"><a href="#" aria-controls="myCartTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="myCartTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item next disabled" id="myCartTable_next"><a href="#" aria-controls="myCartTable" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="checkout-coupon-total checkout-coupon-total-2 d-flex flex-wrap mt-2">
                  <div class="checkout-coupon">
                     <div class="row ">
                        <div class="col-3">
                           <label class="form-label" >Service Type </label><br>
                           <a href="#" class="btn btn-secondary w-sm-100">{{$customer_draft->service_type}}</a>
                        </div>
                        @if($customer_draft->customer_note != "")
                        <div class="col-11">
                           <div style="width: 100%;display: inline-block;padding-top: 20px;  font-size: 14px;font-family: 'Open Sans', sans-serif;">
                  
                              <label class="form-label" > Note</label>
                              <table width="100%" height="100%" >
                                 <tr>
                                 <td class="prc_cls" colspan="3" style="padding: 10px; background-color:#e9ecef" > {!! $customer_draft->customer_note !!} </td>
                                 </tr>
                              </table>
                              
                           </div>
                        </div>
                        @endif
                        <!-- <div class="col-3">
                           <label class="form-label" >Configuration</label><br>
                           @if($customer_draft->configuration == "Unassembled")
                           <a href="#" class="btn btn-secondary w-sm-100">{{$customer_draft->configuration}}</a>
                           @elseif($customer_draft->configuration == "Assembled")
                           <a href="#" class="btn btn-secondary w-sm-100">{{$customer_draft->configuration}}</a>
                           @endif
                        </div> -->
                     </div>
                  </div>
                 
                  <div class="checkout-total">
                     <div class="single-total">
                        @if($totalModificationPrice != 0)
                        <p class="value">Modification Price:</p>
                        <p class="price" id="">${{$totalModificationPrice}}</p>
                        @endif
                     </div>
                     <div class="single-total">
                        @if($totalAccessoriesPrice !=0)
                        <p class="value">Accessories Price:</p>
                        <p class="price" id="">${{$totalAccessoriesPrice}}</p>
                        @endif
                     </div>
                      <div class="single-total" style="display:none;">
                        @if($totalDoorStylePrice != 0)
                        <p class="value">DoorStyle Price:</p>
                        <p class="price" id="">${{$totalDoorStylePrice}}</p>
                        @endif
                     </div>
                     <div class="single-total">
                         @if($totalCutDepthPrice != 0)
                        <p class="value">Cut Depth Price:</p>
                      
                        <p class="price" id="totalModificationPrice">${{$totalCutDepthPrice}}</p>
                        @endif
                     </div>
                    
                     @if($hinge_value != 0)
                     <div class="single-total">
                        <p class="value">Hinge Side:</p>
                        <p class="price" id="">${{$hinge_value}}</p>
                       
                     </div>
                     @endif
                     <div class="single-total">
                        @if($finish_value != 0)
                        <p class="value">Finish Side:</p>
                        <p class="price" id="">${{$finish_value}}</p>
                        
                        @endif
                     </div>
                     <div class="single-total">
                        <p class="value">Item Price: </p>
                        <p class="price" id="sub_total">${{ number_format($ItemtotalPrice, 2, '.', '') }}</p>
                     </div>
                     <div class="single-total">
                        <p class="value">Subtotal: </p>
                        <p class="price" id="sub_total">${{ number_format($sub_total, 2, '.', '') }}</p>
                     </div>
                     <div class="single-total">
                        @if($configurationDiscountSum != 0)
                        <p class="value">Unassembled Discount:</p>
                        <p class="price" id="discount">{{$unassembled_discount->unassembled_discount}}%</p>
                        @endif
                       
                     </div>
                    
                   
                     <div class="single-total">
                       @if($customer_draft->discount!="")
                        <p class="value">Total Discount</p>
                        <p class="price" id="discount">{{$customer_draft->discount}}%</p>
                        @endif
                     </div>
                     @php
                    
                    $discountedPrice = $sub_total; 
                    $used_coupon= DB::table('used_coupon_history')->leftJoin('coupon_master', 'coupon_master.coupon_id', '=', 'used_coupon_history.coupon_id')->select('coupon_master.coupon_name','coupon_master.discount_type','used_coupon_history.*')->where('draft_id',$customerDraftId)->get();
                    if($configurationDiscountSum !=  0){
                     $discountedPrice -= $configurationDiscountSum;
                    }   
                  
                    $groupDiscount = $discountedPrice * ($customer_draft->discount / 100);
                    $discountedPrice -= $groupDiscount; 

                   
                    
                    if($taxGroup->tax_group == "With Tax")
                     {
                         if($customer_draft->service_type == "Self Pickup")
                         {
                             $taxGroupDiscount = $discountedPrice * ($taxRate / 100);
                         }elseif($customer_draft->service_type == "Curbside Delivery")
                         {
                           $taxGroupDiscount = $discountedPrice * ($customer_draft->zipcode_tax_rate / 100);
                  
                         }else{
                           $taxGroupDiscount = $discountedPrice * ($customer_draft->zipcode_tax_rate / 100);
                         }
                                    
                         $discountedPrice +=ceil($taxGroupDiscount * 100) / 100; 
                     }

                   
                    
                 
                
                  
                         if($used_coupon != null){
                        foreach($used_coupon as $used_coupon){
                     @endphp      
                           <div class="single-total">
                              <label class="value" >{{$used_coupon->coupon_name}}</label>
                              @if($used_coupon->discount_type == "Percentage")
                              <p class="price" >{{$used_coupon->discount}}%</p>
                              @else
                              <p class="price" >${{$used_coupon->discount}}</p>
                              @endif
                           </div>
                           @php 
                           if($used_coupon->discount_type == "Percentage")  
                           {   
                              $couponDiscount = $discountedPrice * ($used_coupon->discount / 100); 
                              $discountedPrice -= $couponDiscount; 
                           }else{
                              $discountedPrice -= $used_coupon->discount; 
                           }   
                          
                        }
                     }
                     @endphp
                  
                     <div class="single-total">
                     @if($taxGroup->tax_group == "With Tax")
                        @if($customer_draft->service_type == "Self Pickup")
                        <p class="value">Tax:</p>
                        <p class="price" id="discount">{{$taxRate}}%</p>
                        @elseif($customer_draft->service_type == "Curbside Delivery")
                           @php
                            
                              $taxRate = $customer_draft->zipcode_tax_rate;
                              if($taxRate == null){
                                 $taxRate = 0;
                              }
                           @endphp
                           
                           <p class="value">Tax:</p>
                           <p class="price" id="discount">{{$taxRate}}%</p>
                        @else
                           @php
                            
                              $taxRate = $customer_draft->zipcode_tax_rate;
                              if($taxRate == null){
                                 $taxRate = 0;
                              }
                           @endphp
                           
                           <p class="value">Tax:</p>
                           <p class="price" id="discount">{{$taxRate}}%</p>
                        @endif
                     @endif
                     </div>
                     @php $discountedPrice += $shippingCost; @endphp
                     <div class="single-total">
                         @if($shippingCost != 0)
                           <label class="value" >Shipping Cost</label>
                           <p class="price" id="sub_total">${{$shippingCost}}</p>
                           
                           @endif
                           <!-- <a href="#" class="btn btn-secondary w-sm-100">{{$customer_draft->configuration}}</a> -->
                     </div>
                      
                    
                     <div class="single-total total-payable">
                        <p class="value"><b>Total:</b></p>
                        <!-- <p class="value">Total Payable:</p> -->
                        <p class="price" id="discountedPrice"><b>${{  ceil($discountedPrice * 100) / 100}} </b></p>
                     </div>
                  </div>
               </div>
               
            </div>
         </div>
@endsection
@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('custom_styles')
<style>
 /* White buttons with black border */
   .btn-white-border {
   background-color: white;
   border-top: 1px solid gray;
   border-bottom: 1px solid black;
   color: black;
   }
   .btn-light:focus
   {
   background-color: #eca72f!important;
   }
   .grd_cls
   {
   height: 100%;
   border: 1px solid;
   padding: 15px;
   }
   .adcr_cls
   {
   width: 115px;
   }
   .svbt_cls
   {
   padding: 14px 0px 0px 42px;
   }
   .pcor_cls
   {
   padding: 14px;
   }
   .bllvr_cls
   {
   border: 1px solid #a6a6a4;
   padding: 1px;
   }
   .thn_cls
   {
   font-size: 11px;
   padding: 13px 9px 0px 9px;
/*   text-align: center;*/
   }
 
   .dcc_cls
   {
   font-weight: 600!important;
   padding-left: 14px;
   padding-top: 15px;
   font-size: 13px;
   }
   .pddc_cls
   {
   padding: 11px 0px 0px 35px;
   font-weight: 600;
   font-size: 10px;
   }
   .nx_cls
   {
   color: #ffc107 !important;
   }
   .nx_cls:hover
   {
   color: #FFFFFF!important;
   }
   .nx_cls:hover
   {
   background: none;
   }
   .size-block .filter-size ul li.active
   {
   background-color: #101010;
   border-color: #101010;
   }
   input,
   textarea {
   border: 1px solid #eeeeee;
   box-sizing: border-box;
   margin: 0;
   outline: none;
   padding: 10px;
   }
   input[type="button"] {
   -webkit-appearance: button;
   cursor: pointer;
   }
   input::-webkit-outer-spin-button,
   input::-webkit-inner-spin-button {
   -webkit-appearance: none;
   }
   .input-group {
   clear: both;
   margin: 15px 0;
   position: relative;
   }
   .input-group input[type='button'] {
   background-color: #eeeeee;
   min-width: 31px;
   width: auto;
   transition: all 300ms ease;
   }
   .input-group .button-minus,
   .input-group .button-plus {
   font-weight: bold;
   height: 38px;
   padding: 0;
   width: 38px;
   position: relative;
   }
   .input-group .quantity-field {
   position: relative;
   height: 38px;
   left: -6px;
   text-align: center;
   width: 62px;
   display: inline-block;
   font-size: 13px;
   margin: 0 0 5px;
   resize: vertical;
   }
   .button-plus {
   left: -13px;
   }
   input[type="number"] {
   -moz-appearance: textfield;
   -webkit-appearance: none;
   }
   .tbl {
   font-family: arial, sans-serif;
   border-collapse: collapse;
   width: 100%;
   }
   .pdsc_cls
   {
   padding-top: 10px;
   }
   .trd_cls
   {
   padding-top: 20px;
   }
   .fn_cls
   {
   padding: 3px;
   font-size: 11px;
   margin-bottom: 0px;
   }
   .thtd_cls {
   border: 1px solid #dddddd;
   text-align: left;
   padding: 8px;
   font-size: 10px;
   }
   tr.tr_cls:nth-child(even) {
   background-color: #dddddd;
   }
   .hr_cls
   {
   font-size: 11px;
   color: #212529;
   font-weight: normal;
   padding-top: 10px;
   }
   .dl_cls
   {
   color: #eca72f;
   }
   .lg_cls
   {
   width: 200px;
   padding-bottom: 53px;
   }
   .zp_cls
   {
   padding: 0px!important;
   }
   .size-block .zp_cls ul li 
   {
   font-size: 10px;
   }
   .tp_cls
   {
   display: flex;
   flex-direction: column;
   align-items: flex-start; 
   padding-left: 28px;
   padding-top: 50px;
   }
   .pd_cls
   {
   padding-bottom: 26px;
   }
   .tpp_cls
   {
   display: flex;
   flex-direction: column;
   align-items: flex-start; 
   padding-left: 28px;
   padding-top: 10px;
   }
   .dr_cls
   {
   padding-top: 20px;
   }
   .fn_cls
   {
   font-size: 11px;
   }
   .tablepdf tr th {
   color: var(--text-color);
   text-transform: uppercase;
   font-size: 13px;
   }
   .tablepdf tr td
   {
   font-size: 13px;
   }
   .tablepdf > :not(:first-child) {
   border-top: 2px solid currentColor;
   }
   .tablepdf {
   border-color: var(--border-color);
   }
   .tablepdf {
   --bs-table-bg: transparent;
   --bs-table-accent-bg: transparent;
   --bs-table-striped-color: #212529;
   --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
   --bs-table-active-color: #212529;
   --bs-table-active-bg: rgba(0, 0, 0, 0.1);
   --bs-table-hover-color: #212529;
   --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
   width: 100%;
   margin-bottom: 1rem;
   color: #212529;
   vertical-align: top;
   }
   .tablepdf > :not(caption) > * > * {
   padding: 0px!important;
   }
   .per_cls
   {
   border:1px solid #a6a6a4;
   text-align: center;
   }
   .plc_cls
   {
   border: 1px solid;
   background-color: #DDDDDD;
   }
   .grd_cls
   {
   height: 100%;
   border: 1px solid;
   }
</style>
@endpush
@push('scripts')
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/apexcharts.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/js/page/index.js') !!}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&callback=myMap"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<!--autocomplete search-->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
@endpush
@push('custom_scripts')
<script>
   $('#myDataTable')
    .addClass('nowrap')
    .dataTable({
        responsive: true,
        columnDefs: [{
            targets: [-1, -3],
            className: 'dt-body-right'
        }]
    });  
</script>
<script type="text/javascript">
   document.addEventListener("DOMContentLoaded", function() {
   var sidebar = document.querySelector(".sidebar");
   sidebar.classList.add("sidebar-mini");
   });
</script>
@endpush
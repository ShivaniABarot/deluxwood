@extends(backendView('layouts.app'))
@section('title', 'Add To Cart')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 border-bottom flex-wrap">
            <h3 class="fw-bold mb-0">New Drafts</h3>
            <div class="ms-auto">
               <a href="#" onclick="generatePDF(); return false;" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i> With Price</a>
               <a href="#" onclick="withoutPDF(); return false;" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i>Without Price</a>
            </div>
         </div>
         <label class="form-label" name="draft_id" style="margin-left:8px;padding-top:8px">Draft Number  :{{$customer_draft_Id}} </label>
      </div>
   </div>
   <!-- Row end  -->
   <div class="row clearfix g-3">
      <div class="col-lg-12">
         <div class="card mb-3">
            @php $iteration = 0; @endphp
            @php $sub_total = 0; @endphp
            @php $ItemtotalPrice  = 0; @endphp
            @php $totalCutDepthPrice = 0; $totalModificationPrice = 0; $totalDoorStylePrice  = 0;  $totalAccessoriesPrice = 0; $hinge_value = 0; $finish_value = 0;@endphp
            @foreach ($products as $doorStyleId => $products)
            <div class="card-body">
               <div class="row g-3 align-items-center">
                  <div class="col-md-6">
                     <div class="single-item  active">
                        <div class="items-image">
                           @php
                           $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                           @endphp
                           <img src="{{asset('public/img/door_style/' . $doorStyle->image)}}" alt="product" style="width: 185px; height: 210px;border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color);cursor: pointer;">
                        </div>
                        <div class="col-lg-12">
                           <div class="row">
                              <div class="col-md-6">
                                 <p class="text dcc_cls">
                                    @php
                                    $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                                    echo $doorStyle->name;
                                    @endphp
                                 </p>
                              </div>
                              @php
                              $draftStyle = \App\Models\DoorStyle::leftJoin('customer_draft_style','customer_draft_style.door_style_Id','door_style.doorStyle_id') 
                              ->where('customer_draft_style.door_style_Id', '=', $doorStyleId)
                              ->where('customer_draft_style.customer_draft_Id', '=', $customer_draft_Id)
                              ->select('customer_draft_style.draft_style_id')
                              ->first();
                              @endphp
                              <div class="col-md-6">
                                 <input type="hidden" class="door-style-id" name="doorStyleId_id" value="{{ $doorStyleId }}" >
                                 @if($iteration === 0)
                                 <a href="{{url('new-draft')}}/{{ $customer_draft_Id}}" class="btn btn-outline-warning text-uppercase nx_cls">Edit Draft</a>
                                 @endif
                                 <br>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     @csrf
                    <!--  <div class="row">
                        <div class="col-md-12">
                           <div class="input-group mb-3">
                              <input type="hidden" class="door-style-id" value="{{ $doorStyleId }}" hidden  name="door-id">
                              <input type="text" class="draft-style-id" value="{{ $draftStyle->draft_style_id}}" hidden>
                              <input type="text" class="customer-draft-id" value="{{$customer_draft_Id}}" hidden>
                              <div class="input-group-prepend">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 search-box-container">
                           <div class="input-group mb-3">
                              <input type="text" class="form-control typeahead search-box2"  placeholder="Search and add item">
                              <input type="hidden" class="door-style-id2" value="{{ $doorStyleId }}" hidden>
                              <input type="text" class="draft-style-id2" value="{{ $draftStyle->draft_style_id}}" hidden>
                              <input type="text" class="customer-draft-id2" value="{{$customer_draft_Id}}" hidden>
                              <div class="suggestions-list"></div>
                           </div>
                        </div>
                     </div> -->
                  </div>
               </div>
            </div>
            <div class="table-container" >
               <table class="table table-hover align-middle mb-0" style="width: 100%;">
                  <thead>
                     <tr>
                        <th class="">QTY.</th>
                        <th class="">Sku</th>
                        <th class="">Cut Depth</th>
                        <th class="">Accessories</th>
                        <th class="">Modification</th>
                        <th class="text-center">Hinge Side</th>
                        <th class="text-center">Finished End</th>
                        <th>Action</th>
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
                     ->selectRaw('SUM(product_door_style.doorstyle_price) AS total_doorstyle_price')
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
                     $ItemtotalPrice += $productTotalPrice;
                     @endphp
                     <tr>
                        <td style="width: 14%;">
                           <div class="input-group">
                              <input type="button" value="-" class="button-minus quantity-minus"data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}" data-field="quantity">
                              <input type="number" step="1" max="" value="{{$data->quantity}}" name="quantity" class="quantity-field quantity-num" data-product-quantity ="{{$data->quantity}}" data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">
                              <input type="button" value="+" class="button-plus quantity-plus"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}"  data-field="quantity">
                           </div>
                        </td>
                        <td >{{$data->product_item_sku}}</td>
                        <!-- <td >{{$data->product_name}}</td> -->
                        <!-- {{$data->product_id}} {{$data->draft_product_id}} {{$ModificationPrice}} {{$AccessoriesPrice}} -->
                        <!-- <td>{{$data->selected_cut_depth}}</td> -->
                        <td style="width: 10%;">
                           @if($data->is_cut_depth == "Yes")
                           <select class="form-control category selectcutDepth form-select" name="depth_name_inch" data-product-id="{{$data->product_id}}" data-draft-product-id="{{$data->draft_product_id}}">
                              <option value="">Select</option>
                              @if(isset($data->cut_depth_info))
                              @foreach ($data->cut_depth_info as $val)
                              @if($val->depth_name_inch  == $data->selected_cut_depth)
                              <option selected value="{{$val->depth_name_inch}}">{{ $val->depth_name_inch}}</option>
                              @else
                              <option value="{{$val->depth_name_inch}}">{{ $val->depth_name_inch}}</option>
                              @endif
                              @endforeach
                              @endif
                           </select>
                            @else
                            None
                           @endif
                        </td>
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
                        <td > 
                           @foreach ($data->accessories_nm as $accessoryName)
                           @if($accessoryName->accessories_nm =="")
                           None
                           @else
                           {{ $accessoryName->accessories_nm }}
                           @endif
                           <br>
                           @endforeach
                        </td>
                        <td >
                           @foreach ($data->modification_nm as $modificationName)
                           @if($modificationName->modification_nm =="")
                           None
                           @else
                           {{ $modificationName->modification_nm }}
                           @endif
                           <br>
                           @endforeach
                        </td>
                        <td class="text-center" style="width: 17%;">
                           @if($data->is_hinge_side == "Yes")  
                           <div class="size-block">
                              <div class="collapse show" id="size" >
                                 <div class="filter-size" id="filter-size-1">
                                    <ul>
                                   
                                    <li class="hinge_li @if($data->hinge_side === 'L') active @endif " data-hinge="L" data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">L</li>
                                   
                                  
                                    <li class="hinge_li @if($data->hinge_side === 'R') active @endif"  data-hinge="R"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">R</li>
                                 
                                    @if($data->hinge_side_none  === 'Yes')
                                    <li  class="hinge_li @if($data->hinge_side === 'None') active @endif" style="width: 47px;" data-hinge="None" data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">N/A</li>
                                    @endif
                                 </div>
                              </div>
                           </div>
                           @else
                           <center> N/A</center>
                           @endif
                        </td>
                        <td class="text-center" style="width: 20%;">
                           @if($data->is_finish_side == "Yes") 
                           <div class="size-block">
                              <div class="collapse show" id="size" >
                                 <div class="filter-size" id="filter-size-1">
                                    <ul>
                                      
                                       <li class="finish_li @if($data->finish_side === 'L') active @endif"  data-finish="L"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">L</li>
                                    
                                       <li class="finish_li @if($data->finish_side === 'R') active @endif"  data-finish="R"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">R</li>
                                       <li class="finish_li @if($data->finish_side === 'B') active @endif"  data-finish="B"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}" style="width: 39px;">Both</li>
                                       @if($data->finish_side_none  === 'Yes')
                                       <li class="finish_li @if($data->finish_side === 'None') active @endif"  data-finish="None"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}" style="width: 47px;">N/A</li>
                                       @endif
                                      
                                       
                                     
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           @else
                           <center> N/A</center>
                           @endif
                        </td>
                        <td>
                           <div class="btn-group" role="group" aria-label="Basic outlined example">
                              <!-- <a href="#" class="btn btn-outline-secondary"><i class="icofont-ui-settings text-success"></i></a> -->
                              <a href="javascript:void(0)" onclick="deleteModal('{{$data->draft_product_id}}');" class="btn btn-outline-secondary"><i class="icofont-trash text-danger"></i></a>
                           </div>
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
            @php $iteration++; @endphp
            @endforeach  
         </div>
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
                        <div class="col-3">
                           <label class="form-label" >Configuration</label><br>
                           @if($customer_draft->configuration == "Unassembled")
                           <a href="#" class="btn btn-secondary w-sm-100">{{$customer_draft->configuration}}</a>
                           @elseif($customer_draft->configuration == "Assembled")
                           <a href="#" class="btn btn-secondary w-sm-100">{{$customer_draft->configuration}}</a>
                           @endif
                           <!-- <a href="#" class="btn btn-secondary w-sm-100">{{$customer_draft->configuration}}</a> -->
                        </div>
                     </div>
                  </div>
                  <!-- <div class="checkout-coupon">
                     <span>Apply Coupon to get discount!</span>
                     <form action="#">
                        <div class="single-form form-default d-inline-flex mt-3">
                           <div class="input-group mb-3">
                              <input type="text" class="form-control" placeholder="Coupon Code" aria-label="Apply Coupon">
                              <button class="btn btn-primary" type="button">Apply</button>
                           </div>
                        </div>
                     </form>
                     </div> -->
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
                     <div class="single-total">
                        @if($totalDoorStylePrice != 0)
                        <p class="value">DoorStyle Price:</p>
                        <p class="price" id="">${{$totalDoorStylePrice}}</p>
                        @endif
                     </div>
                     <div class="single-total">
                        @if($totalCutDepthPrice != 0)
                        <p class="value">Cut Depth Price:</p>
                        <!-- <p class="value">Subotal Price:</p> -->
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
                        <p class="value">Item Price : </p>
                        <p class="price" id="sub_total">${{ number_format($ItemtotalPrice, 2, '.', '') }}</p>
                     </div>
                     <div class="single-total">
                        <p class="value">Subtotal</p>
                        <p class="price" id="sub_total">${{ number_format($sub_total, 2, '.', '') }}</p>
                     </div>
                     
                        <div class="single-total">
                        @if($customer_draft->configuration == "Unassembled")
                        <p class="value">Unassembled Discount:</p>
                        <p class="price" id="discount">8 %</p>
                    
                        @endif
                     </div>
                     <div class="single-total">
                        <p class="value">Total Discount:</p>
                        <p class="price" id="discount">{{$customer_draft->discount}}%</p>
                     </div>
                     <div class="single-total">
                         @if($customer_draft->service_type == "Curbside Delivery")
                           <label class="value" >Shipping Cost</label>
                           <p class="price" id="sub_total">$150</p>
                           
                           @endif
                           <!-- <a href="#" class="btn btn-secondary w-sm-100">{{$customer_draft->configuration}}</a> -->
                        </div>
                        <div class="single-total">
                          @if($customer_draft->service_type  == "In-house Delivery")
                           <label class="value" >Shipping Cost</label>
                           <p class="price" id="sub_total">$250</p>
                           @endif
                           <!-- <a href="#" class="btn btn-secondary w-sm-100">{{$customer_draft->configuration}}</a> -->
                        </div>
                    
                        @php
                        $shippingCost = 0; 

                        if ($customer_draft->service_type == "Curbside Delivery") {
                            $shippingCost = 150;
                        } elseif ($customer_draft->service_type == "In-house Delivery") {
                            $shippingCost = 250;
                        }

                        $discountedPrice = $sub_total; 

                        if ($customer_draft->configuration == "Unassembled") {
                            $configurationDiscount = $sub_total * (8 / 100); 
                            $discountedPrice -= $configurationDiscount; 
                        }

                        $groupDiscount = $discountedPrice * ($customer_draft->discount / 100);
                        $discountedPrice -= $groupDiscount; 

                        $discountedPrice += $shippingCost;

                        @endphp

                        <div class="single-total total-payable">
                            <p class="value">Total :</p>
                            <p class="price" id="discountedPrice">${{ number_format($discountedPrice, 2, '.', '') }}</p>
                        </div>

                  </div>
               </div>
               @if($discountedPrice == 0)
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-8">
                     </div>
                     <div class="col-sm-2">
                        <div class="single-btn w-sm-100 svbt_cls">
                           <a href="" class="btn btn-dark w-sm-100 adcr_cls" id="myLink"  >Save</a>
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="single-btn w-sm-100 pcor_cls">
                           <a href="" class="btn btn-dark w-sm-100 adcr_cls" disabled = true>Place Order </a>
                        </div>
                     </div>
                  </div>
               </div>
               @else
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-8">
                     </div>
                     <div class="row col-md-4">
                        <div class="col-4">
                           <div class="single-btn w-sm-100 svbt_cls">
                              <a href="#" class="btn btn-dark w-sm-100 adcr_cls" id="saveButton" data-custom-value="{{$customer_draft_Id}}">Save</a>
                           </div>
                        </div>
                        <div class="col-4">
                           <div class="single-btn w-sm-100 pcor_cls">
                              <a href="#" class="btn btn-dark w-sm-100 adcr_cls"  style="margin-left:10px;"id="quickbooks" data-custom-value="{{$customer_draft_Id}}">QuickBooks</a>
                           </div>
                        </div>
                        <div class="col-4">
                           <div class="single-btn w-sm-100 pcor_cls">
                              <a href="#" class="btn btn-dark w-sm-100 adcr_cls" id="placeOrderButton" data-custom-value="{{$customer_draft_Id}}">Place Order</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endif
            </div>
         </div>

      </div>
      <!-- Row End -->
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalLive" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Draft Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p>Are you sure you want to delete this Record ?</p>
         </div>
         <div class="modal-footer">
            <button type="button"  class="btn btn-warning" id="yes">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
         </div>
      </div>
   </div>
</div>
<!-- Without Price PDF Generate Start -->
<div class="row g-3 mb-3" id="invoice1" style="display: none;">
   <div class="col-md-12">
      <div class="card" style="border-color: #FFFFFF;">
         <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
               <img src="{{asset('public/logo.png')}}" class="lg_cls">  
               <h5 class="fw-bold mb-4 dl_cls">
               <p style="font-size: 11px; color: #212529;margin-bottom: 6px;margin-top: 6px;"><b>Sales Order -</b> #{{$customer_draft_Id}}&nbsp;&nbsp;&nbsp;</p>
               <p class="hr_cls">420 Frontage Rd, West Haven,<br> CT 06516, United States<br><b>Email : </b>deluxewoodcabinetry@gmail.com<br><b>Phone : </b>(475)655-2687</p>
               </h5>
            </div>
            <!--  <div class="row align-items-center">
               <div class="border-0 mb-2">
                  <div class=" py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between  flex-wrap">
                     <div class="custom-search-row">
                        <h4><b>Sales Order - #{{$customer_draft_Id}}</b></h4>
                     </div>
                    
                  </div>
               </div>
               </div> -->
            <div class="col-md-12 pd_cls">
               <div class="row">
                  <div class="col-md-4 bllvr_cls">
                     <p class="title" style="border-bottom: 1px solid #a6a6a4; padding: 3px;font-size: 13px;font-weight: Bold;">Bill To</p>
                     <!-- <h6 style="border-bottom: 1px solid #a6a6a4; padding: 3px;"><b>Bill To</b></h6> -->
                     <!-- <hr> -->
                     <p class="fn_cls">{{$pdf_data->representative_name}}<br>{{$pdf_data->company_name}}<br>{{$pdf_data->customer_address}}<br>{{$pdf_data->customer_no}}<br>{{$pdf_data->email}}</p>
                  </div>
                  <div class="col-md-4" ></div>
                  <div class="col-md-4 bllvr_cls" style="margin-top:-3px">
                     <p class="title" style="border-bottom: 1px solid #a6a6a4; padding: 3px;font-size: 13px;font-weight: Bold;">Ship To</p>
                     <!-- <h6 style="border-bottom: 1px solid #a6a6a4; padding: 3px;"><b>Ship To</b></h6> -->
                     <!-- <hr> -->
                     <p class="fn_cls">{{$pdf_data->ship_name}}<br>{{$pdf_data->ship_address}}, {{$pdf_data->ship_city}}, {{$pdf_data->ship_state}}, {{$pdf_data->ship_zip_code}}<br>{{$pdf_data->ship_contact_no}}<br>{{$pdf_data->ship_email}}</p>
                  </div>
               </div>
            </div>
         </div>
         <table style="width:100%;border:1px solid #a6a6a4;  border-width: 0px;">
            <tr>
               <th class="per_cls" style="font-size:11px;font-weight:600">Date</th>
               <th class="per_cls" style="font-size:11px;font-weight:600">PO Number</th>
               <th class="per_cls" style="font-size:11px;font-weight:600">Service Type</th>
               <th class="per_cls" style="font-size:11px;font-weight:600">Configuration</th>
            </tr>
            <tr>
               <td class="per_cls" style="font-size:11px">{{ $pdf_data->created_at->format('m-d-Y') }}</td>
               <td class="per_cls" style="font-size:11px">{{$pdf_data->po_number}}</td>
               <td class="per_cls" style="font-size:11px">{{$customer_draft->service_type}}</td>
               <td class="per_cls" style="font-size:11px">{{$customer_draft->configuration}}</td>
            </tr>
         </table>
         <?php 
            $i = 0;
            ?>
         @foreach ($without_arr as $doorStylewith => $pro)
         <div class="row g-3 align-items-center ">
            <div class="col-md-12">
            </div>
            <div class="col-md-6">
               <div class="single-item  active">
                  <!-- <div class="items-image">
                     @php
                     $doorStyle = \App\Models\DoorStyle::find($doorStylewith);
                     @endphp
                     <img src="{{ asset('public/img/door_style/' . $doorStyle->image) }}" alt="product" style="width: 185px; height: 210px;border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color);cursor: pointer;">
                     </div> -->
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-md-12">
                           <!--  <p class="text dc_cls">
                              @php
                              $doorStyle = \App\Models\DoorStyle::find($doorStylewith);
                              echo $doorStyle->name;
                              @endphp
                              </p> -->
                           <p class="text dc_cls">
                              @php
                              $doorStyle = \App\Models\DoorStyle::find($doorStylewith);
                              @endphp
                              <b>CAB. Style:</b> {{ $doorStyle->name }}
                           </p>
                        </div>
                        <div class="col-md-6">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <table class="tbl">
            <tr>
               <th class="thtd_cls text-center">Qty</th>
               <th class="thtd_cls text-center">Sku</th>
               <th class="thtd_cls text-center">Item Name</th>
               <th class="thtd_cls text-center">Cut Depth</th>
               <th class="thtd_cls text-center">Accessories</th>
               <th class="thtd_cls text-center">Modification</th>
               <th class="thtd_cls text-center">Hinge Side</th>
               <th class="thtd_cls text-center">Finish End </th>
            </tr>
            @php $sub_total = 0; @endphp
            @if(!empty($pro))
            @foreach ($pro as $data)
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
            if($data->modification_id != null)
            {
            $modification_price = DB::table('item_modification')->where('product_id', $data->product_id)->where('modification_id', $data->modification_id)->first();
            $price =$price + $modification_price->modification_price;
            }
            if($data->accessories_id != null)
            {
            $accessories_price = DB::table('item_accessories')->where('product_id', $data->product_id)->where('accessories_id', $data->accessories_id)->first();
            $price =$price + $accessories_price->accessories_price;
            }
            if($data->cut_depth =="Yes" && $data->is_cut_depth == "Yes"){
            $price =$price + $data->cut_depth_price;
            }
            $sumOfProductPrice = DB::table('item_dimensions')->where('product_id', $data->product_id)->sum('item_price');
            $price =$price + $sumOfProductPrice;
            $price =$price * $data->quantity;
            @endphp
            <tr class="tr_cls">
               <td class="thtd_cls text-center" style="width: 5%;">{{$data->quantity}}</td>
               <td class="thtd_cls text-center" style="width: 12%;">{{$data->product_item_sku}}</td>
               <td class="thtd_cls text-center" style="width: 20%;">{{$data->product_name}} </td>
               <td class="thtd_cls text-center" style="width: 10%;">
                  @if(!empty($data->selected_cut_depth))
                  {{$data->selected_cut_depth}}
                  @else
                  None
                  @endif
               </td>
               <td class="thtd_cls text-center" style="width: 15%;">
                  @foreach ($data->accessories_nm as $accessoryName)
                  @if(!empty($accessoryName->accessories_nm))
                  {{ $accessoryName->accessories_nm }}
                  <br>
                  @else
                  None
                  @endif
                  @endforeach
               </td>
               <td class="thtd_cls text-center" style="width: 15%;"> 
                  @foreach ($data->modification_nm as $modificationName)
                  @if(!empty($modificationName->modification_nm))
                  {{ $modificationName->modification_nm }}
                  <br>
                  @else
                  None
                  @endif
                  @endforeach
               </td>
               <td class="thtd_cls text-center" style="width: 10%;">
                  @if($data->is_hinge_side == "Yes")
                  @php
                  $hingeSideMap = [
                  'L' => 'Left',
                  'R' => 'Right',
                  'B' => 'Both',
                  'None' => 'N/A', // Display 'NONE' as 'NONE'
                  ];
                  @endphp
                  @if(isset($hingeSideMap[$data->hinge_side]))
                  {{ $hingeSideMap[$data->hinge_side] }}
                  @else
                  <center>N/A</center>
                  @endif
                  @else
                  <center>N/A</center>
                  @endif
               </td>
               <td class="thtd_cls text-center" style="width: 10%;">
                  @if($data->is_finish_side == "Yes")
                  @php
                  $finishSideMap = [
                  'L' => 'Left',
                  'R' => 'Right',
                  'B' => 'Both',
                  'None' => 'N/A',
                  ];
                  @endphp
                  @if(isset($finishSideMap[$data->finish_side]))
                  {{ $finishSideMap[$data->finish_side] }}
                  @else
                  <center>N/A</center>
                  @endif
                  @else
                  <center>N/A</center>
                  @endif
               </td>
            </tr>
            @php $sub_total = $sub_total +$price; @endphp
            @endforeach
            @endif
         </table>
         <?php $i++; ?>
         @endforeach
      </div>
   </div>
</div>
<!-- Without Price Pdf End -->
<!-- With Price Pdf Generate Start -->
<div class="row g-3 mb-3" id="invoice" style="display: none;">
   <div class="col-md-12">
      <div class="card" style="border-color: #FFFFFF;">
         <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
               <img src="{{asset('public/logo.png')}}" class="lg_cls">
               <h5 class="fw-bold mb-4 dl_cls">
                  <p style="font-size: 11px; color: #212529;margin-bottom: 6px;margin-top: 6px;"><b>Sales Order -</b> #{{$customer_draft_Id}}&nbsp;&nbsp;&nbsp;</p>
                  <p class="hr_cls">420 Frontage Rd, West Haven,<br> CT 06516, United States<br><b>Email : </b>deluxewoodcabinetry@gmail.com<br><b>Phone : </b>(475)655-2687</p>
               </h5>
            </div>
            <div class="col-md-12 pd_cls">
               <div class="row">
                  <div class="col-md-4 bllvr_cls">
                     <p class="title" style="border-bottom: 1px solid #a6a6a4; padding: 3px;font-size: 13px;font-weight: Bold;">Bill To</p>
                     <!-- <h6 style="border-bottom: 1px solid #a6a6a4; padding: 3px;"><b>Bill To</b></h6> -->
                     <!-- <hr> -->
                     <p class="fn_cls" style="margin-top:-2px">{{$pdf_data->representative_name}}<br>{{$pdf_data->company_name}}<br>{{$pdf_data->customer_address}}<br>{{$pdf_data->customer_no}}<br>{{$pdf_data->email}}</p>
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4 bllvr_cls" style="margin-top:-3px">
                     <p class="title" style="border-bottom: 1px solid #a6a6a4; padding: 3px;font-size: 13px;font-weight: Bold;">Ship To</p>
                     <!-- <h6 style="border-bottom: 1px solid #a6a6a4; padding: 3px;"><b>Ship To</b></h6> -->
                     <!-- <hr> -->
                    
                     <p class="fn_cls" style="margin-top:-2px">{{$pdf_data->ship_name}}<br>{{$pdf_data->ship_address}}, {{$pdf_data->ship_city}}, {{$pdf_data->ship_state}}, {{$pdf_data->ship_zip_code}}<br>{{$pdf_data->ship_contact_no}}<br>{{$pdf_data->ship_email}}</p>
                  </div>
               </div>
            </div>
         </div>
         <table style="width:100%;border:1px solid #a6a6a4;  border-width: 0px;">
            <tr>
               <th class="per_cls" style="font-size:11px;font-weight:600">Date</th>
               <th class="per_cls" style="font-size:11px;font-weight:600">PO Number</th>
               <th class="per_cls" style="font-size:11px;font-weight:600">Service Type</th>
               <th class="per_cls" style="font-size:11px;font-weight:600">Configuration</th>
            </tr>
            <tr>
               <td class="per_cls" style="font-size:11px;">{{ $pdf_data->created_at->format('m-d-Y') }}</td>
               <td class="per_cls" style="font-size:11px;">{{$pdf_data->po_number}}</td>
               <td class="per_cls" style="font-size:11px;">{{$customer_draft->service_type}}</td>
               <td class="per_cls" style="font-size:11px;">{{$customer_draft->configuration}}</td>
            </tr>
         </table>
         @php $sub_total = 0; @endphp
          @php $ItemtotalPrice  = 0; @endphp
         @php $totalCutDepthPrice = 0; $totalModificationPrice = 0;  $totalAccessoriesPrice = 0; $hinge_value = 0; $finish_value = 0;@endphp
         @foreach ($newdata_arr as $doorStyleId => $products)
         <div class="row g-3 align-items-center dr_cls">
            <div class="col-md-6">
               <div class="single-item  active">
                  <!-- <div class="items-image">
                     @php
                     $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                     @endphp
                     <img src="{{ asset('public/img/door_style/' . $doorStyle->image) }}" alt="product" style="width: 185px; height: 210px;border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color);cursor: pointer;">
                     </div> -->  
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-md-12">
                           <p class="text dc_cls">
                              @php
                              $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                              @endphp
                              <b>CAB. Style : </b> {{ $doorStyle->name }}
                           </p>
                        </div>
                        <div class="col-md-6">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               @csrf
            </div>
         </div>
         <table class="tbl">
            <tr>
               <th class="thtd_cls text-center">Qty</th>
               <th class="thtd_cls text-center">Sku</th>
               <th class="thtd_cls text-center">Item Name</th>
               <th class="thtd_cls text-center">Cut Depth</th>
               <th class="thtd_cls text-center">Accessories</th>
               <th class="thtd_cls text-center">Modification</th>
               <th class="thtd_cls text-center">Hinge Side</th>
               <th class="thtd_cls text-center">Finish End</th>
            </tr>
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
            $ItemtotalPrice += $productTotalPrice;
            @endphp
            <tr class="tr_cls">
               <td class="thtd_cls text-center" style="width: 5%;">{{$data->quantity}}</td>
               <td class="thtd_cls text-center" style="width: 12%;">{{$data->product_item_sku}}</td>
               <td class="thtd_cls text-center" style="width: 20%;">{{$data->product_name}}</td>
               <td class="thtd_cls text-center" style="width: 10%;">
                  @if(!empty($data->selected_cut_depth))
                  {{$data->selected_cut_depth}}
                  @else
                  None
                  @endif
               </td>
               <td class="thtd_cls text-center" style="width: 15%;">
                  @foreach ($data->accessories_nm as $accessoryName)
                  @if(!empty($accessoryName->accessories_nm))
                  {{ $accessoryName->accessories_nm }}
                  <br>
                  @else
                  None
                  @endif
                  @endforeach
               </td>
               <td class="thtd_cls text-center" style="width: 15%;"> 
                  @foreach ($data->modification_nm as $modificationName)
                  @if(!empty($modificationName->modification_nm))
                  {{ $modificationName->modification_nm }}
                  <br>
                  @else
                  None
                  @endif
                  @endforeach
               </td>
               <td class="thtd_cls text-center" style="width: 10%;">
                  @if($data->is_hinge_side == "Yes")
                  @php
                  $hingeSideMap = [
                  'L' => 'Left',
                  'R' => 'Right',
                  'B' => 'Both',
                  'None' => 'N/A', // Display 'NONE' as 'NONE'
                  ];
                  @endphp
                  @if(isset($hingeSideMap[$data->hinge_side]))
                  {{ $hingeSideMap[$data->hinge_side] }}
                  @else
                  <center>N/A</center>
                  @endif
                  @else
                  <center>N/A</center>
                  @endif
               </td>
               <td class="thtd_cls text-center" style="width: 10%;">
                  @if($data->is_finish_side == "Yes")
                  @php
                  $finishSideMap = [
                  'L' => 'Left',
                  'R' => 'Right',
                  'B' => 'Both',
                  'None' => 'N/A',
                  ];
                  @endphp
                  @if(isset($finishSideMap[$data->finish_side]))
                  {{ $finishSideMap[$data->finish_side] }}
                  @else
                  <center>N/A</center>
                  @endif
                  @else
                  <center>N/A</center>
                  @endif
               </td>
            </tr>
            @php $sub_total = $sub_total +$price;
            $sub_total = $sub_total + $ModificationPrice +$AccessoriesPrice ;
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
         </table>
         @endforeach
      </div>
      <div class="card pdsc_cls" style="border-color: #FFFFFF;">
         <div class="col-md-12">
            <div class="row">
               <div class="col-6" style="padding-top: 42px;">
                  <!--    <p class="thn_cls">*The estimated time your order will be ready for pick up is<br> <b> 1 FULL BUSINESS DAY </b>Excluding Holidays Closing Days from the time we receive your signature.
                     <br><br>---Signatures received after 10am will be considered as received on the next business day. Signatures received on Friday's after 9:30am will be considered as received on next business day---
                     <br><br>
                     **FOR DELIVERY, PLEASE CONTACT DELIVERY DEPARTMENT AT #373**
                     </p> -->
                  <div class="plc_cls">
                     <p class="thn_cls" style="font-size: 12px;">All paid and signed orders will be responded to within 24 hours.
                       <br>  <b>Return policy:</b>   
                     <br><br>
                     Customized cabinets are final sale. Regular returns are subject to a 35% restocking fee. In the event that you received the wrong 
                     merchandise or your merchandise arrived damaged, you must report this within 72 hours to qualify for a cost free replacement.
                     </p>
                  </div>
                  <!-- <h6 class="text-center" style="padding-top: 22px;">**NOTE: All our deliveries are TAIL GATE DELIVERY ONLY**</h6>
                     <h6 class="text-center"><b>Please make sure to have people to unload the truck.</b></h6> -->
               </div>
               <div class="col-md-6">
                  <div class="table-form table-layout-2 table-responsive pt-3">
                     <table class="tablepdf">
                        <thead>
                           <tr>
                              <!-- <th scope="col" style="font-size: 22px;">Price</th> -->
                              <!-- <th scope="col" class="text-right">Total</th> -->
                           </tr>
                        </thead>
                        <tbody>
                           @if($totalModificationPrice != 0)
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="padding-top: 20px; font-size: 11px; font-weight: normal;">Modification Price</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="padding-top: 20px; font-size: 11px; font-weight: normal;">${{$totalModificationPrice}}
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           @endif
                           @if($totalAccessoriesPrice !=0)
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;@if ($totalModificationPrice == 0) padding-top: 20px; @endif">Accessories Price</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;@if ($totalModificationPrice == 0) padding-top: 20px; @endif">${{$totalAccessoriesPrice}}
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           @endif
                       
                            @if($totalCutDepthPrice != 0)
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px ;font-weight: normal;font-weight: normal;@if ($totalModificationPrice == 0 && $totalAccessoriesPrice == 0) padding-top: 20px; @endif">Cut Depth Price</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;@if ($totalModificationPrice == 0 && $totalAccessoriesPrice == 0) padding-top: 20px; @endif">${{$totalCutDepthPrice}}
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           @endif
                           @if($hinge_value != 0)
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Hinge Side</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">${{$hinge_value}}
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           @endif
                           @if($finish_value != 0)
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Finish Side</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">${{$finish_value}}
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           @endif
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Item Price</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">${{ number_format($ItemtotalPrice, 2, '.', '') }}
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Subtotal</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">${{ number_format($sub_total, 2, '.', '') }}
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                            @if($customer_draft->service_type == "Curbside Delivery")
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Shipping Cost</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">$150
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           @endif
                           @if($customer_draft->service_type  == "In-house Delivery")
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Shipping Cost</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">$250
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           @endif
                            @if($customer_draft->configuration == "Unassembled")
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Unassembled Discount</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight:normal;">8 %
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           @endif
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Total Discount</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">{{$customer_draft->discount}}%
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                          
                          <!--  <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Total Discount</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">{{$grup_discount->group_dicount_percent}}%
                                    </h3>
                                 </div>
                              </td>
                           </tr> -->
                        @php
                        $shippingCost = 0; 

                        if ($customer_draft->service_type == "Curbside Delivery") {
                            $shippingCost = 150;
                        } elseif ($customer_draft->service_type == "In-house Delivery") {
                            $shippingCost = 250;
                        }

                        $discountedPrice = $sub_total; 

                        if ($customer_draft->configuration == "Unassembled") {
                            $configurationDiscount = $sub_total * (8 / 100); 
                            $discountedPrice -= $configurationDiscount; 
                        }

                        $groupDiscount = $discountedPrice * ($customer_draft->discount / 100);
                        $discountedPrice -= $groupDiscount; 

                        $discountedPrice += $shippingCost;

                        @endphp
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 12px;font-weight: Bold;">Total</p>
                                    <!-- <h6>Total (Net Payable)</h6> -->
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 12px;font-weight: Bold;">${{ number_format($discountedPrice, 2, '.', '') }}</p>
                                    <!-- <h6>${{ number_format($discountedPrice, 2, '.', '') }}</h6> -->
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-12" style="padding-top: 25px;">
            <div class="row">
               <!-- <div class="col-md-1"></div> -->
               <div class="col-md-6">
                  <div class="grd_cls">
                     <hr style="
                        width: 68%;
                        float: right;
                        ">
                     <h6 style="padding: 5px;font-size: 14px;">Name</h6>
                     <hr style="
                        width: 68%;
                        float: right;
                        ">
                     <h6 style="padding:5px;font-size: 14px;">Signature</h6>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- With Price Pdf End -->
@endsection
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
   .dc_cls
   {
   font-weight: 600!important;
   /*   padding-left: 44px;*/
   padding-top: 10px;
   font-size: 10px;
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
   /* ------------------suggestions-------------------- */
   .search-box-container {
   position: relative; /* Add this to establish a relative positioning context */
   }
   .suggestions-list {
   position: absolute;
   top: 100%; /* Position suggestions below the search box */
   width: 100%;
   max-height: 200px;
   overflow-y: auto;
   border: 1px solid #ccc;
   background-color: white;
   z-index: 1000;
   }
   .suggestion-item {
   padding: 10px;
   border-bottom: 1px solid #eee;
   cursor: pointer;
   display: flex;
   justify-content: space-between;
   align-items: center;
   }
   .suggestion-icon {
   font-size: 20px;
   color: #888;
   margin-right: 10px;
   }
   .suggestion-text {
   display: flex;
   flex-direction: column;
   }
   .suggestion-sku {
   font-weight: bold;
   font-size: 16px;
   }
   .suggestion-name {
   font-size: 12px;
   color: #666;
   }
   .custom-add-button {
   padding: 3px 6px;
   font-size: 14px;
   color:orange ;
   background-color: white;
   /* border: orange; */
   border-radius: 5px;
   cursor: pointer;
   }
   /* --------------------------------------- */
</style>
@endpush
@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endpush
@push('custom_scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script type="text/javascript"></script>
<script>
   $(document).ready(function () {
      $("#saveButton").click(function (event) {
           var customerDraftId =$("#saveButton").data("custom-value");
           var discountedPrice =  parseFloat($('#discountedPrice').html().replace('$', ''));
           var subTotal =  parseFloat($('#sub_total').html().replace('$', '')); 
     
           var url = "{{ url('save-draft') }}/save/" + customerDraftId + "/" + discountedPrice + "/" + subTotal;
           window.location.href = url;
   
           console.log("Custom Value:", customerDraftId);
       });
       $("#quickbooks").click(function (event) {
           var customerDraftId =$("#quickbooks").data("custom-value");
           var discountedPrice =  parseFloat($('#discountedPrice').html().replace('$', ''));
           var subTotal =  parseFloat($('#sub_total').html().replace('$', '')); 
     
           var url = "{{ url('save-draft') }}/quickbooks/" + customerDraftId + "/" + discountedPrice + "/" + subTotal;
           window.location.href = url;
   
           console.log("Custom Value:", customerDraftId);
       });
       $("#placeOrderButton").click(function (event) {
           var customerDraftId =$("#placeOrderButton").data("custom-value");
           var discountedPrice =  parseFloat($('#discountedPrice').html().replace('$', ''));
           var subTotal =  parseFloat($('#sub_total').html().replace('$', '')); 
     
           var url = "{{ url('save-draft') }}/order/" + customerDraftId + "/" + discountedPrice + "/" + subTotal;
           window.location.href = url;
   
           console.log("Custom Value:", customerDraftId);
       });
   
         // Product Search Functionality
   
      //  var suggestionsList;
      // $('.search-box2').on('input', function() {
   
      //     const searchBox = $(this);
      //     var sku = $(this).val();
      //     var doorStyleId = $(this).siblings(".door-style-id2").val();
      //     var draftStyleId = $(this).siblings(".draft-style-id2").val();
      //     var customerDraftId = $(this).siblings(".customer-draft-id2").val();
   
    
      //     suggestionsList = $(this).siblings('.suggestions-list');
   
      //     if (sku.length >= 1) {
      //         $.ajax({
      //             url: "/get-products-by-sku-and-door-style",
      //             method: 'GET',
      //             data: {
      //                 sku: sku,
      //                 door_style_id: doorStyleId,
      //                 draft_style_id: draftStyleId,
      //                 customer_draft_Id: customerDraftId
      //             },
      //             success: function(suggestions) {
      //                 suggestionsList.empty();
      //                 for (const suggestion of suggestions) {
      //                     const suggestionItem = `<div class="suggestion-item">
      //                         <div class="suggestion-text " data-product-id="${suggestion.product_id}" data-draft-style-id="${draftStyleId}" data-customer-draft-id="${customerDraftId}">
      //                         <span class="suggestion-sku">${suggestion.product_item_sku}</span>
      //                         <span class="suggestion-name">${suggestion.product_name}</span>
      //                         </div>
      //                         <button class="btn btn-outline-warning text-uppercase nx_cls suggestion-add-btn" style="padding: 3px 6px; font-size: 14px;"  data-product-id="${suggestion.product_id}" data-draft-style-id="${draftStyleId}" data-customer-draft-id="${customerDraftId}">Save</button>
                              
      //                     </div>`;
                    
      //                     suggestionsList.append(suggestionItem);
                          
      //                 }
                      
      //                 $(".suggestion-add-btn").click(suggestionClick);
      //             }
      //         });
      //     } else {
      //         suggestionsList.empty();
      //     }
      // });
      //  var suggestionClick = function() {
   
      //     var productId = $(this).data("product-id");
   
      //     var draftStyleId = $(this).data("draft-style-id");
   
      //     var customerDraftId = $(this).data("customer-draft-id");
      //     console.log(draftStyleId);
   
      //     $.ajax({
      //         url: "/store-draft-product",
      //         type: "GET",
      //         data: {
      //             product_id: productId,
      //             draft_style_id: draftStyleId,
      //             customer_draft_Id: customerDraftId
      //         },
      //         success: function (response) {
      //          window.location.reload();
      //             var obj = JSON.parse(JSON.stringify(response));
      //             showAlert(obj.message);
      //             var $card = $(this).closest(".card");
      //             loadDraftProducts($card);
   
      //     }.bind(this) 
      //     });
      // };
      // $(document).on('click', function(event) {
         
      //     if (!$(event.target).closest('.suggestions-list').length) {
      //         suggestionsList.empty();
      //     }
      // });
   });
</script>
<script type="text/javascript">
   $(document).on("change", ".selectcutDepth", function () {
   
       var selectedDepth = $(this).val();
       var productId = $(this).data('product-id');
       var draftProductId = $(this).data('draft-product-id');
       $.ajax({
           url: "/updateSelectedCutDepth",
           type: "GET",
           data: {
               selectedDepth: selectedDepth,
               productId: productId,
               draftProductId: draftProductId
           },
           success: function (response) {
            window.location.reload();
           },
           error: function (error) {
              
           },
       });
   });
</script>
<script>
   $(document).on("change", ".quantity-num", function (event) {
      console.log("keyup");
      var inputElement = $(this);
    var newQuantity = parseInt(inputElement.val()); // Parse the entered quantity to an integer
   
    if (isNaN(newQuantity)) {
        inputElement.val(inputElement.data("product-quantity"));
        return;
    }
        var productId = $(this).data("product-id");
        var draftStyleId = $(this).data("draft-style-id");
        var q =  $(this).closest(".input-group").find(".quantity-num");
      
        console.log(productId);
        console.log(draftStyleId);
        $.ajax({
            url: "/quantity-update", // Update the URL accordingly
            type: "GET", // Use POST method to send the new quantity
            data: {
                product_id: productId,
                draft_style_id: draftStyleId,
                new_quantity: newQuantity // Send the new quantity to the server
            },
            success: function (response) {
               //  console.log(response);
               //  // Handle success response here, if needed
               //  location.reload();
               q.val(response.quantity);
                  $('#totalModificationPrice').html('$'+response.totalModificationPrice)
                   $('#sub_total').html('$' + response.sub_total.toFixed(2))
                   $('#discount').html(response.discount+'%')
                   $('#discountedPrice').html('$' + response.discountedPrice.toFixed(2))
                    window.location.reload();
            },
            error: function (error) {
                // Handle errors if needed
            },
        });
   });
   $(document).on("click", ".quantity-plus", function () {
         var productId = $(this).data("product-id");
         var draftStyleId = $(this).data("draft-style-id");
         var q =  $(this).closest(".input-group").find(".quantity-num");
                  
      console.log(draftStyleId);
         $.ajax({
            url: "/quantity-plus",
            type: "GET",
            data: {
                  product_id: productId,
                  draft_style_id:draftStyleId
            },
            success: function (response) {
                 
                    q.val(response.quantity);
                   $('#totalModificationPrice').html('$'+response.totalModificationPrice)
                   $('#sub_total').html('$' + response.sub_total.toFixed(2))
                   $('#discount').html(response.discount+'%')
                   $('#discountedPrice').html('$' + response.discountedPrice.toFixed(2))
                  $(this).siblings(".quantity").val();
                  console.log("quantity-plus");
                  // location.reload();
                   window.location.reload();
            },
            error: function (error) {
                  // Handle errors if needed
            },
         });
      });
   $(document).on("click", ".quantity-minus", function () {
         var productId = $(this).data("product-id");
         var draftStyleId = $(this).data("draft-style-id");
         var q =  $(this).closest(".input-group").find(".quantity-num");
         if(q.val() !=1){
      console.log(draftStyleId);
         $.ajax({
            url: "/quantity-minus",
            type: "GET",
            data: {
                  product_id: productId,
                  draft_style_id:draftStyleId
            },
            success: function (response) {
                  console.log(response);
                  q.val(response.quantity);
                  $('#totalModificationPrice').html('$'+response.totalModificationPrice)
                   $('#sub_total').html('$' + response.sub_total.toFixed(2))
                   $('#discount').html(response.discount+'%')
                   $('#discountedPrice').html('$' + response.discountedPrice.toFixed(2))
                  $(this).siblings(".quantity").val();
                  console.log("quantity-minus");
                  // location.reload();
                   window.location.reload();
            },
            error: function (error) {
                  // Handle errors if needed
            },
         });
      }
   });
   $(document).on("click", ".hinge_li", function () {
         var productId = $(this).data("product-id");
         var draftStyleId = $(this).data("draft-style-id");
         var hinge = $(this).data("hinge");
         var clickedLi = $(this);
      console.log(draftStyleId);
         $.ajax({
            url: "/add-hinge",
            type: "GET",
            data: {
                  product_id: productId,
                  draft_style_id:draftStyleId,
                  hinge:hinge
            },
            success: function (response) {
                  console.log(response);
                  $('#totalModificationPrice').html('$'+response.totalModificationPrice)
                   $('#sub_total').html('$' + response.sub_total.toFixed(2))
                   $('#discount').html(response.discount+'%')
                   $('#discountedPrice').html('$' + response.discountedPrice.toFixed(2))
                  var filterSizeContainer = clickedLi.closest(".filter-size");
                     filterSizeContainer.find(".hinge_li").removeClass("active");
                     clickedLi.addClass("active");
                     // location.reload();
                      window.location.reload();
            
            },
            error: function (error) {
                  // Handle errors if needed
            },
         });
   });
   $(document).on("click", ".finish_li", function () {
         var productId = $(this).data("product-id");
         var draftStyleId = $(this).data("draft-style-id");
         var finish = $(this).data("finish");
         var clickedLi = $(this);
      console.log(draftStyleId);
         $.ajax({
            url: "/add-finish-side",
            type: "GET",
            data: {
                  product_id: productId,
                  draft_style_id:draftStyleId,
                  finish:finish
            },
            success: function (response) {
                  console.log(response);
                  $('#totalModificationPrice').html('$'+response.totalModificationPrice)
                   $('#sub_total').html('$' + response.sub_total.toFixed(2))
                   $('#discount').html(response.discount+'%')
                   $('#discountedPrice').html('$' + response.discountedPrice.toFixed(2))
                  var filterSizeContainer = clickedLi.closest(".filter-size");
                     filterSizeContainer.find(".finish_li").removeClass("active");
                     clickedLi.addClass("active");
                     // location.reload();
                window.location.reload();
            },
            error: function (error) {
                  // Handle errors if needed
            },
         });
   }); 
   $(function(){
         
         // showing modal with effect
         $('.modal-effect').on('click', function(e){
         e.preventDefault();
      
         var effect = $(this).attr('data-effect');
         $('#exampleModalLive').addClass(effect);
         $('#exampleModalLive').modal('show');
         });
      
         // hide modal with effect
         $('#exampleModalLive').on('hidden.bs.modal', function (e) {
         $(this).removeClass (function (index, className) {
               return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
         });
         });
      });
   function deleteModal(id) {
      
      $("#exampleModalLive").modal('show');
         
      $('#yes').on('click', function(event){
          $("#conformation-modal").modal('hide');
          $.ajax({
              url: "{{ url('draft-product/delete/') }}"+'/'+id,
              type: 'GET',
              dataType: 'html',
              success:function(data) {
              
               
               if(data == 0 ){
                  console.log("nooo");
                  location.reload();
               }else{
                  console.log("okkk");
                 window.location.href = '/new-draft/' + data;
                  
               }
                
                 
              }
          });
      });
    }   
      //  $(function(){
         
      //    // showing modal with effect
      //    $('.modal-effect').on('click', function(e){
      //    e.preventDefault();
      
      //    var effect = $(this).attr('data-effect');
      //    $('#exampleModalLiveprice').addClass(effect);
      //    $('#exampleModalLiveprice').modal('show');
      //    });
      
      //    // hide modal with effect
      //    $('#exampleModalLiveprice').on('hidden.bs.modal', function (e) {
      //    $(this).removeClass (function (index, className) {
      //          return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
      //    });
      //    });
      // });
   
   // function Selectprice() {
      
   //    $("#exampleModalLiveprice").modal('show');
         
   //    $('#yes').on('click', function(event){
   //        $("#conformation-modal").modal('hide');
   //        $.ajax({
   //            url: "",
   //            type: 'GET',
   //            dataType: 'html',
   //            success:function(response) {
   //               location.reload();
   //            }
   //        });
   //    });
   //  }                   
</script>
<script type="text/javascript">
   function generatePDF() {
    // Get the HTML content of the invoice
    const invoice = document.getElementById("invoice").innerHTML;
   
       html2pdf().set({
   margin: [0, 0.2, 0, 0.2],
    filename: '{{$pdf_data->client_name}}_{{$pdf_data->po_number}}.pdf',
   image: { type: 'jpeg', quality: 0.98 },
   html2canvas: { dpi: 300, letterRendering: true, scale: 2 },
   jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
   pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
   }).from(invoice).save();
   }
</script>
<script type="text/javascript">
   function withoutPDF() {
    // Get the HTML content of the invoice
    const invoice = document.getElementById("invoice1").innerHTML;
   
    html2pdf().set({
   margin: [0, 0.2, 0, 0.2],
    filename: '{{$pdf_data->client_name}}_{{$pdf_data->po_number}}.pdf',
   image: { type: 'jpeg', quality: 0.98 },
   html2canvas: { dpi: 300, letterRendering: true, scale: 2 },
   jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
   pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
   }).from(invoice).save();
   }
   
</script>
<script type="text/javascript">
   document.addEventListener("DOMContentLoaded", function() {
   var sidebar = document.querySelector(".sidebar");
   sidebar.classList.add("sidebar-mini");
   });
</script>
<script>
   const myButton = document.getElementById("myButton");
   
   function blockButton() {
       myButton.disabled = true;
   }
</script>
@endpush
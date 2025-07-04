@extends(backendView('layouts.app'))
@section('title', 'Add To Cart')
<style>
  .coupon-form {
    display: flex; /* Arranges elements in a row */
    margin-top:25px;
  /*margin: 1rem auto; Adds some margin for spacing */
    width: fit-content; /* Adjusts width to content size */
  }
  
  .coupon-input {
    flex: 1; /* Makes input field take up most of the space */
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius:5px 0 0 5px /* Adds rounded corners */
  }
  
  .coupon-button {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0 5px 5px 0;
    background-color: #007bff; /* Blue button color */
    color: #fff; /* White button text */
    cursor: pointer; /* Changes cursor to indicate clickability */
  }
</style>
@section('content')
    <div class="container-xxl">
       <div class="row align-items-center">
          <div class="border-0 mb-4">
             <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">New Drafts</h3>
                <div class="ms-auto">
                   <button  class="btn btn-dark py-2 px-5 btn-set-task w-sm-100" id="refreshButton" data-action="save" data-custom-value="{{$customer_draft_Id}}" >Refresh </button>
                   <a href="{{url('with-price')}}/{{$customer_draft_Id}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i> With Price</a>
                   <a href="{{url('without-price')}}/{{$customer_draft_Id}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i>Without Price</a>
                </div>
             </div>
          </div>
       </div>
       <label class="form-label" name="draft_id" style="margin-left:8px;">PO: {{$customerDraft->po_number}} </label>
       <label class="form-label" name="draft_id" style="margin-left:25px;">Draft Number: {{$customer_draft_Id}} </label>
       <label class="form-label" name="draft_id" style="margin-left:25px;">Designer: {{$customerDraft->designer}} </label>
       @if (session('success'))
           <div class="col-4 alert alert-success" style="margin-left:730px">
              {{ session('success') }}
           </div>
       @endif
       @if (session('error'))
           <div class="col-4 alert alert-danger" style="margin-left:730px">
              {{ session('error') }}
           </div>
       @endif
       <!-- Row end  -->
       <div class="row clearfix g-3">
          <div class="col-lg-12">
             <div class="card mb-3">
                @php $iteration = 0; @endphp
                @php $sub_total = 0; @endphp
                @php $ItemtotalPrice = 0; @endphp
                @php $totalCutDepthPrice = 0;
                    $totalModificationPrice = 0;
                    $totalDoorStylePrice = 0;
                    $totalAccessoriesPrice = 0;
                    $hinge_value = 0;
                    $finish_value = 0;
                $configurationDiscountSum = 0;@endphp
               
               @if(!empty($products) && count($products) > 0)
    @foreach ($products as $doorStyleId => $styleProducts)
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="single-item active">
                        <div class="items-image">
                            @php
                                $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                            @endphp
                            @if ($doorStyle && !empty($doorStyle->image))
                                <img 
                                    src="{{ asset('img/door_style/' . $doorStyle->image) }}" 
                                    alt="Door Style: {{ $doorStyle->name ?? 'N/A' }}" 
                                    style="width: 185px; height: 210px; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color); cursor: pointer;">
                            @else
                                <img src="https://placehold.co/185x210" alt="Default door style image - wood texture with modern cabinet design" style="border-radius: 8px;">
                            @endif
                        </div>
                        <!-- Rest of your card content -->
                    </div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table class="table table-hover align-middle mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>QTY.</th>
                        <th>Sku</th>
                        <th>Cut Depth</th>
                        <th>Accessories</th>
                        <th>Modification</th>
                        <th class="text-center">Hinge Side</th>
                        <th class="text-center">Finished End</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @php $product_index = 1;@endphp
                     @if(!empty($products))
                     @php  $door_style_total=0; @endphp
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
                              })->value('total_doorstyle_price');

                              $totalDoorStylePrice = $totalDoorStylePrice + $DoorPrice;
                              $ModificationPrice = DB::table('draft_product')
                              ->selectRaw('SUM(item_modification.modification_price * draft_product.quantity) AS total_modification_price')
                              ->where('draft_product.draft_product_id', $data->draft_product_id)
                              ->join('draft_product_modification', 'draft_product.draft_product_id', '=', 'draft_product_modification.draft_product_id')
                              ->join('item_modification', function ($join) {
                              $join->on('draft_product_modification.modification_id', '=', 'item_modification.modification_id')
                              ->on('draft_product.product_id', '=', 'item_modification.product_id');
                              })->value('total_modification_price');

                              $totalModificationPrice = $totalModificationPrice + $ModificationPrice;
                              $AccessoriesPrice = DB::table('draft_product')
                              ->selectRaw('SUM(item_accessories.accessories_price * draft_product.quantity) AS total_accessories_price')
                              ->where('draft_product.draft_product_id', $data->draft_product_id)
                              ->join('draft_product_accessories', 'draft_product.draft_product_id', '=', 'draft_product_accessories.draft_product_id')
                              ->join('item_accessories', function ($join) {
                              $join->on('draft_product_accessories.accessories_id', '=', 'item_accessories.accessories_id')
                              ->on('draft_product.product_id', '=', 'item_accessories.product_id');
                              })->value('total_accessories_price');
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
                           
                           <td style="width:70px">{{$product_index}}</td>
                              <td style="width: 14%;">
                                 <div class="input-group">
                                    <input type="button" value="-" class="button-minus quantity-minus" data-draft-product-id="{{$data->draft_product_id}}" data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}" data-field="quantity">
                                    <input type="number" step="1" max="" value="{{$data->quantity}}" name="quantity" data-draft-product-id="{{$data->draft_product_id}}" class="quantity-field quantity-num" data-product-quantity ="{{$data->quantity}}" data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">
                                    <input type="button" value="+" class="button-plus quantity-plus"  data-draft-product-id="{{$data->draft_product_id}}"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}"  data-field="quantity">
                                 </div>
                              </td>
                              <td >{{$data->product_item_sku}}</td>
                              <td style="width: 10%;">
                                 @if(!empty($data->selected_cut_depth) && $data->is_cut_depth == "Yes")
                                 {{$data->selected_cut_depth}}"
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
                                          <li class="hinge_li @if($data->hinge_side === 'L') active @endif " data-hinge="L" data-draft-product-id="{{$data->draft_product_id}}" data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">L</li>
                                          <li class="hinge_li @if($data->hinge_side === 'R') active @endif"  data-hinge="R" data-draft-product-id="{{$data->draft_product_id}}" data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">R</li>
                                          @if($data->hinge_side_none  === 'Yes')
                                          <li  class="hinge_li @if($data->hinge_side === 'None') active @endif" style="width: 47px;" data-hinge="None" data-draft-product-id="{{$data->draft_product_id}}" data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">None</li>
                                          @endif
                                       </div>
                                    </div>
                                 </div>
                                 @else
                                    <center>N/A</center>
                                 @endif
                              </td>
                              <td class="text-center" style="width: 20%;">
                                 @if($data->is_finish_side == "Yes") 
                                 <div class="size-block">
                                    <div class="collapse show" id="size" >
                                       <div class="filter-size" id="filter-size-1">
                                          <ul>
                                             <li class="finish_li @if($data->finish_side === 'L') active @endif"  data-finish="L" data-draft-product-id="{{$data->draft_product_id}}"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">L</li>
                                             <li class="finish_li @if($data->finish_side === 'R') active @endif"  data-finish="R"  data-draft-product-id="{{$data->draft_product_id}}"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}">R</li>
                                             <li class="finish_li @if($data->finish_side === 'B') active @endif"  data-finish="B" data-draft-product-id="{{$data->draft_product_id}}"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}" style="width: 39px;">Both</li>
                                             @if($data->finish_side_none  === 'Yes')
                                             <li class="finish_li @if($data->finish_side === 'None') active @endif"  data-finish="None" data-draft-product-id="{{$data->draft_product_id}}"  data-product-id="{{$data->product_id}}" data-draft-style-id="{{$data->draft_style_id}}" style="width: 47px;">None</li>
                                             @endif
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                                 @else
                                    <center>N/A</center>
                                 @endif
                              </td>
                              <td>
                                 <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <!-- <a href="#" class="btn btn-outline-secondary"><i class="icofont-ui-settings text-success"></i></a> -->
                                    <a href="javascript:void(0)" onclick="deleteModal('{{$data->draft_product_id}}');" class="btn btn-outline-secondary"><i class="icofont-trash text-danger"></i></a>
                                 </div>
                              </td>
                           </tr>
                           
                           @php 
                             $product_index++;
                              $sub_total = $sub_total +$price;
                              $sub_total = $sub_total + $ModificationPrice +$AccessoriesPrice +$DoorPrice;
                              $door_style_total = $price + $ModificationPrice +$AccessoriesPrice +$DoorPrice;
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
    @endforeach
@else
    <div class="alert alert-info">
        No products found in this draft
    </div>
@endif



             </div>
             @php
                $used_coupon = DB::table('used_coupon_history')->leftJoin('coupon_master', 'coupon_master.coupon_id', '=', 'used_coupon_history.coupon_id')->select('coupon_master.coupon_name', 'coupon_master.discount_type', 'coupon_master.expiry_date', 'used_coupon_history.*')->where('draft_id', $customer_draft_Id)->get();

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
                                <th>Action</th>
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
                                 <td>
                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                       <!-- <a href="#" class="btn btn-outline-secondary"><i class="icofont-ui-settings text-success"></i></a> -->
                                       <a href="javascript:void(0)" onclick="CouponDeleteModal('{{$used_coupon->coupon_history_id}}');" class="btn btn-outline-secondary"><i class="icofont-trash text-danger"></i></a>
                                    </div>
                                 </td>
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
                   <!-- ---------------------- form-------------------------------------------- -->
                   <div class="card mb-3"  style="display:none" id="draft-form-div">
                      <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                         <h6 class="m-0 fw-bold">Basic Information <span class="text-danger">*</span></h6>
                      </div>
                      <div class="card-body">
                         <form action="{{url('customer-draft/store')}}" method="POST" id="draft-form" enctype="multipart/form-data">
                            @csrf 
                         <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                  <label class="form-label">Showroom</label>
                                  <input type="text" class="form-control" name="showroom"  value="{{$customerDraft->showroom}}"id="showroom" placeholder="please enter showroom">
                                  <span class="text-danger kt-form__help error showroom"></span>
                                  <span id="showroom_error" class="error text-danger"></span><br>
                               </div>

                               <div class="col-md-4">
    <label class="form-label">Discount (%)</label>
    @php
        // Default values when CustomerGroup is not available
        $groupTitle = 'None';
        $discountPercent = '';
        
        if (isset($CustomerGroup) && $CustomerGroup) {
            $groupTitle = $CustomerGroup->group_title ?? 'None';
            $discountPercent = $CustomerGroup->group_dicount_percent ?? '';
        }
    @endphp
    
    <!-- Disabled discount input -->
    <input type="text" class="form-control" 
           value="{{ $groupTitle }}" 
           placeholder="please enter discount" 
           disabled>
           
    <span class="text-danger kt-form__help error discount"></span>
    
    <!-- Hidden input for discount percent -->
    <input type="hidden" name="discount" value="{{ $discountPercent }}">
</div>
                               <div class="col-md-4">
                                  <label class="form-label">Client Name</label>
                                  <input type="text" class="form-control" name="client_name" id="client_name" value="{{$customerDraft->client_name}}" placeholder="please enter client name">
                                  <span class="text-danger kt-form__help error client_name"></span>
                                  <span id="client_name_error" class="error text-danger"></span><br>
                               </div>
                               <div class="col-md-4">
                                  <label class="form-label">Client Email</label>
                                  <input type="text" class="form-control" name="client_email" id="client_email" value="{{$customerDraft->client_email}}" placeholder="please enter client email">
                                  <span class="text-danger kt-form__help error client_email"></span>
                                  <span id="client_email_error" class="error text-danger"></span><br>
                               </div>
                         </div>
                            <div class="  bg-transparent border-bottom-0" style="margin-top: 40px;margin-bottom: 20px;">
                               <h6 class="m-0 fw-bold">Billing Information <span class="text-danger">*</span></h6>
                            </div>
                            <div class="row g-3 align-items-center">
                            <div class="col-md-8">
                                  <label class="form-label">Address</label>
                                  <input type="text" class="form-control" name="address" value="{{$customerDraft->address}}" id="address" placeholder="please enter address">
                                  <span class="text-danger kt-form__help error address"></span>
                                  <span id="address_error" class="error text-danger"></span><br>
                            </div>
                            <div class="col-md-4">
                                  <label class="form-label">Contact No</label>
                                  <input type="text" class="form-control" name="contact_no" value="{{$customerDraft->contact_no}}" id="contact_no" placeholder="please enter contact">
                                  <span class="text-danger kt-form__help error contact_no"></span>
                                  <span id="contact_no_error" class="error text-danger"></span><br>
                            </div>
                            <!-- state add here -->

                            <div class="col-md-4">
                                <label class="form-label">State</label>
                                <select class="form-control" name="ship_state" id="ship_state">
    <option value="">Please Select</option>
    @if(isset($state) && count($state))
        @foreach($state as $val)
            <option value="{{ $val->state_id }}">{{ $val->state_name }}</option>
        @endforeach
    @endif
</select>

                                <span class="text-danger kt-form__help error ship_state"></span>
                                <span id="ship_state_error" class="error text-danger"></span><br>
                          </div>

                            <div class="col-md-4">
                                  <label class="form-label">City</label>
                                  <input type="text" class="form-control" name="city" id="city"  value="{{$customerDraft->city}}"placeholder="please enter city">
                                  <span class="text-danger kt-form__help error city"></span>
                                  <span id="city_error" class="error text-danger"></span><br>
                            </div>

                            <div class="col-md-4">
                                  <label class="form-label">Zip Code</label>
                                  <input type="text" class="form-control" name="zip_code" id="zip_code" value="{{$customerDraft->zip_code}}" placeholder="please eneter zip code">
                                  <span class="text-danger kt-form__help error zip_code"></span>
                                  <span id="zip_code_error" class="error text-danger"></span><br>
                            </div>
                            <div class="  bg-transparent border-bottom-0" style="margin-top: 40px;margin-bottom: 20px;">
                               <h6 class="m-0 fw-bold">Shipping Information <span class="text-danger">*</span></h6>
                            </div>
                            <div class="col-md-4">
                                  <label class="form-label">Name</label>
                                  <input type="text" class="form-control" name="ship_name" id="ship_name" value="{{$customerDraft->ship_name}}" placeholder="please enter contact">
                                  <span class="text-danger kt-form__help error ship_name"></span>
                                  <span id="ship_name_error" class="error text-danger"></span><br>
                            </div>
                            <div class="col-md-4">
                                  <label class="form-label">Email</label>
                                  <input type="text" class="form-control" name="ship_email" id="ship_email" value="{{$customerDraft->ship_email}}" placeholder="please enter contact">
                                  <span class="text-danger kt-form__help error ship_email"></span>
                                  <span id="ship_email_error" class="error text-danger"></span><br>
                            </div>
                            <div class="col-md-4">
                                  <label class="form-label">Contact No</label>
                                  <input type="text" class="form-control" name="ship_contact_no" id="ship_contact_no" value="{{$customerDraft->ship_contact_no}}" placeholder="please enter contact">
                                  <span class="text-danger kt-form__help error ship_contact_no"></span>
                                  <span id="ship_contact_no_error" class="error text-danger"></span><br>
                            </div>
                            <div class="col-md-8">
                                  <label class="form-label">Address</label>
                                  <input type="text" class="form-control" name="ship_address"  id="ship_address" value="{{$customerDraft->ship_address}}" placeholder="please enter address">
                                  <span class="text-danger kt-form__help error ship_address"></span>
                                  <span id="ship_address_error" class="error text-danger"></span><br>
                            </div>
                       <!-- state add here -->

                       <div class="col-md-4">
                                <label class="form-label">State</label>
                                <select class="form-control" name="ship_state" id="ship_state">
    <option value="">Please Select</option>
    @if(isset($state) && count($state))
        @foreach($state as $val)
            <option value="{{ $val->state_id }}">{{ $val->state_name }}</option>
        @endforeach
    @endif
</select>

                                <span class="text-danger kt-form__help error ship_state"></span>
                                <span id="ship_state_error" class="error text-danger"></span><br>
                          </div>

                            <div class="col-md-4">
                                  <label class="form-label">City</label>
                                  <input type="text" class="form-control" name="ship_city" id="ship_city" value="{{$customerDraft->ship_city}}" placeholder="please enter city">
                                  <span class="text-danger kt-form__help error ship_city"></span>
                                  <span id="ship_city_error" class="error text-danger"></span><br>
                            </div>

                            <div class="col-md-4">
                                  <label class="form-label">Zip Code</label>
                                  <input type="text" class="form-control" name="ship_zip_code" id="ship_zip_code" value="{{$customerDraft->ship_zip_code}}" placeholder="please eneter zip code">
                                  <span class="text-danger kt-form__help error ship_zip_code"></span>
                                  <span id="ship_zip_code_error" class="error text-danger"></span><br>
                            </div>

                         </div><br>
                         <br>
                         <div class="col-md-4">
                            <label class="form-label">Upload Pro Kitchen (Optional)</label>
                            <input type="file" class="form-control" name="pro_kitchen_pdf" id="pro_kitchen_pdf" onClick="proPdfClicked()">
                            <p style="margin-top: 10px; text-align: center;">(PDF/Excel File)</p>
                            <span class="text-danger" id="pro_kitchen_pdf_error"></span>
                         </div>
                         </form>
                      </div>
                   </div>

                   <!-- ---------------------------------- form end----------------------------------------------------- -->
                   <div class="checkout-coupon-total checkout-coupon-total-2 d-flex flex-wrap mt-2">
                      <div class="checkout-coupon">
                         <div class="row ">
                            <div class="col-3">
                               <label class="form-label" >Service Type </label><br>
                               <a href="#" class="btn btn-secondary w-sm-100">{{$customerDraft->service_type}}</a>
                            </div>

                            <!-- <div class="col-5">

                            <form class="coupon-form" method="Post" id="coupon-form" action="{{url('use-coupon')}}\{{$customer_draft_Id}}" onsubmit="event.preventDefault(); submitForm();" >
                               @csrf
                               <input type="text" class="coupon-input" name="coupon_code"placeholder="Coupon Code (optional)" required>
                               <input type="hidden" name="subtotal" value="{{$sub_total}}">
                               <input type="hidden" id="hiddenInput" name="total_price">
                               <button type="submit" class="coupon-button  btn-secondary" id="coupon_submit">Apply Coupon</button>
                            </form>
                            </div> -->



                              <div class="col-5">

                           <form class="coupon-form" method="Post" id="coupon-form" action="{{url('use-coupon')}}\{{$customer_draft_Id}}" onsubmit="event.preventDefault(); submitForm();" >
                              @csrf
                              <input type="text" class="coupon-input" name="coupon_code"placeholder="Coupon Code (optional)" required>
                              <input type="hidden" name="subtotal" value="{{$sub_total}}">
                              <input type="hidden" id="hiddenInput" name="total_price">
                              <button type="submit" class="coupon-button  btn-secondary" id="coupon_submit">Apply Coupon</button>
                           </form>
                           </div>
                           <div class="col-10">
                               <div class="row">
                                  <div class="col-md-6">
                                     <label class="form-label">PO Number</label>
                                     <input type="text" class="form-control" value="{{$customerDraft->po_number}}" id="po_number" data-customer-draft-id="{{$customer_draft_Id}}" name="po_number" placeholder="please enter PO number" >
                                     <span class="text-danger kt-form__help error po_number"></span>
                                  </div>
                                  <div class="col-md-6">
                                     <label class="form-label">Designer</label>
                                     <input type="text" class="form-control" name="designer" id="designer"  value="{{$customerDraft->designer}}"data-customer-draft-id="{{$customer_draft_Id}}"   placeholder="please enter designer" >
                                     <span class="text-danger kt-form__help error designer"></span>

                                  </div>
                               </div>
                           <label class="form-label" style="margin-top:30px;"> Note</label>
                           <textarea class="form-control" rows="3" id="customer_note" data-customer-draft-id="{{$customer_draft_Id}}"  name="customer_note" placeholder="Please enter  note" style="resize: none;">{{$customerDraft->customer_note}}</textarea>
                           <span class="text-danger kt-form__help error customer_note"></span>
                           <span id="customer_note_error" style="color:red; display:none;">Note cannot exceed 300 characters.</span>

                           </div>
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
                            @if($totalAccessoriesPrice != 0)
                                <p class="value">Accessories Price:</p>
                                <p class="price" id="">${{$totalAccessoriesPrice}}</p>
                            @endif
                         </div>
                         <div class="single-total" style="display:none">
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
                         <div class="single-total">
                            @if($hinge_value != 0)
                                <p class="value">Hinge Side:</p>
                                <p class="price" id="">${{$hinge_value}}</p>
                            @endif
                         </div>
                         <div class="single-total">
                            @if($finish_value != 0)
                                <p class="value">Finish Side:</p>
                                <p class="price" id="">${{$finish_value}}</p>
                            @endif
                         </div>
                         <div class="single-total">
                            <p class="value">Item Price : </p>
                            <p class="price" id="item_price" >${{ number_format($ItemtotalPrice, 2, '.', '') }}</p>
                         </div>
                         <div class="single-total">
                            <p class="value">Subtotal</p>
                            <p class="price" id="sub_total">${{ number_format($sub_total, 2, '.', '') }} </p>
                         </div>
                         <div class="single-total">
                            @if($configurationDiscountSum != 0)
                                <p class="value">Unassembled Discount: </p>
                                <p class="price" id="discount">{{$unassembled_discount->unassembled_discount}}% </p>
                            @endif

                         </div>
                         <div class="single-total">
                            @if($customerDraft->discount != "")
                                <p class="value">Total Discount:</p>
                                <p class="price" id="discount">{{$customerDraft->discount}}%</p>
                            @endif
                         </div>

                         <div class="single-total">
                         </div>


                         @php
    $discountedPrice = $sub_total;
    $used_coupon = DB::table('used_coupon_history')
        ->leftJoin('coupon_master', 'coupon_master.coupon_id', '=', 'used_coupon_history.coupon_id')
        ->select('coupon_master.coupon_name', 'coupon_master.discount_type', 'used_coupon_history.*')
        ->where('draft_id', $customer_draft_Id)
        ->get();

    if ($configurationDiscountSum != 0) {
        $discountedPrice -= $configurationDiscountSum;
    }

    $groupDiscount = $discountedPrice * ($customerDraft->discount / 100);
    $discountedPrice -= $groupDiscount;

    // ✅ Add null check for $taxGroup
    if (isset($taxGroup) && $taxGroup->tax_group == "With Tax") {
        if ($customerDraft->service_type == "Self Pickup") {
            $taxGroupDiscount = $discountedPrice * ($taxRate / 100);
        } elseif ($customerDraft->service_type == "Curbside Delivery") {
            $taxGroupDiscount = $discountedPrice * ($customerDraft->zipcode_tax_rate / 100);
        } else {
            $taxGroupDiscount = $discountedPrice * ($customerDraft->zipcode_tax_rate / 100);
        }

        $discountedPrice += ceil($taxGroupDiscount * 100) / 100;
    }

    if ($used_coupon != null) {
        foreach ($used_coupon as $used_coupon) {
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
                                                           if ($used_coupon->discount_type == "Percentage") {
                                            $couponDiscount = $discountedPrice * ($used_coupon->discount / 100);
                                            $discountedPrice -= $couponDiscount;
                                        } else {
                                            $discountedPrice -= $used_coupon->discount;
                                        }
                                    }
                                }

                             @endphp
                       <div class="single-total">
    @if(isset($taxGroup) && $taxGroup->tax_group == "With Tax")
        @if($customer_draft->service_type == "Self Pickup")
            <p class="value">Tax:</p>
            <p class="price" id="discount">{{ $taxRate }}%</p>
        @elseif($customer_draft->service_type == "Curbside Delivery")
            @php
                $taxRate = $customer_draft->zipcode_tax_rate ?? 0;
            @endphp
            <p class="value">Tax:</p>
            <p class="price" id="discount">{{ $taxRate }}%</p>
        @else
            @php
                $taxRate = $customer_draft->zipcode_tax_rate ?? 0;
            @endphp
            <p class="value">Tax:</p>
            <p class="price" id="discount">{{ $taxRate }}%</p>
        @endif
    @endif
</div>

@php $discountedPrice += $shippingCost ?? 0; @endphp
<div class="single-total">
    @if(!empty($shippingCost) && $shippingCost != 0)
        <label class="value">Shipping Cost</label>
        <p class="price">${{ $shippingCost }}</p>
    @endif
</div>

                         <div class="single-total total-payable">
                            <p class="value">Total:</p>
                            <p class="price" id="discountedPrice">${{  ceil($discountedPrice * 100) / 100}}  </p>
                         </div>
                      </div>
                      <input type="hidden" id="total_price"  value="{{ number_format($discountedPrice, 2, '.', '') }}">

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
                                <!-- <div class="single-btn w-sm-100 pcor_cls">
                                   <a href="" class="btn btn-dark w-sm-100 adcr_cls" disabled = true>Place Order </a>
                                </div> -->
                             </div>
                          </div>
                       </div>
                   @else
                       @if($customer->pay_later == "Yes")
                          @php $a = 4;
                            $b = 4;
                        $c = 8; @endphp
                       @else
                          @php $a = 6;
                            $b = 3;
                        $c = 9;@endphp
                       @endif
                       <div class="col-md-12">
                          <div class="row">
                             <div class="col-md-{{$c}}">
                             </div>
                             <div class="row col-md-{{$b}}">
                                <!-- <div class="col-3">
                                   <div class="single-btn w-sm-100 svbt_cls">
                                      <a href="#" class="btn btn-dark w-sm-100 adcr_cls" id="savestayButton" data-custom-value="{{$customer_draft_Id}}">Save & Stay</a>
                                   </div>
                                   </div> -->
                                <div class="col-{{$a}}">
                                   <div class="single-btn w-sm-100 pcor_cls">
                                      <a href="#" class="btn btn-dark w-sm-100 adcr_cls" id="saveButton" data-action="save" data-custom-value="{{$customer_draft_Id}}">Save</a>
                                   </div>
                                </div>
                                <!-- <div class="col-4">
                                   <div class="single-btn w-sm-100 pcor_cls">
                                   @if($discountedPrice <= 0.5)
                                      <a href="#" class="btn btn-dark w-sm-100 adcr_cls disabled"  style="margin-left:10px;"id="quickbooks" data-action="quickbooks" data-custom-value="{{$customer_draft_Id}}">QuickBooks</a>
                                   @else
                                   <a href="#" class="btn btn-dark w-sm-100 adcr_cls "  style="margin-left:10px;"id="quickbooks" data-action="quickbooks" data-custom-value="{{$customer_draft_Id}}">QuickBooks</a>
                                   @endif   
                                   </div>
                                </div> -->

                                <div class="col-{{$a}}">
                                   <div class="single-btn w-sm-100 pcor_cls">
                                   @if($discountedPrice <= 0.5)
                                      <a href="#" class="btn btn-dark w-sm-100 adcr_cls disabled" id="placeOrderButton" data-action="order" data-custom-value="{{$customer_draft_Id}}"  >Place Order</a>
                                   @else
                                      <a href="#" class="btn btn-dark w-sm-100 adcr_cls "  id="placeOrderButton" data-action="order" data-custom-value="{{$customer_draft_Id}}"  >Place Order</a>
                                   @endif   
                                   </div>
                                </div>
                                @if($customer->pay_later == "Yes")
                                    <div class="col-{{$a}}">
                                       <div class="single-btn w-sm-100 pcor_cls">
                                       @if($discountedPrice <= 0.5)
                                          <a href="#" class="btn btn-dark w-sm-100 adcr_cls disabled"  style="margin-left:10px;"id="pay_later" data-action="pay_later" data-custom-value="{{$customer_draft_Id}}">Pay Later</a>
                                       @else
                                           <a href="#" class="btn btn-dark w-sm-100 adcr_cls "  style="margin-left:10px;"id="pay_later" data-action="pay_later" data-custom-value="{{$customer_draft_Id}}">Pay Later</a>
                                       @endif   
                                       </div>
                                    </div>
                                @endif
                             </div>
                          </div>
                       </div>
                   @endif
                </div>
             </div>
             <div id="popup" class="popup">
      <!-- Message will be added dynamically through JavaScript -->
    </div>
             <div id="alertBox" class="alert-box">
                         <span id="alertMessage" class="alert-message"></span>
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
    <div class="modal fade" id="CouponModalLive" tabindex="-1">
       <div class="modal-dialog">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="CouponModalLiveLabel">Coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                <p>Are you sure you want to delete this Record ?</p>
             </div>
             <div class="modal-footer">
                <button type="button"  class="btn btn-warning" id="coupon_yes">Yes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
             </div>
          </div>
       </div>
    </div>
@endsection
@push('custom_styles')
    <style>

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
       border: 1px solid #000000;
       padding: 2px;
       }
       .adcr_cls
       {
       width: 115px;
       }
       /* .svbt_cls
       {
       padding: 14px 0px 0px 42px;
       } */
       .pcor_cls
       {
       padding-top: 14px;
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
       .custom-add-button {
       padding: 3px 6px;
       font-size: 14px;
       color:orange ;
       background-color: white;
       border-radius: 5px;
       cursor: pointer;
       }

       .popup {
      display: none;
      position: fixed;
      bottom: 50%;
      left: 50%;
      transform: translateX(-50%);
      background-color: rgba(0, 0, 0, 0.8);
      color: #fff;
      padding: 10px 20px;
      border-radius: 5px;
      z-index: 9999;
    }

    .popup.show {
      display: block;
      /* animation: slideIn 2s ease; */
    }

    @keyframes slideIn {
      from {
        transform: translateY(100%);
      }
      to {
        transform: translateY(0);
      }
    }
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
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js"></script>
    <script type="text/javascript" src=" https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
@endpush
@push('custom_scripts')
    <script>
       let editorInstance;

    ClassicEditor
        .create(document.querySelector('#customer_note'), {
            // Additional configuration
        })
        .then(editor => {
            editorInstance = editor;

            // Handle content change within the editor
            editor.model.document.on('change:data', () => {
                console.log("Content changed");

                var customer_draft_id = $('#customer_note').data("customer-draft-id");
                let note = editor.getData(); // Get content from the editor

                console.log(customer_draft_id);

                $.ajax({
                    url: "/customer_note_update", 
                    type: "GET", 
                    data: {
                        customer_draft_id: customer_draft_id,
                        note: note
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        // Handle errors if needed
                    },
                });
            });

            // Optional: Set the editor size
          //   editor.ui.view.editable.element.style.width = '100%';
          //   editor.ui.view.editable.element.style.height = '250px';
        })
        .catch(error => {
            console.error(error);
        });

       //  $(document).on("change", "#customer_note", function (event) {
       //    console.log("keyup");

       //      var customer_draft_id = $(this).data("customer-draft-id");
       //      let note = $(this).val();
       //      console.log(customer_draft_id);
       //      $.ajax({
       //          url: "/customer_note_update", 
       //          type: "GET", 
       //          data: {
       //             customer_draft_id: customer_draft_id,
       //             note :note
       //          },
       //          success: function (response) {
       //               console.log(response);
       //          },
       //          error: function (error) {
       //              // Handle errors if needed
       //          },
       //      });
       // });
       //  ClassicEditor
       //      .create(document.querySelector('#customer_note'), {
       //          // Additional configuration can be added here
       //          editor: {
       //              toolbar: {
       //                  // Custom toolbar options
       //              }
       //          }
       //      })
       //      .then(editor => {
       //          editor.ui.view.editable.element.style.width = '100%';
       //          editor.ui.view.editable.element.style.height = '250px';
       //      })
       //      .catch(error => {
       //          console.error(error);
       //      });
    </script>
    <script>
            function submitForm() {
                var total_price = document.getElementById('total_price').value;
                document.getElementById('hiddenInput').value = total_price;
                document.getElementById('coupon-form').submit();
            }
        </script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script> -->
    <script type="text/javascript"></script>
    <script>
       function showPopup(message) {
      popup.textContent = message;
      popup.classList.add('show');
      setTimeout(() => {
        popup.classList.remove('show');
      }, 2000);
    }
       function showAlert(message) {
              var alertBox = document.getElementById("alertBox");
              var alertMessage = document.getElementById("alertMessage");

              alertMessage.textContent = message;
              console.log(alertMessage);
              alertBox.classList.add("show");

              setTimeout(function() {
                  alertBox.classList.remove("show");
              }, 2000);
          }
       // $(document).ready(function () {
       //    // $("#savestayButton").click(function (event) {
       //    //      var customerDraftId =$("#savestayButton").data("custom-value");
       //    //      var discountedPrice =  parseFloat($('#discountedPrice').html().replace('$', ''));
       //    //      var subTotal =  parseFloat($('#sub_total').html().replace('$', '')); 

       //    //      var url = "{{ url('save-stay-draft') }}/save/" + customerDraftId + "/" + discountedPrice + "/" + subTotal;
       //    //      window.location.href = url;

       //    //      console.log("Custom Value:", customerDraftId);
       //    //  });
       //    $("#saveButton").click(function (event) {
       //         var customerDraftId =$("#saveButton").data("custom-value");
       //         var discountedPrice =  parseFloat($('#discountedPrice').html().replace('$', ''));
       //         var subTotal =  parseFloat($('#sub_total').html().replace('$', '')); 

       //         var url = "{{ url('save-draft') }}/save/" + customerDraftId + "/" + discountedPrice + "/" + subTotal;
       //         window.location.href = url;

       //         console.log("Custom Value:", customerDraftId);
       //     });
       //     $("#quickbooks").click(function (event) {
       //         var customerDraftId =$("#quickbooks").data("custom-value");
       //         var discountedPrice =  parseFloat($('#discountedPrice').html().replace('$', ''));
       //         var subTotal =  parseFloat($('#sub_total').html().replace('$', '')); 

       //         var url = "{{ url('save-draft') }}/quickbooks/" + customerDraftId + "/" + discountedPrice + "/" + subTotal;
       //         window.location.href = url;

       //         console.log("Custom Value:", customerDraftId);
       //     });
       //     $("#placeOrderButton").click(function (event) {
       //         var customerDraftId =$("#placeOrderButton").data("custom-value");
       //         var discountedPrice =  parseFloat($('#discountedPrice').html().replace('$', ''));
       //         var subTotal =  parseFloat($('#sub_total').html().replace('$', '')); 

       //         var url = "{{ url('save-draft') }}/order/" + customerDraftId + "/" + discountedPrice + "/" + subTotal;
       //         window.location.href = url;

       //         console.log("Custom Value:", customerDraftId);
       //     });

       // });
    //    function isValidField(value, rule, field) {
    //     switch (rule) {
    //         case 'required':
    //             if (value === '') {
    //                 $('#' + field + '_error').html("This field is required.");
    //                 return false;
    //             }
    //             break;
    //         case 'email':
    //             // Email validation logic
    //             break;
    //         case 'regex':
    //             // Regular expression validation logic
    //             break;
    //         // Add other validation rules as needed
    //     }
    //     // Clear error message if field is valid
    //     $('#' + field + '_error').html("");
    //     return true;
    // }

    // function validateForm() {
    //     var isValid = true;

    //     // Validation rules
    //     var rules = {
    //         showroom: 'required',
    //         designer: 'required',
    //         client_name: 'required',
    //         client_email: ['required', 'email', 'regex:/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/'],
    //         address: 'required',
    //         contact_no: ['required', 'digits:10', 'regex:/^([0-9]*)$/'],
    //         city: 'required',
    //         state: 'required',
    //         zip_code: 'required',
    //         ship_name: 'required',
    //         ship_email: ['required', 'email', 'regex:/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/'],
    //         ship_contact_no: ['required', 'digits:10', 'regex:/^([0-9]*)$/'],
    //         ship_address: 'required',
    //         ship_state: 'required',
    //         ship_city: 'required',
    //         ship_zip_code: 'required'
    //     };

    //     // Validate each field
    //     $.each(rules, function(field, rule) {
    //         var value = $("#" + field).val().trim();
    //         if (Array.isArray(rule)) {
    //             $.each(rule, function(index, subrule) {
    //                 if (!isValidField(value, subrule, field)) {
    //                     isValid = false;
    //                 }
    //             });
    //         } else {
    //             if (!isValidField(value, rule, field)) {
    //                 isValid = false;
    //             }
    //         }
    //       //   alert(isValid);
    //     });
    //     alert(isValid);
    //     return isValid;
    // }

     $(document).ready(function() {
       $("#refreshButton").click(function(event) {


                var customerDraftId = $(this).data("custom-value");
                var discountedPrice = parseFloat($('#discountedPrice').html().replace('$', ''));
                var subTotal = parseFloat($('#sub_total').html().replace('$', ''));
                var action = $(this).data("action");

                var url = "{{ url('save-draft') }}/save/" + customerDraftId + "/" + discountedPrice + "/" + subTotal;
                $.ajax({
                url :url,
                //url: "/add-hinge",
                type: "GET",

                success: function (response) {
                      console.log(response);

                          window.location.reload();

                },
                error: function (error) {
                      // Handle errors if needed
                },
             });

        });
       $("#saveButton, #quickbooks, #placeOrderButton, #pay_later").click(function(event) {
            // Prevent default form submission
            //event.preventDefault();

            // Show the form
            //$('#draft-form-div').show();

            // Validate the form
            //if (validateForm()) {
                // Prepare data
                var customerDraftId = $(this).data("custom-value");
                var discountedPrice = parseFloat($('#discountedPrice').html().replace('$', ''));
                var subTotal = parseFloat($('#sub_total').html().replace('$', ''));
                var action = $(this).data("action");
                if(action == "save"){
                   var url = "{{ url('save-draft') }}/save/" + customerDraftId + "/" + discountedPrice + "/" + subTotal;
                   window.location.href = url;
                   console.log("Custom Value:", customerDraftId);
                }else{
                   var encryptedData = btoa(JSON.stringify({
                    action: action,
                    customerDraftId: customerDraftId,
                    discountedPrice: discountedPrice,
                    subTotal: subTotal
                }));

                // Redirect to the checkout form page with encrypted data
                window.location.href = "{{ route('checkout_form') }}?data=" + encodeURIComponent(encryptedData);



                // var data = {
                //     action: action,
                //     customerDraftId: customerDraftId,
                //     discountedPrice: discountedPrice,
                //     subTotal: subTotal,
                //     _token: '{{ csrf_token() }}'
                // };
                // console.log(data);

                // // Send data via AJAX POST request
                // $.ajax({
                //     type: "Get",
                //     url: "{{ url('checkout-form') }}",
                //     data: data,
                //     success: function(response) {
                //       alert(response);
                //         // Handle success response
                //         window.location.href = "{{ route('checkout_form') }}";
                //         //window.location.href = response.url;
                //     },
                //     error: function(xhr, status, error) {
                //         // Handle error
                //         console.error(xhr.responseText);
                //     }
                // });
             }
            //}
        });
    //     $("#saveButton, #quickbooks, #placeOrderButton").click(function(event) {
    //         // Show the form
    //         $('#draft-form-div').show();
    //         // Validate the form
    //         if (validateForm()) {
    //             // Proceed with the action
    //             var customerDraftId = $(this).data("custom-value");
    //             var discountedPrice = parseFloat($('#discountedPrice').html().replace('$', ''));
    //             var subTotal = parseFloat($('#sub_total').html().replace('$', ''));
    //             var action = $(this).attr("id");
    //             var url = "{{ url('save-draft') }}/" + action + "/" + customerDraftId + "/" + discountedPrice + "/" + subTotal;
    //             window.location.href = url;
    //         }
    //     });
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
        $(document).on("change", "#po_number", function (event) {
          console.log("keyup");

            var customer_draft_id = $(this).data("customer-draft-id");
            let po_number = $(this).val();
            console.log(customer_draft_id);
            $.ajax({
                url: "/po_number_update", 
                type: "GET", 
                data: {
                   customer_draft_id: customer_draft_id,
                   po_number :po_number
                },
                success: function (response) {
                     console.log(response);
                },
                error: function (error) {
                    // Handle errors if needed
                },
            });
       });
       $(document).on("change", "#designer", function (event) {
          console.log("keyup");

            var customer_draft_id = $(this).data("customer-draft-id");
            let designer = $(this).val();
            console.log(customer_draft_id);
            $.ajax({
                url: "/designer_update", 
                type: "GET", 
                data: {
                   customer_draft_id: customer_draft_id,
                   designer :designer
                },
                success: function (response) {
                     console.log(response);
                },
                error: function (error) {
                    // Handle errors if needed
                },
            });
       });

       $(document).on("change", ".quantity-num", function (event) {
          console.log("keyup");
          var inputElement = $(this);
        var newQuantity = parseInt(inputElement.val()); // Parse the entered quantity to an integer

        if (isNaN(newQuantity)) {
            inputElement.val(inputElement.data("product-quantity"));
            return;
        }
            var productId = $(this).data("product-id");
            var draftProductId = $(this).data("draft-product-id");
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
                    new_quantity: newQuantity ,// Send the new quantity to the server
                    draft_product_id:draftProductId

                },
                success: function (response) {
                     console.log(response);
                   //  // Handle success response here, if needed
                   //  location.reload();
                   q.val(response.quantity);
                      $('#totalModificationPrice').html('$'+response.totalModificationPrice)
                       $('#sub_total').html('$' + response.sub_total.toFixed(2))
                       $('#item_price').html('$' + response.item_price.toFixed(2))
                      //  $('#discount').html(response.discount+'%')
                       $('#discountedPrice').html('$' + response.discountedPrice.toFixed(2))
                       if( response.discountedPrice.toFixed(2) <= 0.5){
                         $('#placeOrderButton').addClass('disabled');
                         $('#quickbooks').addClass('disabled');
                         $('#pay_later').addClass('disabled');
                       }else{
                         $('#placeOrderButton').removeClass('disabled');
                         $('#quickbooks').removeClass('disabled');
                         $('#pay_later').removeClass('disabled');
                       }
                        var obj = JSON.parse(JSON.stringify(response));

                     if(obj.message !=""){
                        showPopup(obj.message);
                     }{
                   //   window.location.reload();
                     }
                },
                error: function (error) {
                    // Handle errors if needed
                },
            });
       });
       $(document).on("click", ".quantity-plus", function () {
             var productId = $(this).data("product-id");
             var draftProductId = $(this).data("draft-product-id");
             var draftStyleId = $(this).data("draft-style-id");
             var q =  $(this).closest(".input-group").find(".quantity-num");

          console.log(draftStyleId);
             $.ajax({
                url: "/quantity-plus",
                type: "GET",
                data: {
                      product_id: productId,
                      draft_style_id:draftStyleId,
                      draft_product_id:draftProductId
                },
                success: function (response) {

                     console.log(response);
                        q.val(response.quantity);
                       $('#totalModificationPrice').html('$'+response.totalModificationPrice)
                       $('#sub_total').html('$' + response.sub_total.toFixed(2))
                       $('#item_price').html('$' + response.item_price.toFixed(2))

                      //  $('#discount').html(response.discount+'%')
                       $('#discountedPrice').html('$' + response.discountedPrice.toFixed(2))
                       if( response.discountedPrice.toFixed(2) <= 0.5){
                         $('#placeOrderButton').addClass('disabled');
                         $('#quickbooks').addClass('disabled');
                         $('#pay_later').addClass('disabled');
                       }else{
                         $('#placeOrderButton').removeClass('disabled');
                         $('#quickbooks').removeClass('disabled');
                         $('#pay_later').removeClass('disabled');
                       }
                      $(this).siblings(".quantity").val();
                      console.log("quantity-plus");
                      var obj = JSON.parse(JSON.stringify(response));

                      if(obj.message !=""){
                         showPopup(obj.message);
                      }
                      // location.reload();
                      //  window.location.reload();
                },
                error: function (error) {
                      // Handle errors if needed
                },
             });
          });
       $(document).on("click", ".quantity-minus", function () {
             var productId = $(this).data("product-id");
             var draftProductId = $(this).data("draft-product-id");
             var draftStyleId = $(this).data("draft-style-id");
             var q =  $(this).closest(".input-group").find(".quantity-num");
             if(q.val() !=1){
          console.log(draftStyleId);
             $.ajax({
                url: "/quantity-minus",
                type: "GET",
                data: {
                      product_id: productId,
                      draft_style_id:draftStyleId,
                      draft_product_id:draftProductId
                },
                success: function (response) {
                      console.log(response);
                      q.val(response.quantity);
                      $('#totalModificationPrice').html('$'+response.totalModificationPrice)
                       $('#sub_total').html('$' + response.sub_total.toFixed(2))
                       $('#item_price').html('$' + response.item_price.toFixed(2))
                      //  $('#discount').html(response.discount+'%')
                       $('#discountedPrice').html('$' + response.discountedPrice.toFixed(2))
                       if( response.discountedPrice.toFixed(2) <= 0.5){
                         $('#placeOrderButton').addClass('disabled');
                         $('#quickbooks').addClass('disabled');
                         $('#pay_later').addClass('disabled');
                       }else{
                         $('#placeOrderButton').removeClass('disabled');
                         $('#quickbooks').removeClass('disabled');
                         $('#pay_later').removeClass('disabled');
                       }
                      $(this).siblings(".quantity").val();
                      console.log("quantity-minus");
                      // location.reload();
                      //  window.location.reload();
                },
                error: function (error) {
                      // Handle errors if needed
                },
             });
          }
       });
       $(document).on("click", ".hinge_li", function () {
             var productId = $(this).data("product-id");
             var draftProductId = $(this).data("draft-product-id");
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
                      hinge:hinge,
                      draft_product_id:draftProductId
                },
                success: function (response) {
                      console.log(response);
                      $('#totalModificationPrice').html('$'+response.totalModificationPrice)
                       $('#sub_total').html('$' + response.sub_total.toFixed(2))
                       $('#item_price').html('$' + response.item_price.toFixed(2))
                      //  $('#discount').html(response.discount+'%')
                       $('#discountedPrice').html('$' + response.discountedPrice.toFixed(2))
                       if( response.discountedPrice.toFixed(2) <= 0.5){
                         $('#placeOrderButton').addClass('disabled');
                         $('#quickbooks').addClass('disabled');
                         $('#pay_later').addClass('disabled');
                       }else{
                         $('#placeOrderButton').removeClass('disabled');
                         $('#quickbooks').removeClass('disabled');
                         $('#pay_later').removeClass('disabled');
                       }
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
             var draftProductId = $(this).data("draft-product-id");
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
                      finish:finish,
                      draft_product_id:draftProductId
                },
                success: function (response) {
                      console.log(response);
                      $('#totalModificationPrice').html('$'+response.totalModificationPrice)
                       $('#sub_total').html('$' + response.sub_total.toFixed(2))
                       $('#item_price').html('$' + response.item_price.toFixed(2))
                      //  $('#discount').html(response.discount+'%')
                       $('#discountedPrice').html('$' + response.discountedPrice.toFixed(2))
                       if( response.discountedPrice.toFixed(2) <= 0.5){
                         $('#placeOrderButton').addClass('disabled');
                         $('#quickbooks').addClass('disabled');  
                         $('#pay_later').addClass('disabled');
                       }else{
                         $('#placeOrderButton').removeClass('disabled');
                         $('#quickbooks').removeClass('disabled');
                         $('#pay_later').removeClass('disabled');
                       }
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
        function CouponDeleteModal(id) {

          $("#CouponModalLive").modal('show');

          $('#coupon_yes').on('click', function(event){
              $("#conformation-modal").modal('hide');
              $.ajax({
                  url: "{{ url('remove-coupon/') }}"+'/'+id,
                  type: 'GET',
                  dataType: 'html',
                  success:function(data) {


                   if(data == 0 ){
                      console.log("nooo");
                      location.reload();
                   }else{
                      console.log("okkk");
                     window.location.href = '/add-cart/' + data;

                   }


                  }
              });
          });
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
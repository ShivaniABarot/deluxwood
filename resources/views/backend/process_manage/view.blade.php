@extends(backendView('layouts.app'))
@section('title', 'View Process')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 border-bottom flex-wrap">
            <h3 class="fw-bold mb-0"> View Order - {{$id}}</h3>
            <div class="ms-auto">
            @if( Auth::user()->role_id == 1)
                  <a href="{{url('admin/sticker')}}/{{$id}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i>Print Sticker</a>
                  <a href="{{url('admin/with-price')}}/{{$id}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i>With Price</a>
                  <a href="{{url('admin/without-price')}}/{{$id}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i>Without Price</a>
               @else
                  <a href="{{url('agent/sticker')}}/{{$id}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i>Print Sticker</a>
                  <a href="{{url('agent/with-price')}}/{{$id}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i>With Price</a>
                  <a href="{{url('agent/without-price')}}/{{$id}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i>Without Price</a>
               @endif
           </div>
         </div>
      </div>
   </div>
   <!-- Row end  -->
   <div class="row clearfix g-3">
      <div class="col-lg-12">
         <div class="card mb-3">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
               <h6 class="m-0 fw-bold"></h6>
            </div>
            <div class="card-body">
               <form action="{{url('admin/process-manage/update')}}/{{$id}}" method="POST" id="customergroupForm" enctype="multipart/form-data">
                  @method('PATCH')
                  @csrf
                  <div class="row g-3 align-items-center">
                      <label class="form-label bold" style="margin-top:20px;font-size:18px">Basic Customer Information </label>
                      <div class="col-md-6">
                        <label class="form-label">Customer Name </label>
                        @if ($user)
                        <input type="text" class="form-control" value="{{$user->representative_name}}" readonly name="representative_name" >
                        @else
                           <input type="text" name="representative_name" value="User not found" readonly class="form-control form-control-sm" >
                           <!-- You can customize the message or handle the case where the user is not found -->
                        @endif
                        <span class="text-danger kt-form__help error representative_name"></span>
                     </div>
                     <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">Company Name </label>
                        @if ($user)
                           <input type="text" name="company_name" value="{{ $user->company_name }}" readonly class="form-control form-control-sm" >
                           <span class="text-danger kt-form__help error company_name"></span>
                        @else
                           <input type="text" name="company_name" value="User not found" readonly class="form-control form-control-sm" >
                           <!-- You can customize the message or handle the case where the user is not found -->
                        @endif
                        <span class="text-danger kt-form__help error company_name"></span>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">Contact Number </label>
                           @if ($user)
                           <input type="text" class="form-control" name="contact_number" value="{{$user->contact_number}}" readonly >
                           @else
                           <input type="text" name="contact_number" value="None" readonly class="form-control form-control-sm">
                           @endif
                           <span class="text-danger kt-form__help error contact_number"></span>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label"> Email Address</label>
                           @if ($user)
                           <input type="text" class="form-control" name="email" value="{{$user->email}}" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div>
                    <label class="form-label bold"  style="margin-top:20px;font-size:18px"> Billing Information </label>
                     <div class="col-md-6">
                        <label class="form-label">Name </label>
                        @if ($user)
                        <input type="text" class="form-control" value="{{$user->representative_name}}" readonly name="representative_name" >
                        @else
                           <input type="text" name="representative_name" value="User not found" readonly class="form-control form-control-sm" >
                           <!-- You can customize the message or handle the case where the user is not found -->
                        @endif
                        <span class="text-danger kt-form__help error representative_name"></span>
                     </div>
                    
                     <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">Contact Number </label>
                           @if ($user)
                           <input type="text" class="form-control" name="contact_number" value="{{$customer_draft->contact_no}}" readonly >
                           @else
                           <input type="text" name="contact_number" value="None" readonly class="form-control form-control-sm">
                           @endif
                           <span class="text-danger kt-form__help error contact_number"></span>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">Address</label>
                           @if ($user)
                           <input type="text" class="form-control" name="email" value="{{$customer_draft->address}}" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div>
                       <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">City</label>
                           @if ($user)
                           <input type="text" class="form-control" name="email" value="{{$customer_draft->city}}" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div>
                      <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">State</label>
                           @if ($state)
                           <input type="text" class="form-control" name="email" value="{{$state->state_name}}" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div>
                   
                     <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">Zipcode</label>
                           @if ($user)
                           <input type="text" class="form-control" name="email" value="{{$customer_draft->zip_code}}" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div>
                     <label class="form-label bold"  style="margin-top:20px;font-size:18px"> Shipping Information </label>
                     <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">Contact Number </label>
                           @if ($user)
                           <input type="text" class="form-control" name="contact_number" value="{{$customer_draft->ship_contact_no}}" readonly >
                           @else
                           <input type="text" name="contact_number" value="None" readonly class="form-control form-control-sm">
                           @endif
                           <span class="text-danger kt-form__help error contact_number"></span>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">Address</label>
                           @if ($user)
                           <input type="text" class="form-control" name="email" value="{{$customer_draft->ship_address}}" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div>
                      <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">State</label>
                           @if ($user)
                           <input type="text" class="form-control" name="email" value="@if(isset($ship_state->state_name)){{ $ship_state->state_name }} @endif" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">City</label>
                           @if ($user)
                           <input type="text" class="form-control" name="email" value="{{$customer_draft->ship_city}}" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">Zip Code</label>
                           @if ($user)
                           <input type="text" class="form-control" name="email" value="{{$customer_draft->ship_zip_code}}" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div>
                   
                     <label class="form-label bold"  style="margin-top:20px;font-size:18px"> Order Information </label>
                     <div class="col-4">
                        <div class="mb-2">
                           <label class="form-label">PO Number</label>
                           @if ($user)
                           <input type="text" class="form-control" name="email" value="{{$customer_draft->po_number}}" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="mb-2">
                           <label class="form-label">Service Type</label>
                           @if ($user)
                           <input type="text" class="form-control" name="email" value="{{$customer_draft->service_type}}" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div>
                     <!-- <div class="col-4">
                        <div class="mb-2">
                           <label class="form-label">Configuration</label>
                           @if ($user)
                           <input type="text" class="form-control" name="email" value="{{$customer_draft->configuration}}" readonly >
                           @else
                           <input type="text" class="form-control" name="email" value="None" readonly >
                           @endif
                           <span class="text-danger kt-form__help error email"></span>
                        </div>
                     </div> -->
      
            @php $sub_total = 0; @endphp
             @php $ItemtotalPrice  = 0; @endphp
            @php $totalCutDepthPrice = 0; $totalModificationPrice = 0;  $totalAccessoriesPrice = 0; $hinge_value = 0; $finish_value = 0;@endphp
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
                              ->where('customer_draft_style.customer_draft_Id', '=', $customer_draft->customer_draft_id)
                              ->select('customer_draft_style.draft_style_id','customer_draft_style.configuration')
                              ->first();
                              $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                              echo $doorStyle->name;
                              @endphp
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                           <label class="form-label" >Configuration</label><br>
                           <a href="#" class="btn btn-secondary w-sm-100">{{$draftStyle->configuration}}</a>
                        </div>
               </div>
            </div>
        
         </div>
      </div>
      <div class="table-container" >
               <table class="table table-hover align-middle mb-0" style="width: 100%;">
                  <thead>
                     <tr>
                        <th class="text-center">QTY.</th>
                        <th class="text-center">Sku</th>
                        <!-- <th class="text-center">Item</th> -->
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
                     if($data->cut_depth == "Yes"){
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
                        <td class="text-center">
                          {{$data->quantity}}
                        </td>
                        <td class="text-center">{{$data->product_item_sku}}</td>
                        <!-- <td class="text-center">{{$data->product_name}}</td> -->
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
                           @php
                           $hingeSideMap = [
                           'L' => 'Left',
                           'R' => 'Right',
                           'B' => 'Both',
                           'None' => 'None', // Display 'NONE' as 'NONE'
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
                        <td class="text-center">
                           @if($data->is_finish_side == "Yes")
                  @php
                  $finishSideMap = [
                  'L' => 'Left',
                  'R' => 'Right',
                  'B' => 'Both',
                  'None' => 'None',
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
                     @endforeach
                     @endif
                  </tbody>
               </table>
            </div>
      
            @endforeach 
            @if($customer_draft->customer_note != "")
            <div style="width: 100%;display: inline-block;padding-top: 20px;  font-size: 14px;font-family: 'Open Sans', sans-serif;">
               
               <label class="form-label" > Note</label>
               <table width="100%" height="100%">
                  <tr>
                  <td class="prc_cls" colspan="3" style="padding: 10px; background-color:#e9ecef" > {!! $customer_draft->customer_note !!} </td>
                  </tr>
               </table>
               
            </div>
            @endif






                     <!-- Old Code  -->


                     <!-- <label class="form-label bold"  > Order ID : {{$id}} </label> -->
                 <!--    @foreach($draft_product as $draft_product)
                     @php $product_image = DB::table('product_image')->where('product_id',$draft_product->product_id)->first(); @endphp -->
                     <!-- <div class="col-4">
                        <div class="mb-2">
                          <center>
                           @if($product_image)
                           <img class="userimage" height="180" width="180" src="{{ asset('public/img/product/'.$product_image->image_name) }}" />
                              @else
                              
                                 <p>No image available</p>
                              @endif  
                        </center>
                        </div>
                     </div> -->
                  
                 <!--   <div class="col-8">
                 
                   <div class="col-12">
                        <div class="mb-2">
                           <label class="form-label"> SKU</label>
                           <input type="text" class="form-control" name="SKU" readonly value="{{$draft_product->product_item_sku}}" >
                           <span class="text-danger kt-form__help error SKU"></span>
                        </div>
                     </div>

                     <div class="col-12">
                        <div class="mb-2">
                           <label class="form-label"> Product Name</label>
                           <input type="text" class="form-control" name="product_name" readonly  value="{{$draft_product->product_name}}" >
                           <span class="text-danger kt-form__help error product_name"></span>
                        </div>
                     </div>
                     </div> -->
                     
                        
                  
                  <!-- @endforeach -->
                  @if ($draft_status->draft_status === 'Return')
                      <div class="col-6">
                        <div class="mb-2">
                           <label class="form-label">Item Name<span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="product_item_name" readonly  value=" ">
                           <span class="text-danger kt-form__help error product_item_name"></span>
                        </div>
                     </div>
                      @endif
               
                     @if ($draft_status->draft_status === 'Return')
                         <div class="col-6">
                             <div class="mb-2">
                                 <label class="form-label">Return Approval</label>
                                 <select class="form-control form-select form-select-sm" name="return_approval">
                                     <option value="">Please Select</option>
                                     <option value="Yes" {{ $draft_status->return_approval === 'Yes' ? 'selected' : '' }}>Yes</option>
                                     <option value="No" {{ $draft_status->return_approval === 'No' ? 'selected' : '' }}>No</option>
                                 </select>
                                 <span class="text-danger kt-form__help error return_approval"></span>
                             </div>
                         </div>
                        <div class="col-6">
                           <div class="mb-2">
                              <label class="form-label">Estimated Time</label>
                              <input type="text" class="form-control" name="estimated_time"  value="{{$draft_status->estimated_time}}" autocomplete="off">
                              <span class="text-danger kt-form__help error estimated_time"></span>
                           </div>
                        </div>
                      @endif
                      @if( Auth::user()->role_id != 3)
                        <div class="col-6">
                           <div class="mb-2">
                             <label class="form-label">Update Status <span class="text-danger">*</span></label>
                             <select class="form-control form-select form-select-sm" id="Status" name="Status">
                                 <option value="">Please Select</option>
                                 @foreach($statuses as $dbValue => $displayValue)
                                     @if($dbValue === $draft_status->draft_status)
                                         <option value="{{ $dbValue }}" selected>{{ $displayValue }}</option>
                                     @else
                                         <option value="{{ $dbValue }}">{{ $displayValue }}</option>
                                     @endif
                                 @endforeach
                             </select>
                             <span class="text-danger kt-form__help error Status"></span>
                         </div>
                     </div>
                     @endif
                     
                  </div>
                  @if( Auth::user()->role_id != 3)
                  <button type="submit" class="btn btn-light mt-4 text-uppercase px-5">Update</button>
                  @endif
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- Row End -->
</div>

@endsection
@push('styles')
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
@endpush
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
   border: 1px solid #000000;
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
   border-collapse: collapse;
   border: none;
   width: 100%;
   }
   .tbl th {
   font-size: 10px;
   border-right: 1px solid black;
   }
   .tbl td {
   border-left: none;
   border-right: none;
   }
   .tbl tr:last-child td {
   border-bottom: 1px solid black;
   }
   .tbl td:last-child {
   border-right: 1px solid black;
   }
   .thtd_cls {
   border-top: 1px solid #000000;
   text-align: left;
   padding: 8px;
   font-size: 10px;
   }
   .thtd_cls:first-child {
   border-left: 1px solid black; 
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
   color: #000000;
   padding: 2px 3px 7px 13px;
   font-size: 11px;
   margin-bottom: 0px;
   margin-top: -9px;
   }
   /* .thtd_cls:last-child {
   border-right: 1px solid black; 
   }*/
   tr.tr_cls:nth-child(even) {
   background-color: #e3e3e3;
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
   width: 253px;
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
   /*   padding-bottom: 10px;*/
   padding-top: 27px;
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
   .tablepdf tr th {
   color: var(--text-color);
   text-transform: uppercase;
   font-size: 13px;
   }
   .tablepdf tr td
   {
   font-size: 13px;
   }
   /*  .tablepdf > :not(:first-child) {
   border-top: 1px solid currentColor;
   }
   .tablepdf {
   border-color: var(--border-color);
   }*/
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
   border-right: 1px solid black;
   border-top: 1px solid black;
   /*   border-bottom: 1px solid black;*/
   text-align: center;
   }
   .ppd_cls tr:last-child td {
   border-bottom: 1px solid black;
   }
   .per_cls:first-child {
   border-left: 1px solid black; /* Adding left border to the first column only */
   }
   .plc_cls
   {
   border: 1px solid;
   background-color: #DDDDDD;
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
   .prc_cls
   {
   padding: 0px 0px 0px 13px;
   }
</style>
@endpush
@push('scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/jQuery.tagify.min.js"></script>
@endpush
@push('custom_scripts')
<script>
   $(document).ready(function() {
       $('#door_style_id').select2();
   });
</script>
<script type="text/javascript">
   function generatePDF() {
   var element = document.getElementById('invoice');
   var originalDisplay = element.style.display;
   element.style.display = 'block';
   var opt = {
   margin: [0.2, 0.2, 0.4, 0.2],
   filename: '{{$pdf_data->client_name}}_{{$pdf_data->po_number}}.pdf',
    image: { type: 'jpeg', quality: 0.98 },
   html2canvas: {  scale: 4, dpi: 192, letterRendering: true},
   jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
   
   };
   html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {
   var totalPages = pdf.internal.getNumberOfPages();
   for (i = 1; i <= totalPages; i++) {
     pdf.setPage(i);
     pdf.setFontSize(10);
     pdf.setTextColor(100);
   
     pdf.text('Page ' + i + ' of ' + totalPages, (pdf.internal.pageSize.getWidth() / 2.3), (pdf.internal.pageSize.getHeight() - 0.1)); 
   
   }
   element.style.display = originalDisplay;
   }).save();
   }
</script>
@endpush
@push('modals')
@endpush
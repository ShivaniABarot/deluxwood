@extends(backendView('layouts.app'))
@section('title', 'Process Manage')
@section('content')

<div class="row g-3 mb-3" id="invoice" style="display: block;">
  <div class="col-md-12">
    <div class="card" style="border-color: #FFFFFF;">
        <div class="card-body">
              <div class="d-flex align-items-center justify-content-between flex-wrap">
                <img src="{{asset('public/logo.png')}}" class="lg_cls">
                <h5 class="fw-bold mb-4 dl_cls">
                  Deluxewood Cabinetry<br>
                  <p class="hr_cls">420 Frontage Rd, West Haven,<br> CT 06516, United States<br>deluxewoodcabinetry@gmail.com<br>+1 (475)655-2687<br>+1 (475)655-2693</p>
                </h5>
              </div>
              <div class="col-md-12 pd_cls">
               <div class="row">
                  <div class="col-md-4 bllvr_cls">
                     <p class="title" style="border-bottom: 1px solid #a6a6a4; padding: 3px;font-size: 13px;font-weight: Bold;">Bill To</p>
                     <!-- <h6 style="border-bottom: 1px solid #a6a6a4; padding: 3px;"><b>Bill To</b></h6> -->
                     <!-- <hr> -->
                     <p class="fn_cls" style="margin-top:-2px">{{$pdf_data->representative_name ?? ''}}<br>{{$pdf_data->company_name ?? ''}}<br>{{$pdf_data->customer_address}}<br>{{$pdf_data->customer_no}}<br>{{$pdf_data->email}}</p>
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4 bllvr_cls" style="margin-top:-3px">
                     <p class="title" style="border-bottom: 1px solid #a6a6a4; padding: 3px;font-size: 13px;font-weight: Bold;">Ship To</p>
                     <!-- <h6 style="border-bottom: 1px solid #a6a6a4; padding: 3px;"><b>Ship To</b></h6> -->
                     <!-- <hr> -->
                     <p class="fn_cls" style="margin-top:-2px">{{$pdf_data->client_name}}<br>{{$pdf_data->client_address}}<br>{{$pdf_data->client_no}}</p>
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
               <td class="per_cls" style="font-size:11px;">{{ $pdf_data->created_at->format('d-m-Y') }}</td>
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
            if($sides->hinge_side == "Yes") 
            {
            $hinge_price = DB::table('product_item_hinge_side')->where('product_id', $data->product_id)->first();
            if($data->hinge_side == "L"){
            $price =$price + $hinge_price->left_hinge_side_price;
            }elseif($data->hinge_side == "R"){
            $price =$price + $hinge_price->right_hinge_side_price;
            }elseif($data->hinge_side == "B"){
            $price =$price + $hinge_price->both_hinge_side_price;
            }
            }
            if($sides->finish_side == "Yes") 
            {
            $finish_price = DB::table('product_item_finish_side')->where('product_id', $data->product_id)->first();
            if($data->finish_side == "L"){
            $price =$price + $finish_price->left_finish_side_price;
            }elseif($data->finish_side == "R"){
            $price =$price + $finish_price->right_finish_side_price;
            }elseif($data->finish_side == "B"){
            $price =$price + $finish_price->both_finish_side_price;
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
               <td class="thtd_cls text-center" style="width: 10%;">
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
            @php $sub_total = $sub_total +$price;
            $sub_total = $sub_total + $ModificationPrice +$AccessoriesPrice ;
            @endphp
            @if($sides->hinge_side == "Yes")
            @if($data->hinge_side == "L")
            @php   $hinge_value  =  $hinge_value + $hinge_price->left_hinge_side_price *$data->quantity @endphp
            @endif
            @if($data->hinge_side == "R")
            @php $hinge_value  =  $hinge_value + $hinge_price->right_hinge_side_price *$data->quantity @endphp
            @endif
            @if($data->hinge_side == "B")
            @php  $hinge_value  =  $hinge_value + $hinge_price->both_hinge_side_price * $data->quantity@endphp
            @endif
            @endif
            @if($sides->finish_side == "Yes")
            @if($data->finish_side == "L")
            @php   $finish_value  =  $finish_value + $finish_price->left_finish_side_price * $data->quantity @endphp
            @endif
            @if($data->finish_side == "R")
            @php $finish_value  =  $finish_value + $finish_price->right_finish_side_price *$data->quantity @endphp
            @endif
            @if($data->finish_side == "B")
            @php  $finish_value  =  $finish_value + $finish_price->both_finish_side_price * $data->quantity @endphp
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
                     <p class="thn_cls" style="font-size: 12px;">*The estimated time your order will be ready for pick up is <b> 1 FULL BUSINESS DAY </b>Excluding Holidays Closing Days from the time we receive your signature.
                        <br><br>---Signatures received after 10am will be considered as received on the next business day. Signatures received on Friday's after 9:30am will be considered as received on next business day---
                        <br><br>
                        **FOR DELIVERY, PLEASE CONTACT DELIVERY DEPARTMENT AT #373**
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
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Total (Gross)</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">${{ number_format($sub_total, 2, '.', '') }}
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Discount</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">{{$customer_draft->discount}}%
                                    </h3>
                                 </div>
                              </td>
                           </tr>
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
                           @elseif($customer_draft->configuration == "Assembled")
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Assembled Discount</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">2 %
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           @endif
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">Group Discount</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 11px;font-weight: normal;">
                                    @if($grup_discount)
                                      {{$grup_discount->group_dicount_percent}}%
                                    @else
                                        N/A <!-- or any default value you want to display when $group_discount is null -->
                                    @endif
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           @php
                           $discountedPrice = $sub_total * (1 - ($customer_draft->discount / 100));
                           $additionalGroupDiscount = $sub_total * ($grup_discount->group_dicount_percent / 100);
                           $discountedPrice = $discountedPrice - $additionalGroupDiscount;
                           if ($customer_draft->configuration == "Unassembled") {
                           $configurationDiscount = $sub_total * (8 / 100); 
                           $discountedPrice = $discountedPrice - $configurationDiscount;
                           }
                           elseif($customer_draft->configuration == "Assembled")
                           {
                           $configurationDiscount = $sub_total * (2 / 100); 
                           $discountedPrice = $discountedPrice - $configurationDiscount;
                           }
                           @endphp
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 12px;font-weight: Bold;">Total (Net Payable)</p>
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

@endsection
@push('styles')
<style type="text/css">
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
</style>
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
@endpush
@push('custom_styles')
@endpush
@push('scripts')
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
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
   		}],
           order: [[0, 'desc']]
   	});
   $('.deleterow').on('click', function() {
   	var tablename = $(this).closest('table').DataTable();
   	tablename
   		.row($(this)
   			.parents('tr'))
   		.remove()
   		.draw();
   
   });
</script>
<script>
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
     url: "{{ url('admin/process-manage/delete') }}"+'/'+id,
     type: 'GET',
     dataType: 'html',
     success:function(response) {
   	 location.reload();
   	 $('.flash-message').text(response.message).fadeIn().delay(2000).fadeOut();
     }
    });
   });
   }
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
@endpush
@push('modals')
@endpush
<!DOCTYPE html>
<html>
   <head>
      <title>With Price</title>
      <style>
         .page-break {
         page-break-after: always;
         }
         table.table-bordered > thead > tr > th{
         border:1px solid #a1a1a1;
         padding: 4px;
         }
         table.table-bordered > tbody > tr > td{
         border:1px solid #a1a1a1;
         padding: 4px;
         }
         .table{
         width: 100%;
         }
         header{
         position: fixed;
         top: 0cm;
         left: 0cm;
         right: 0cm;
         height: 3cm;
         bottom: 0cm;
         }
         footer{
         position: fixed;
         top: 0cm;
         left: 0cm;
         right: 0cm;
         height: 2cm;
         }
         body {
         margin-top: 3cm; /* Adjust this value as needed */
         width: 100%;
         left: 0cm;
         right: 0cm;
         margin-bottom: 2cm;
         }
         .pd_cls
         {
         /*   padding-bottom: 10px;*/
         padding-top: 27px;
         }
         .lg_cls
         {
         width: 253px;
         padding-bottom: 53px;
         }
         .bllvr_cls
         {
         border: 1px solid #000000;
         padding: 1px;
         }
         .fn_cls
         {
         color: #000000;
         padding: 2px 3px 7px 13px;
         font-size: 11px;
         margin-bottom: 0px;
         margin-top: -9px;
         }
         .ppd_cls tr:last-child td {
         border-bottom: 1px solid black;
         }
         .per_cls
         {
         border-right: 1px solid black;
         border-top: 1px solid black;
         /*   border-bottom: 1px solid black;*/
         text-align: center;
         }
         .per_cls:first-child {
         border-left: 1px solid black; /* Adding left border to the first column only */
         }
         .dr_cls
         {
         padding-top: 20px;
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
         .content-section .tr_cls td{
         border-bottom : 1px solid black;
         }
         tr.tr_cls:nth-child(even) {
         background-color: #e3e3e3;
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
         .pdsc_cls
         {
         padding-top: 10px;
         }
         .prc_cls
         {
         padding: 0px 0px 0px 13px;
         }
         .thn_cls
         {
         font-size: 11px;
         padding: 13px 9px 0px 9px;
         /*   text-align: center;*/
         }
         .grd_cls
         {
         height: 100%;
         border: 1px solid #000000;
         padding: 2px;
         }
      </style>
   </head>
   <body>
      <header>
         <div>
            <div style="width: 100%;">
               <div style="width: 40%;display: inline-block;">
                  <img src="{{asset('public/logo.png')}}" class="lg_cls">
               </div>
               <div style="width: 18%;display: inline-block;"></div>
               <div class="bllvr_cls" style="width: 40%; display: inline-block; ">
                  <p class="title" style="border-bottom: 1px solid #000000; padding: 0px 3px 7px 13px;font-size: 16px;font-weight: Bold;">Sales Order - #{{$customer_draft_Id}}</p>
                  <p class="fn_cls">420 Frontage Rd, West Haven<br>CT 06516, USA<br><b>Email:</b> info@deluxewoodcabinetry.com<br><b>Phone:</b> (475) 655-2687</p>
               </div>
            </div>
         </div>
      </header>
      <footer>
      </footer>
      <main>
         <div class="pd_cls" style="width: 100%; font-size: 0;
         ">
            <div class="bllvr_cls" style="width: 40%; display: inline-block; font-size: 16px; height: 18%;">
               <p class="title" style="border-bottom: 1px solid #000000; padding: 2px 3px 7px 13px; font-size: 13px; font-weight: bold;">Bill To</p>
               <p class="fn_cls">{{$pdf_data->representative_name}}<br>{{$pdf_data->company_name}}<br>{{$pdf_data->customer_address}}<br>{{$pdf_data->customer_no}}<br>{{$pdf_data->email}}</p>
            </div>
            <div class="" style="width: 18%; display: inline-block; font-size: 16px;height: 18%;">
            </div>
            <div class="bllvr_cls" style="width: 40%; display: inline-block; font-size: 16px;height: 18%;margin-left: 4px;">
               <p class="title" style="border-bottom: 1px solid #000000; padding: 2px 3px 7px 13px; font-size: 13px; font-weight: bold;">Ship To</p>
               <p class="fn_cls">{{$pdf_data->ship_name}}<br>{{$pdf_data->ship_address}}, {{$pdf_data->ship_city}}, {{$pdf_data->ship_state}}, {{$pdf_data->ship_zip_code}}<br>{{$pdf_data->ship_contact_no}}<br>{{$pdf_data->ship_email}}</p>
            </div>
         </div>
         <table style="border-collapse: collapse; width:100%;" class="ppd_cls">
            <tr>
               <th class="per_cls" style="font-size:11px;font-weight:700;">PROJECT DATE</th>
               <th class="per_cls" style="font-size:11px;font-weight:700;">PO NUMBER</th>
               <th class="per_cls" style="font-size:11px;font-weight:700;">DESIGNER</th>
               <th class="per_cls" style="font-size:11px;font-weight:700;">SERVICE TYPE</th>
               <th class="per_cls" style="font-size:11px;font-weight:700;">CONFIGURATION</th>
               <th class="per_cls" style="font-size:11px;font-weight:700;">SHIP DATE</th>
            </tr>
            <tr>
               <td class="per_cls" style="font-size:11px">{{$pdf_data->created_at->format('m-d-Y') }}</td>
               <td class="per_cls" style="font-size:11px">{{$pdf_data->po_number}}</td>
               <td class="per_cls" style="font-size:11px">{{$pdf_data->designer}}</td>
               <td class="per_cls" style="font-size:11px">{{$customer_draft->service_type}}</td>
               <td class="per_cls" style="font-size:11px">{{$customer_draft->configuration}}</td>
               <td class="per_cls" style="font-size:11px"></td>
            </tr>
         </table>
         @php $sub_total = 0; @endphp
         @php $ItemtotalPrice  = 0; @endphp
         @php $totalCutDepthPrice = 0; $totalModificationPrice = 0; $totalDoorStylePrice  = 0; $totalAccessoriesPrice = 0; $hinge_value = 0; $finish_value = 0;@endphp
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
                           <!-- <p class="text dc_cls">
                              @php
                              $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                              @endphp
                              <b>CAB. Style : </b> {{ $doorStyle->name }}
                              </p> -->
                           <p class="text" style="font-size: 10px;padding: 3px;border: 1px solid #000000; width: 39%;background-color: #CBCBCB; color: #000000;">
                              @php
                              $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                              @endphp
                              CAB. Style: {{ $doorStyle->name }}
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
         <table class="tbl content-section">
            <tr>
               <th class="thtd_cls text-center" style="font-weight: 700;">NO</th>
               <th class="thtd_cls text-center" style="font-weight: 700;">QTY</th>
               <th class="thtd_cls text-center"style="font-weight: 700;">SKU</th>
               <!-- <th class="thtd_cls text-center">Item Name</th> -->
               <th class="thtd_cls text-center"style="font-weight: 700;">CUT DEPTH</th>
               <th class="thtd_cls text-center"style="font-weight: 700;">ACCESSORIES</th>
               <th class="thtd_cls text-center"style="font-weight: 700;">MODIFICATIONS</th>
               <th class="thtd_cls text-center"style="font-weight: 700;">HS</th>
               <th class="thtd_cls text-center"style="font-weight: 700;">FE</th>
               <th class="thtd_cls text-center"style="font-weight: 700;">Price</th>
            </tr>
            @php
            $no = 1;
            @endphp
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
            $ItemtotalPrice += $productTotalPrice;
            @endphp
            <tr class="tr_cls content-section">
               <td class="thtd_cls text-center" style="width: 5%;">{{$no}}</td>
               <td class="thtd_cls text-center" style="width: 5%;">{{$data->quantity}}</td>
               <td class="thtd_cls text-center" style="width: 12%;">{{$data->product_item_sku}} - (${{$data->product_item_price}})</td>
               <!-- <td class="thtd_cls text-center" style="width: 20%;">{{$data->product_name}} </td> -->
               <td class="thtd_cls text-center" style="width: 10%;">
                  @if(!empty($data->selected_cut_depth))
                  {{$data->selected_cut_depth}} - (${{$data->cut_depth_price}})
                  @else
                  None
                  @endif
               </td>
               <td class="thtd_cls text-center" style="width: 15%;">
                  @foreach ($data->accessories_nm as $accessoryName)
                  @if (!empty($accessoryName->accessories_nm))
                  {{ $accessoryName->accessories_nm }} - (${{ $accessoryName->accessories_price }})<br>
                  @else
                  None<br>
                  @endif
                  @endforeach
               </td>
               <td class="thtd_cls text-center" style="width: 15%;"> 
                  @foreach ($data->modification_nm as $modificationName)
                  @if (!empty($modificationName->modification_nm))
                  {{ $modificationName->modification_nm }} - (${{ $modificationName->modification_price }})<br>
                  @else
                  None<br>
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
                  'None' => '-', 
                  ];
                  @endphp
                  @if(isset($hingeSideMap[$data->hinge_side]))
                  {{ $hingeSideMap[$data->hinge_side] }}  
                  @if ($data->hinge_side == "R")
                  - (${{ $data->right_hinge_side_price }})
                  @elseif ($data->hinge_side == "L")
                  - (${{ $data->left_hinge_side_price }})
                  @endif
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
                  'None' => '-',
                  ];
                  @endphp
                  @if(isset($finishSideMap[$data->finish_side]))
                  {{ $finishSideMap[$data->finish_side] }}
                  @if ($data->finish_side == "L")
                  - (${{ $data->left_finish_side_price }})
                  @elseif ($data->finish_side == "R")
                  - (${{ $data->right_finish_side_price }})
                  @elseif ($data->finish_side == "B")
                  - (${{ $data->both_finish_side_price }})
                  @endif
                  @else
                  <center>N/A</center>
                  @endif
                  @else
                  <center>N/A</center>
                  @endif
               </td>
               <td class="thtd_cls text-center" style="width: 10%;">{{$data->sub_total_price}}</td>
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
            @php
            $no++;
            @endphp
            @endforeach
            @endif
         </table>
         @endforeach
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
         $taxRate = $taxGroup->tax_rate;
         $taxGroupDiscount = $discountedPrice * ($taxRate / 100);
         $discountedPrice -= $taxGroupDiscount;
         $discountedPrice += $shippingCost;
         @endphp
         <div>
         <div style="width:100%;border-color: #FFFFFF; padding-top: 30px;page-break-before: auto; page-break-inside: avoid;">
            <div style="width: 40%;display: inline-block;padding-top: 42px;">
            </div>
            <div style="width: 18%;display: inline-block;padding-top: 42px;"></div>
            <div style="width: 40%; padding-top: 10px;display: inline-block; margin-left: 6px;">
               <table width="100%" height="100%" style="border: 1px solid #000000; background-color: #CBCBCB;font-size: 10px;font-weight: 600;">
                  @if($totalModificationPrice != 0)
                  <tr>
                     <td class="prc_cls" colspan="3" style="padding-top: 7px;">Modifications Price</td>
                     <td class="prc_cls" style="padding-top: 7px;">${{$totalModificationPrice}}</td>
                  </tr>
                  @endif
                  @if($totalAccessoriesPrice !=0)
                  <tr>
                     <td colspan="3" class="prc_cls">Accessories Price</td>
                     <td class="prc_cls">${{$totalAccessoriesPrice}}</td>
                  </tr>
                  @endif
                  @if($totalDoorStylePrice != 0)
                  <tr style="display:none;">
                     <td colspan="3" class="prc_cls">DoorStyle Price</td>
                     <td class="prc_cls">${{$totalDoorStylePrice}}</td>
                  </tr>
                  @endif
                  @if($totalCutDepthPrice != 0)
                  <tr>
                     <td colspan="3" class="prc_cls">Cut Depth Price</td>
                     <td class="prc_cls">${{$totalCutDepthPrice}}</td>
                  </tr>
                  @endif
                  @if($hinge_value != 0)
                  <tr>
                     <td colspan="3" class="prc_cls">Hinge Side Price</td>
                     <td class="prc_cls">${{$hinge_value}}</td>
                  </tr>
                  @endif
                  @if($finish_value != 0)
                  <tr>
                     <td colspan="3" class="prc_cls">Finish Side Price</td>
                     <td class="prc_cls">${{$finish_value}}</td>
                  </tr>
                  @endif
                  <tr>
                     <td colspan="3" class="prc_cls">Item Price</td>
                     <td class="prc_cls">${{ number_format($ItemtotalPrice, 2, '.', '') }}</td>
                  </tr>
                  <tr>
                     <td colspan="3" class="prc_cls" style="padding-bottom: 7px;width: 70%;">Subtotal</td>
                     <td class="prc_cls" style="padding-bottom: 7px;">${{ number_format($sub_total, 2, '.', '') }}</td>
                  </tr>
               </table>
            </div>
            <div style="width: 40%;display: inline-block;padding-top: 42px;">
            </div>
            <div style="width: 18%;display: inline-block;padding-top: 42px;"></div>
            <div  style="padding-top: 10px;width: 40%;display: inline-block;margin-left: 6px;">
               <table width="100%" height="100%" style="border: 1px solid #000000; font-size: 10px;font-weight: 600;">
                  @if($customer_draft->configuration == "Unassembled")
                  <tr>
                     <td class="prc_cls" colspan="3" style="padding-top: 7px;width: 70%;">Unassembled Discount</td>
                     <td class="prc_cls" style="padding-top: 7px;width: 70%;">8 %</td>
                  </tr>
                  @endif
                  <tr>
                     <td colspan="3" class="prc_cls">Group Discount</td>
                     <td class="prc_cls">{{$customer_draft->discount}}%</td>
                  </tr>
                  @if($taxGroup->tax_group == "With Tax" && $taxGroup->tax_rate!="")
                  <tr>
                     <td colspan="3" class="prc_cls">Tax:</td>
                     <td class="prc_cls">{{$taxGroup->tax_rate}}%</td>
                  </tr>
                  @endif
                  @if($customer_draft->service_type == "Curbside Delivery")
                  <tr>
                     <td class="prc_cls" colspan="3">Shipping Cost</td>
                     <td class="prc_cls">$150</td>
                  </tr>
                  @endif
                  @if($customer_draft->service_type  == "In-house Delivery")
                  <tr>
                     <td class="prc_cls" colspan="3">Shipping Cost</td>
                     <td class="prc_cls">$250</td>
                  </tr>
                  @endif
                  <td colspan="3" class="prc_cls" style="padding-bottom: 7px;width: 70%;">Total</td>
                  <td class="prc_cls" style="padding-bottom: 7px;width: 70%;">${{ number_format($discountedPrice, 2, '.', '') }}</td>
                  </tr>
               </table>
            </div>
         </div>
     </div>
         <div>
         <div style="border: 1px solid #000000;margin-top: 50px;page-break-before: auto; page-break-inside: avoid;">
            <p class="thn_cls" style="font-size: 10px; font-weight: 600;">* The estimated time your order will be ready for pick up is 5 BUSINESS DAYS Excluding Holidays Closing Days from the time we receive your signature.                       
               <br><br>
               - - Signatures received after 10am will be considered as received on the next business day. Signatures received on Friday’s after 9:30am will be considered as received on next business day - -
               <br><br>
               -- Please be advised - Deluxewood Cabinetry will confirm inventory upon order - if in the event an item is not available we will contact you immediately--
               <br><br>
               -- Please be advised, Deluxe Wood Cabinetry only provide service to CT, NY, NJ
               <br><br>
               All paid and signed orders will be responded to within 24 hours.
               <br>  <b>Return policy:</b> 
               <br>
               Customized cabinets are final sale. Regular returns are subject to a 35% restocking fee. In the event that you received the wrong 
               merchandise or your merchandise arrived damaged, you must report this within 72 hours to qualify for a cost free replacement.  
            </p>
         </div>
         </div>
    <div>
       <div style="margin-top: 50px;width: 101%;page-break-before: auto; page-break-inside: avoid;">
    
        <div style="width: 61%; padding-right: 0px; display: inline-block;">
            <div style="padding: 4px 5px 0px 9px;height: 65px; border: 1px solid #000000;">
                <p style="font-size: 8px; font-weight: 600; text-align: center;">
                    No additional orders will be accepted until fees have been paid or orders picked up.
                    <div style="display: flex;">
                        <div style="width: 30%;display: inline-block;"></div>
                        <div style="width: 22%;display: inline-block; border-right: 2px solid; font-size: 8px; font-weight: 600; text-align: center;">
                            Pick Up Hours:<br>
                            Mon-Thurs: 9am-4pm<br>
                            Friday: 9am-11am
                        </div>
                        <div style="width: 22%;display: inline-block; font-size: 8px; font-weight: 600; text-align: center;">
                            Delivery Hours:<br>
                            Monday - Friday:<br>
                            9am-5pm
                        </div>
                    </div>
                </p>
            </div>
        </div>
      <div style="padding-right: 0px; display: inline-block; width: 38%;margin-left: -4px!important;">
            <div style="padding: 4px 5px 0px 9px; height: 65px; border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;">
                <hr style="width: 68%; float: right; border-color: black; opacity: 0.80;margin-top: 15px;">
                <p style=" font-size: 12px; font-weight: 700;margin-bottom: 0px;">Name</p>
                <hr style="width: 68%; float: right; border-color: black; opacity: 0.80;margin-top: 15px;">
                <p style="font-size: 12px; font-weight: 700;margin-bottom: 1px;">Signature</p>
            </div>
        </div>
    </div>
</div>
         <p style="text-align: right;font-size: 10px;margin-top: 0px;">{{$pdf_data->created_at}}</p>
      </main>
      <script type="text/php">
          if( isset($pdf))
          {
            $x = 502;
            $y = 780;
            $text = "{PAGE_NUM}/{PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica","bold");
            $size = 10;
            $color = array(.16, .16, .16);
            $word_space = 0.0;
            $char_space = 0.0;
            $angle = 0.0;
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle );
          }
      </script>
   </body>
</html>
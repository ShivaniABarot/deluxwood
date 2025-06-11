<!DOCTYPE html>
<html>
   <head>
      <title>Sales Order</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
         .page-break {
            page-break-after: always;
         }
         table.table-bordered > thead > tr > th {
            border: 1px solid #a1a1a1;
            padding: 4px;
         }
         table.table-bordered > tbody > tr > td {
            border: 1px solid #a1a1a1;
            padding: 4px;
         }
         .table {
            width: 100%;
         }
         header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
         }
         footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
         }
         body {
            margin-top: 3cm;
            width: 100%;
            margin-bottom: 2cm;
            font-family: 'Open Sans', sans-serif;
         }
         .pd_cls {
            padding-top: 27px;
         }
         .lg_cls {
            width: 253px;
            padding-bottom: 53px;
         }
         .bllvr_cls {
            border: 1px solid #000000;
            padding: 1px;
         }
         .fn_cls {
            color: #000000;
            padding: 2px 3px 7px 13px;
            font-size: 11px;
            margin-bottom: 0px;
            margin-top: -9px;
         }
         .custom-hr {
            width: 68%;
            height: 1px;
            background-color: black;
            opacity: 0.80;
            margin-top: 15px;
            margin-bottom: 15px;
            float: right;
         }
         .custom-hr1 {
            width: 68%;
            height: 1px;
            background-color: black;
            opacity: 0.80;
            margin-bottom: 15px;
            float: right;
         }
         .ppd_cls tr:last-child td {
            border-bottom: 1px solid black;
         }
         .per_cls {
            border-right: 1px solid black;
            border-top: 1px solid black;
            text-align: center;
         }
         .per_cls:first-child {
            border-left: 1px solid black;
         }
         .dr_cls {
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
         .content-section .tr_cls td {
            border-bottom: 1px solid black;
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
         .prc_cls {
            padding: 0px 0px 0px 13px;
         }
         .thn_cls {
            font-size: 11px;
            padding: 13px 9px 0px 9px;
         }
         .grd_cls {
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
               <div style="width: 40%; display: inline-block;">
                  <img src="{{ public_path('logo.png') }}" class="lg_cls" alt="Logo">
               </div>
               <div style="width: 18%; display: inline-block;"></div>
               <div class="bllvr_cls" style="width: 40%; display: inline-block;">
                  <p class="title" style="border-bottom: 1px solid #000000; padding: 0px 3px 7px 13px; font-size: 16px; font-weight: bold;">Sales Order - DW-{{ $customer_draft_Id }}</p>
                  <p class="fn_cls">420 Frontage Rd, West Haven<br>CT 06516, USA<br><b>Email:</b> info@deluxewoodcabinetry.com<br><b>Phone:</b> (475) 655-2687</p>
               </div>
            </div>
         </div>
      </header>
      <footer></footer>
      <main>
         <div class="pd_cls" style="width: 100%; font-size: 0;">
            <div class="bllvr_cls" style="width: 40%; display: inline-block; font-size: 16px;">
               <p class="title" style="border-bottom: 1px solid #000000; padding: 2px 3px 7px 13px; font-size: 13px; font-weight: bold;">Bill To</p>
               <p class="fn_cls">{{ $pdf_data->representative_name }}<br>{{ $pdf_data->company_name }}<br>{{ $pdf_data->customer_address }}, {{ $pdf_data->customer_city }}, {{ $pdf_data->customer_state }}<br>{{ $pdf_data->customer_no }}<br>{{ $pdf_data->email }}</p>
            </div>
            <div style="width: 18%; display: inline-block; font-size: 16px;"></div>
            <div class="bllvr_cls" style="width: 40%; display: inline-block; font-size: 16px; margin-left: 4px;">
               <p class="title" style="border-bottom: 1px solid #000000; padding: 2px 3px 7px 13px; font-size: 13px; font-weight: bold;">Ship To</p>
               <p class="fn_cls">{{ $pdf_data->ship_name }}<br>{{ $pdf_data->ship_address }}, {{ $pdf_data->ship_city }}, {{ $pdf_data->ship_state }}, {{ $pdf_data->ship_zip_code }}<br>{{ $pdf_data->ship_contact_no }}<br>{{ $pdf_data->ship_email }}</p>
            </div>
         </div>
         <table style="border-collapse: collapse; width: 100%;" class="ppd_cls">
            <tr>
               <th class="per_cls" style="font-size: 11px; font-weight: 700;">PROJECT DATE</th>
               <th class="per_cls" style="font-size: 11px; font-weight: 700;">PO NUMBER</th>
               <th class="per_cls" style="font-size: 11px; font-weight: 700;">DESIGNER</th>
               <th class="per_cls" style="font-size: 11px; font-weight: 700;">SERVICE TYPE</th>
               <th class="per_cls" style="font-size: 11px; font-weight: 700;">SHIP DATE</th>
            </tr>
            <tr>
               <td class="per_cls" style="font-size: 11px">{{ $pdf_data->created_at->format('m-d-Y') }}</td>
               <td class="per_cls" style="font-size: 11px">{{ $pdf_data->po_number }}</td>
               <td class="per_cls" style="font-size: 11px">{{ $pdf_data->designer }}</td>
               <td class="per_cls" style="font-size: 11px">{{ $customer_draft->service_type }}</td>
               <td class="per_cls" style="font-size: 11px"></td>
            </tr>
         </table>
         @php
            $sub_total = 0;
            $ItemtotalPrice = 0;
            $totalCutDepthPrice = 0;
            $totalModificationPrice = 0;
            $totalDoorStylePrice = 0;
            $totalAccessoriesPrice = 0;
            $hinge_value = 0;
            $finish_value = 0;
         @endphp
         @foreach ($newdata_arr as $doorStyleId => $products)
            <div class="row g-3 align-items-center dr_cls">
               @php
                  $draftStyle = \App\Models\DoorStyle::leftJoin('customer_draft_style', 'customer_draft_style.door_style_Id', '=', 'door_style.doorStyle_id')
                     ->where('customer_draft_style.door_style_Id', '=', $doorStyleId)
                     ->where('customer_draft_style.customer_draft_Id', '=', $customer_draft_Id)
                     ->select('customer_draft_style.draft_style_id', 'customer_draft_style.configuration')
                     ->first();
                  $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
               @endphp
               <table style="border-collapse: collapse; width: 76%; font-family: 'Open Sans', sans-serif;" class="ppd_cls">
                  <tr>
                     <td class="per_cls" style="font-size: 12px"><b>Door Style:</b> {{ $doorStyle->name }} <br>{{ $doorStyle->description }}</td>
                     <td class="per_cls" style="font-size: 12px"><b style="font-size: 13px">Configuration:</b> {{ $draftStyle->configuration }}</td>
                  </tr>
               </table>
               <br>
               <div class="col-md-4">
                  @csrf
               </div>
            </div>
            <table class="tbl content-section">
               <tr>
                  <th class="thtd_cls text-center" style="font-weight: 700;">NO</th>
                  <th class="thtd_cls text-center" style="font-weight: 700;">QTY</th>
                  <th class="thtd_cls text-center" style="font-weight: 700;">SKU</th>
                  <th class="thtd_cls text-center" style="font-weight: 700;">HS</th>
                  <th class="thtd_cls text-center" style="font-weight: 700;">FE</th>
                  <th class="thtd_cls text-center" style="font-weight: 700;">CUT DEPTH</th>
                  <th class="thtd_cls text-center" style="font-weight: 700;">ACCESSORIES</th>
                  <th class="thtd_cls text-center" style="font-weight: 700;">MODIFICATIONS</th>
               </tr>
               @php $no = 1; @endphp
               @if (!empty($products))
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
                        $totalDoorStylePrice += $DoorPrice;
                        $ModificationPrice = DB::table('draft_product')
                           ->selectRaw('SUM(item_modification.modification_price * draft_product.quantity) AS total_modification_price')
                           ->where('draft_product.draft_product_id', $data->draft_product_id)
                           ->join('draft_product_modification', 'draft_product.draft_product_id', '=', 'draft_product_modification.draft_product_id')
                           ->join('item_modification', function ($join) {
                              $join->on('draft_product_modification.modification_id', '=', 'item_modification.modification_id')
                                   ->on('draft_product.product_id', '=', 'item_modification.product_id');
                           })
                           ->value('total_modification_price');
                        $totalModificationPrice += $ModificationPrice;
                        $AccessoriesPrice = DB::table('draft_product')
                           ->selectRaw('SUM(item_accessories.accessories_price * draft_product.quantity) AS total_accessories_price')
                           ->where('draft_product.draft_product_id', $data->draft_product_id)
                           ->join('draft_product_accessories', 'draft_product.draft_product_id', '=', 'draft_product_accessories.draft_product_id')
                           ->join('item_accessories', function ($join) {
                              $join->on('draft_product_accessories.accessories_id', '=', 'item_accessories.accessories_id')
                                   ->on('draft_product.product_id', '=', 'item_accessories.product_id');
                           })
                           ->value('total_accessories_price');
                        $totalAccessoriesPrice += $AccessoriesPrice;
                        if ($data->cut_depth == "Yes" && $data->is_cut_depth == "Yes") {
                           $price += $data->cut_depth_price;
                           $totalCutDepthPrice += $data->cut_depth_price * $data->quantity;
                        }
                        $sumOfProductPrice = DB::table('item_dimensions')->where('product_id', $data->product_id)->sum('item_price');
                        $price += $sumOfProductPrice;
                        $price *= $data->quantity;
                        $productTotalPrice = $data->product_item_price * $data->quantity;
                        $ItemtotalPrice += $productTotalPrice;
                     @endphp
                     <tr class="tr_cls content-section">
                        <td class="thtd_cls text-center" style="width: 5%;">{{ $no }}</td>
                        <td class="thtd_cls text-center" style="width: 5%;">{{ $data->quantity }}</td>
                        <td class="thtd_cls text-center" style="width: 12%;">{{ $data->product_item_sku }}</td>
                        <td class="thtd_cls text-center" style="width: 10%;">
                           @if ($data->is_hinge_side == "Yes")
                              @php
                                 $hingeSideMap = [
                                    'L' => 'Left',
                                    'R' => 'Right',
                                    'B' => 'Both',
                                    'None' => '-',
                                 ];
                              @endphp
                              @if (isset($hingeSideMap[$data->hinge_side]))
                                 {{ $hingeSideMap[$data->hinge_side] }}
                              @else
                                 <center>-</center>
                              @endif
                           @else
                              <center>-</center>
                           @endif
                        </td>
                        <td class="thtd_cls text-center" style="width: 10%;">
                           @if ($data->is_finish_side == "Yes")
                              @php
                                 $finishSideMap = [
                                    'L' => 'Left',
                                    'R' => 'Right',
                                    'B' => 'Both',
                                    'None' => '-',
                                 ];
                              @endphp
                              @if (isset($finishSideMap[$data->finish_side]))
                                 {{ $finishSideMap[$data->finish_side] }}
                              @else
                                 <center>-</center>
                              @endif
                           @else
                              <center>-</center>
                           @endif
                        </td>
                        <td class="thtd_cls text-center" style="width: 10%;">
                           @if (!empty($data->selected_cut_depth))
                              {{ $data->selected_cut_depth }}
                           @else
                              -
                           @endif
                        </td>
                        <td class="thtd_cls text-center" style="width: 15%;">
                           @foreach ($data->accessories_nm as $accessoryName)
                              @if (!empty($accessoryName->accessories_nm))
                                 {{ $accessoryName->accessories_nm }} <br>
                              @else
                                 <br>
                              @endif
                           @endforeach
                        </td>
                        <td class="thtd_cls text-center" style="width: 15%;">
                           @foreach ($data->modification_nm as $modificationName)
                              @if (!empty($modificationName->modification_nm))
                                 {{ $modificationName->modification_nm }} <br>
                              @else
                                 <br>
                              @endif
                           @endforeach
                        </td>
                     </tr>
                     @php
                        $sub_total += $price + $ModificationPrice + $AccessoriesPrice + $DoorPrice;
                        if ($sides && property_exists($sides, 'hinge_side') && $sides->hinge_side == "Yes") {
                           if ($data->hinge_side == "L" && isset($hinge_price->left_hinge_side_price)) {
                              $hinge_value += $hinge_price->left_hinge_side_price * $data->quantity;
                           }
                           if ($data->hinge_side == "R" && isset($hinge_price->right_hinge_side_price)) {
                              $hinge_value += $hinge_price->right_hinge_side_price * $data->quantity;
                           }
                           if ($data->hinge_side == "B" && isset($hinge_price->both_hinge_side_price)) {
                              $hinge_value += $hinge_price->both_hinge_side_price * $data->quantity;
                           }
                        }
                        if ($sides && property_exists($sides, 'finish_side') && $sides->finish_side == "Yes") {
                           if ($data->finish_side == "L" && isset($finish_price->left_finish_side_price)) {
                              $finish_value += $finish_price->left_finish_side_price * $data->quantity;
                           }
                           if ($data->finish_side == "R" && isset($finish_price->right_finish_side_price)) {
                              $finish_value += $finish_price->right_finish_side_price * $data->quantity;
                           }
                           if ($data->finish_side == "B" && isset($finish_price->both_finish_side_price)) {
                              $finish_value += $finish_price->both_finish_side_price * $data->quantity;
                           }
                        }
                        $no++;
                     @endphp
                  @endforeach
               @endif
               <tr>
                  <td colspan="7" class="thtd_cls text-right" style="font-weight: bold; text-align: right; padding-right: 8px;">Total Price:</td>
                  <td class="thtd_cls text-center" style="font-weight: bold;">${{ number_format($sub_total, 2) }}</td>
               </tr>
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
            $discountedPrice += $taxGroupDiscount;
            $discountedPrice += $shippingCost;
            $original_price = $discountedPrice;
         @endphp
         <div>
            @if ($customer_draft->customer_note != "")
               <div style="width: 100%; display: inline-block; padding-top: 20px; font-size: 14px; font-family: 'Open Sans', sans-serif;">
                  <label class="form-label">Note</label>
                  <table width="100%" height="100%" style="border: 1px solid #000000;">
                     <tr>
                        <td class="prc_cls" colspan="3" style="padding: 10px;">{!! $customer_draft->customer_note !!}</td>
                     </tr>
                  </table>
               </div>
            @endif
            <div style="border: 1px solid #000000; margin-top: 50px; page-break-before: auto; page-break-inside: avoid;">
               <div class="thn_cls" style="font-size: 12px; line-height: 1.4;">
                  <b>Terms & Conditions:</b><br>
                  <b>Order Processing:</b>
                  <ul style="margin: 0 0 5px 20px; padding: 0;">
                     <li>Orders received after 10 AM will be processed the next business day.</li>
                  </ul>
                  <b>Pick-Up Orders:</b>
                  <ul style="margin: 0 0 5px 20px; padding: 0;">
                     <li>Ready in 3–5 business days (excl. holidays). Late pick-ups incur a $50/day storage fee.</li>
                  </ul>
                  <b>Shipping Orders:</b>
                  <ul style="margin: 0 0 5px 20px; padding: 0;">
                     <li>Ship in 7–10 business days. Extra fees apply outside CT, NY, NJ. Contact us for more info.</li>
                  </ul>
                  <b>Additional Shipping Charges:</b>
                  <ul style="margin: 0 0 5px 20px; padding: 0;">
                     <li>15–18 boxes: $50</li>
                     <li>19–25 boxes: $150</li>
                     <li>26–36 boxes: $250</li>
                     <li>37–50 boxes: $450</li>
                  </ul>
                  <b>Inventory Confirmation:</b>
                  <ul style="margin: 0 0 5px 20px; padding: 0;">
                     <li>We’ll confirm availability after order receipt. Out-of-stock items will be communicated.</li>
                  </ul>
                  <b>Special Lead Times:</b>
                  <ul style="margin: 0 0 5px 20px; padding: 0;">
                     <li>Slab doors: 4–6 weeks lead time.</li>
                     <li>Beveled Shaker Grey: +3 days processing.</li>
                  </ul>
                  <b>Return Policy:</b>
                  <ul style="margin: 0 0 5px 20px; padding: 0;">
                     <li>All sales final. Report incorrect/damaged items within 72 hours for free replacement.</li>
                     <li>If a return is authorized, a 25% restocking fee applies.</li>
                  </ul>
                  <b>Thank you for choosing Deluxe Wood Cabinetry!</b>
               </div>
            </div>
         </div>
         <div>
            <div style="margin-top: 50px; width: 101%; page-break-before: auto; page-break-inside: avoid;">
               <div style="width: 61%; padding-right: 0px; display: inline-block;">
                  <div style="padding: 4px 5px 0px 9px; height: 65px; border: 1px solid #000000;">
                     <p style="font-size: 8px; text-align: center;">
                        No additional orders will be accepted until fees have been paid or orders picked up.
                        <div style="display: flex;">
                           <div style="width: 30%; display: inline-block;"></div>
                           <div style="width: 22%; display: inline-block; border-right: 2px solid; font-size: 8px; text-align: center;">
                              Pick Up Hours:<br>
                              Mon: 11am-4pm<br>
                              Tues - Friday: 10am-4pm
                           </div>
                           <div style="width: 22%; display: inline-block; font-size: 8px; text-align: center;">
                              Delivery Hours:<br>
                              Monday - Friday:<br>
                              10am-5pm
                           </div>
                        </div>
                     </p>
                  </div>
               </div>
               <div style="padding-right: 0px; display: inline-block; width: 38%; margin-left: -5px;">
                  <div style="padding: 4px 5px 0px 9px; height: 65px; border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;">
                     <div class="custom-hr"></div>
                     <p style="font-size: 12px; margin-bottom: 1px;"><b>Name</b></p>
                     <p style="font-size: 12px; margin-bottom: 1px; padding-top: 10px;"><b>Signature</b></p>
                     <div class="custom-hr1"></div>
                  </div>
               </div>
            </div>
         </div>
         <p style="text-align: right; font-size: 10px; margin-top: 0px;">{{ $pdf_data->created_at }}</p>
      </main>
      <script type="text/php">
         if (isset($pdf)) {
            $x = 502;
            $y = 780;
            $text = "{PAGE_NUM}/{PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica", "bold");
            $size = 10;
            $color = array(0.16, 0.16, 0.16);
            $word_space = 0.0;
            $char_space = 0.0;
            $angle = 0.0;
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
         }
      </script>
   </body>
</html>
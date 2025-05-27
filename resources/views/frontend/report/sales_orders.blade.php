@extends(backendView('layouts.app'))
@section('title', 'Sales Orders')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h5 class=" mb-0">Sales Order</h5>
            <a href="#" onclick="generatePDF(); return false;" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i> Download</a>
         </div>
      </div>
   </div>
   <!-- Row end  -->
   <div class="row g-3 mb-3">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <h5 class="fw-bold mb-4">BASIC DAILY SALES REPORT TEMPLATE</h5>
               <p class="tx_cls">Enter data on the Inventory List tab, then select your items from the dropdown menu in each cell of the item No. column. Enter the quantity and tax rate for each item, and the template will calculate totals.</p>
               <div class="row align-items-center">
                  <div class="border-0 mb-4">
                     <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <div class="custom-search-row">
                           <label for="searchInput">Search:</label>
                           <input type="search" id="searchInput" class="form-control form-control-sm sc_cls" placeholder="Type here order number" aria-label="Search">
                        </div>
                        <table class="sales-table">
                           <tr>
                              <td class="rg_clss tx_cls">SALES AMOUNT</td>
                              <td class="tx_cls">$3,750.00</td>
                           </tr>
                           <tr>
                              <td class="tx_cls">SALES TAX</td>
                              <td class="tx_cls">$277.50</td>
                           </tr>
                           <tr>
                              <td class="trd_cls"><b>SALES TOTAL</b></td>
                              <td class="trd_cls"><b>$4,027.50</b></td>
                           </tr>
                        </table>
                     </div>
                  </div>
               </div>
               <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;" >
                  <thead>
                     <tr>
                        <th>Order Number</th>
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Tax Rate</th>
                        <th>Tax</th>
                        <th>Total</th>
                     </tr>
                  </thead>
                  <tbody class="trackinglist">
                     @php
                     $totalAmount = 0;
                     @endphp
                     @foreach($sales_data as $val)
                     <tr>
                        <td><strong>{{$val->product_item_sku}}</strong></td>
                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{$val->product_item_name}}">{{ Str::limit($val->product_item_name, 25) }}</td>
                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{$val->description}}">{{ Str::limit($val->description, 25) }}</td>
                        <td width="10%">${{$val->total_price}}</td>
                        <td width="10%">{{$val->quantity}}</td>
                        <td width="10%">${{ $val->total_price * $val->quantity }}</td>
                        <td width="10%">30.00</td>
                        <td width="10%">230.00</td>
                        <td width="10%">230.00</td>
                        @php
                        $subtotal = $val->total_price * $val->quantity;
                        $totalAmount += $subtotal;
                        @endphp
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Sales Order PDf -->
<div class="row g-3 mb-3 invoice" id="invoice" style="display: none;">
   <div class="col-md-12">
      <div class="card" style="border-color: #ffffff;">
         <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
               <img src="{{asset('public/logo.png')}}" class="lg_cls">
               <h5 class="fw-bold mb-4 dl_cls">
                  Deluxewood Cabinetry<br>
                  <p class="hr_cls">420 Frontage Rd, West Haven, <br>CT 06516, United States<br>deluxewoodcabinetry@gmail.com<br>+1 (475)655-2687<br>+1 (475)655-2693</p>
               </h5>
            </div>
            <div class="row align-items-center">
               <div class="border-0 mb-2">
                  <div class=" py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between  flex-wrap">
                     <div class="custom-search-row">
                        <h4><b>Sales Order</b></h4>
                     </div>
                     <!-- <p><b>Draft Date:</b> {{ $pdf_data->created_at->format('d-m-Y') }}</p> -->
                  </div>
               </div>
            </div>
            <div class="col-md-12 pd_cls">
               <div class="row">
                  <div class="col-md-4 bllvr_cls">
                  <p class="title" style="border-bottom: 1px solid #a6a6a4; padding: 3px;font-size: 13px;font-weight: Bold;">Bill To</p>
                  <!-- <h6 style="border-bottom: 1px solid #a6a6a4; padding: 3px;"><b>Bill To</b></h6> -->
                     <!-- <hr> -->
                     <p class="fn_cls">{{$pdf_data->representative_name}}<br>{{$pdf_data->company_name}}<br>{{$pdf_data->customer_address}}<br>{{$pdf_data->customer_no}}<br>{{$pdf_data->email}}</p>
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4 bllvr_cls" style="margin-top:-3px">
                     <p class="title" style="border-bottom: 1px solid #a6a6a4; padding: 3px;font-size: 13px;font-weight: Bold;">Ship To</p>
                     <!-- <h6 style="border-bottom: 1px solid #a6a6a4; padding: 3px;"><b>Ship To</b></h6> -->
                     <!-- <hr> -->
                     <p class="fn_cls">{{$pdf_data->client_name}}<br>{{$pdf_data->client_address}}<br>{{$pdf_data->client_no}}</p>
                  </div>
               </div>
            </div>
         </div>
         <table style="width:100%;border:1px solid #a6a6a4; margin-bottom: 42px; border-width: 0px;">
            <tr>
               <th class="per_cls" style="font-size:11px;font-weight:600">Date</th>
               <th class="per_cls" style="font-size:11px;font-weight:600">PO Number</th>
               <th class="per_cls" style="font-size:11px;font-weight:600">CAB. Style</th>
            </tr>
            <tr>
               <td class="per_cls" style="font-size:11px;">{{ $pdf_data->created_at->format('d-m-Y') }}</td>
               <td class="per_cls" style="font-size:11px;">{{$pdf_data->po_number}}</td>
               <td class="per_cls" style="font-size:11px;">
                  @if($door_style)
                  {{ $door_style->name }}
                  @else
                  No door style available
                  @endif
               </td>
            </tr>
         </table>
         <table class="tbl">
            <tr>
               <th class="thtd_cls text-center" style="font-size:9px;font-weight:700">Qty</th>
               <th class="thtd_cls text-center" style="font-size:9px;font-weight:700">Item Name</th>
               <th class="thtd_cls text-center" style="font-size:9px;font-weight:700">Modification</th>
               <th class="thtd_cls text-center" style="font-size:9px;font-weight:700">Accessories</th>
               <th class="thtd_cls text-center" style="font-size:9px;font-weight:700">Hinge Side</th>
               <th class="thtd_cls text-center" style="font-size:9px;font-weight:700">Finish End</th>
               <th class="thtd_cls text-center" style="font-size:9px;font-weight:700">Configuration</th>
            </tr>
            @foreach($sales_data as $val)
            <tr class="tr_cls">
               <td class="thtd_cls fn_cls text-center" style="width: 8%;">{{$val->quantity}}</td>
               <td class="thtd_cls fn_cls" style="width: 23%;">{{$val->product_item_name}}</td>
               <!-- <td class="thtd_cls fn_cls" style="width: 23%;">{{$val->description}}</td> -->
               <td class="thtd_cls fn_cls text-center" style="width: 23%;">
                  @if(isset($ModificationNames[$val->draft_product_id]))
                  @foreach($ModificationNames[$val->draft_product_id] as $modification)
                  {{ $modification->modification_nm }} <br>
                  @endforeach
                  @else
                  Modifiation not found for product: {{ $val->draft_product_id }}
                  @endif
               </td>
               <td class="thtd_cls fn_cls text-center" style="width: 23%;">
                  @if(isset($accessoriesNames[$val->draft_product_id]))
                  @foreach($accessoriesNames[$val->draft_product_id] as $accessory)
                  {{ $accessory->accessories_nm }} <br>
                  @endforeach
                  @else
                  Accessories not found for product: {{ $val->draft_product_id }}
                  @endif
               </td>
               <td class="thtd_cls fn_cls text-center" style="width: 10%;">
                  @php
                  $hingeSideMap = [
                  'L' => 'Left',
                  'R' => 'Right',
                  'B' => 'Both',
                  'None' => 'None',
                  ];
                  @endphp
                  @if(isset($hingeSideMap[$val->hinge_side]))
                  {{ $hingeSideMap[$val->hinge_side] }}
                  @else
                  N/A
                  @endif
               </td>
               <td class="thtd_cls fn_cls text-center" style="width: 10%;">
                  @php
                  $finishSideMap = [
                  'L' => 'Left',
                  'R' => 'Right',
                  'B' => 'Both',
                  'None' => 'None',
                  ];
                  @endphp
                  @if(isset($finishSideMap[$val->finish_side]))
                  {{ $finishSideMap[$val->finish_side] }}
                  @else
                  N/A
                  @endif
               </td>
               <td class="thtd_cls fn_cls text-center" style="width: 6%;">{{$val->configuration}}</td>
            </tr>
            @endforeach
         </table>
      </div>
      <div class="card pdsc_cls" style="border-color: #ffffff;">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-6">
                  <!-- <p class="thn_cls">*The estimated time your order will be ready for pick up is<br> <b> 1 FULL BUSINESS DAY </b>Excluding Holidays Closing Days from the time we receive your signature.
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
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="padding-top: 10px; font-size: 11px; font-weight: normal;">Sub Total</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="padding-top: 10px; font-size: 11px; font-weight: normal;">${{$totalAmount}}
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="padding-top: 10px; font-size: 11px; font-weight: normal;">Total TAX</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style=" font-size: 11px; font-weight: normal;">20%
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="padding-top: 10px; font-size: 11px; font-weight: normal;">Shipping</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="padding-top: 10px; font-size: 11px; font-weight: normal;">100
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title" style="font-size: 12px;font-weight: Bold;">Total (Net Payable)</p>
                                    <!-- <h6><b>Total:</b></h6> -->
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="font-size: 12px;font-weight: Bold;">$ {{$totalAmount}}</p>
                                    <!-- <h6><b>$ {{$totalAmount}}</b></h6> -->
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            <!-- <div class="col-md-12" style="padding-top: 11px;">
               <div class="plc_cls">
                   <p class="thn_cls" style="font-size: 13px;">*The estimated time your order will be ready for pick up is <b> 1 FULL BUSINESS DAY </b>Excluding Holidays Closing Days from the time we receive your signature.
                     <br><br>---Signatures received after 10am will be considered as received on the next business day. Signatures received on Friday's after 9:30am will be considered as received on next business day---
                     <br><br>
                     **FOR DELIVERY, PLEASE CONTACT DELIVERY DEPARTMENT AT #373**
                  </p>
               </div>
            </div>    -->
               <h6 class="text-center" style="padding-top: 32px;">**NOTE: All our deliveries are TAIL GATE DELIVERY ONLY**</h6>
               <h6 class="text-center"><b>Please make sure to have people to unload the truck.</b></h6>
               <h6 style="text-align: right;padding-top: 20px;"><b>[1]</b> Accessories</h6>
               <h6 style="text-align: right; padding-bottom: 100px;"> Weight:  4   CF:  0.35</h6>
               <div class="col-md-8 resp_cls" style="padding-right: 0px;">
                  <div class="grd_cls">
                   <p class="thn_cls" style="font-size: 9px;">**PLEASE NOTE THERE ARE NO RETURNS AND NO EXCHANGES**
                     <br>**QUOTE MUST BE SIGNED AND FAXED BACK-QUOTE VALID FOR 30 DAYS ONLY**
                     <br><br>
                     <div class="row">
                        <div class="col-md-2"></div>
                           <div class="col-md-4 text-center" style="border-right: 2px solid;font-size: 10px;">
                              Pick Up Hours:<br>
                              Mon-Thurs: 9am-4pm<br>
                              Friday: 9am-11am                                    
                           </div>
                           <div class="col-md-4 text-center" style="font-size: 10px;">
                              Delivery Hours:<br>
                              Monday - Friday:<br>
                              8am-5pm
                           </div>
                        </div><br>
                        <p class="text-center" style="font-size: 10px;padding: 0px 5px 0px 5px;"> 
                        All orders must be shipped out or picked up on the ESD selected at the time of placing the order. If a customer is unable to accept or pick up the order on the selected ESD, the order will be shipped to a 3rd party warehouse facility for which additional charges will apply.</p>
                        </p>
                     </div>   
                  </div>
                  <div class="col-md-4" style="padding-left: 0px;">
                    <div class="grd_cls">
                           <h6 style="border-bottom: 1px solid;padding: 6px; font-weight:700">Grand Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${{$totalAmount}}</h6>
                        <p style="border-bottom: 1px solid; padding: 6px;font-size: 10px;">Please confirm that you would like to convert your Quote into a Sales Order. Once converted, This Sales Order cannot be cancelled or revised once it has proceeded to production or after 24 hours whichever is first.
                        </p>
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
                  <!-- <div class="col-md-12" style="padding-top: 25px;">
            <div class="row">
               <!-- <div class="col-md-1"></div> 
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
            </div>-->
         </div> 
               <p style="text-align: right;">{{$pdf_data->created_at}}</p>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- PDF End -->
@endsection
@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
@endpush
@push('custom_styles')
<style>
   .resp_cls
   {
/*      margin-left: 8px;*/
/*      margin-right: -25px;*/
/*  border-left: 1px solid black;*/
   }
   /* White buttons with black border */
   .btn-white-border {
   background-color: white;
   border-top: 1px solid gray;
   border-bottom: 1px solid black;
   color: black;
   }
   .size-block .filter-size ul li
   {
   /*width: 25px;
   height: 25px;*/
   }
   .size-block .filter-size ul li.active {
   background-color: #101010;
   border-color: #101010;
   color: #fff;
   }
   .zp_cls
   {
   padding: 0px!important;
   }
   .tx_cls
   {
   font-weight: 600;
   }
   .custom-search-row {
   display: flex;
   align-items: center;
   }
   .custom-search-row label {
   margin-right: 10px; 
   }
   .bllvr_cls
   {
   border: 1px solid #a6a6a4;
   padding: 1px;
   }
   .sc_cls
   {
   width: 192px;
   }
   .rg_cls {
   padding-right: 40px; 
   }
   .rg_clss {
   padding-right: 60px; 
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
   .tbl {
   font-family: arial, sans-serif;
   border-collapse: collapse;
   width: 100%;
   }
   .pdsc_cls
   {
   padding-top: 22px;
   }
   .thtd_cls {
   border: 1px solid #dddddd;
   text-align: left;
   padding: 8px;
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
   .thn_cls
   {
/*  font-size: 10px;*/
   padding: 13px 0px 0px 0px;
   text-align: center;
   }
   .pd_cls
   {
   padding-bottom: 26px;
   }
   .tablepdf tr th {
   color: var(--text-color);
   text-transform: uppercase;
   font-size: 10px;
   }
   .tablepdf tr td
   {
   font-size: 11px;
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
   .invoice {
  page-break-before: always;
}
</style>
@endpush
@push('scripts')
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/apexcharts.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/js/page/index.js') !!}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&callback=myMap"></script>
@endpush
@push('custom_scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
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
   function generatePDF() {
    // Get the HTML content of the invoice
    const invoice = document.getElementById("invoice").innerHTML;
   
    html2pdf().set({
  margin: [0, 0.2, 0, 0.2],
  filename: 'Sales Order.pdf',
  image: { type: 'jpeg', quality: 0.98 },
  html2canvas: { dpi: 300, letterRendering: true, scale: 2 },
  jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
  pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
}).from(invoice).save();
   }
</script>
@endpush
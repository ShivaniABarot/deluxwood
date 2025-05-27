@extends(backendView('layouts.app'))

@section('title', 'Sales Performance')

@section('content')


<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Sales Performance</h3>
                <!-- <a href="#" onclick="generatePDF(); return false;" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i> Download</a> -->
            </div>
        </div>
    </div> <!-- Row end  -->
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
                                    <td class="rg_cls tx_cls">SALES AMOUNT</td>
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
                <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Item NO</th>
                                <th>Item Name</th>
                                <th>Item Description</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>Tax Rate</th>
                                <th>Tax</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="trackinglist">
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Button trigger modal -->


<!-- Sales Order PDf -->
<div class="row g-3 mb-3" id="invoice" style="display: none;">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
        
            <div class="d-flex align-items-center justify-content-between flex-wrap">
               <h5 class="fw-bold mb-4 dl_cls">
                  Deluxewood Cabinetry<br>
                  <p class="hr_cls">123 Street Address,City,State, Zip<br>orders@designmykitchen.cloud<br>7412545455</p>
               </h5>
               <img src="{{asset('public/logo.png')}}" class="lg_cls">
            </div>
            <div class="row align-items-center">
               <div class="border-0 mb-4">
                  <div class=" py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between  flex-wrap">
                     <div class="custom-search-row">
                        <h4><b>Sales Performance</b></h4>
                     </div>
                     <p><b>Draft Date:</b> {{ $pdf_data->created_at->format('d-m-Y') }}</p>
                  </div>
               </div>
            </div>
            <div class="col-md-12 pd_cls">
               <div class="row">
                  <div class="col-md-4">
                     <h6><b>Bill To</b></h6>
                     <hr>
                     <p class="fn_cls">{{$pdf_data->representative_name}}<br>{{$pdf_data->company_name}}<br>{{$pdf_data->customer_address}}<br>{{$pdf_data->customer_no}}<br>{{$pdf_data->email}}</p>
                  </div>
                  <div class="col-md-4">
                     <h6><b>Ship To</b></h6>
                     <hr>
                     <p class="fn_cls">{{$pdf_data->client_name}}<br>{{$pdf_data->client_address}}<br>{{$pdf_data->client_no}}</p>
                  </div>
                  <div class="col-md-4">
                     <table class="sales-table">
                        <tr>
                           <td class="rg_cls fn_cls"><b>Door Style</b></td>
                           <td class="tx_cls fn_cls">Liberty White</td>
                        </tr>
                        <tr>
                           <td class="fn_cls"><b>PO Number</b></td>
                           <td class="tx_cls fn_cls">{{$pdf_data->po_number}}</td>
                        </tr>
                        <tr>
                           <td class="fn_cls"><b>Service Type</b></td>
                           <td class="tx_cls fn_cls">{{$pdf_data->service_type}}</td>
                        </tr>
                        <tr>
                           <td class="fn_cls"><b>Designer</b></td>
                           <td class="tx_cls fn_cls">{{$pdf_data->designer}}</td>
                        </tr>
                        <tr>
                           <td class="fn_cls"><b>Configuartion</b></td>
                           <td class="tx_cls fn_cls">{{$pdf_data->configuration}}</td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
            <table class="tbl">
               <tr>
                  <th class="thtd_cls text-center">Qty</th>
                  <th class="thtd_cls text-center">Item Name</th>
                  <th class="thtd_cls text-center">Description</th>
                  <th class="thtd_cls text-center">Hinge Side</th>
                  <th class="thtd_cls text-center">Finish Side</th>
                  <th class="thtd_cls text-center">Price</th>
               </tr>
                @foreach($sales_data as $val)
               <tr class="tr_cls">
                  <td class="thtd_cls fn_cls text-center" style="width: 8%;">{{$val->quantity}}</td>
                  <td class="thtd_cls fn_cls" style="width: 23%;">{{$val->product_item_name}}</td>
                  <td class="thtd_cls fn_cls" style="width: 23%;">{{$val->description}}</td>
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
                  <td class="thtd_cls fn_cls text-center" style="width: 6%;">${{$val->total_price}}</td>
               </tr>
               @endforeach
            </table>
         </div>
      </div>
      <div class="card pdsc_cls">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-6">
                  <p class="thn_cls">Thank you for your business!</p>
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
                                    <p class="title" style="padding-top: 10px;">Sub Total</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title" style="padding-top: 10px;"><b>$ 528</b>
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title">Discount</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title"><b>20%</b>
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title">Modification</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title"><b>20%</b>
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title">Accessories</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title"><b>20%</b>
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <p class="title">Total TAX</p>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <p class="title"><b>20%</b>
                                    </h3>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <th scope="row">
                                 <div class="table-content">
                                    <h6><b>Total:</b></h6>
                                 </div>
                              </th>
                              <td>
                                 <div class="table-content text-right">
                                    <h6><b>$ 600</b></h6>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
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
<style type="text/css">
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
   font-size: 11px;
   }
   .tbl {
   font-family: arial, sans-serif;
   border-collapse: collapse;
   width: 100%;
   }
   .pdsc_cls
   {
   padding-top: 27px;
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
   position: absolute;
   left: 15%;
   top: 40%;
   }
   .pd_cls
   {
   padding-bottom: 42px;
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
</style>
@endpush

@push('scripts')
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
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
             url: "{{ url('admin/customer-group/delete') }}"+'/'+id,
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
      margin: 0,
      filename: 'Sales Performance.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { dpi: 300, letterRendering: true, scale: 2 }, // Adjust the scale value
      jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    }).from(invoice).save();
   }
   html2pdf().set({
  margin: {
    left: 0,
    right: 0,
    top: 10,
    bottom: 10
  },
  filename: 'Sales Performance.pdf',
  image: { type: 'jpeg', quality: 0.98 },
  html2canvas: { dpi: 300, letterRendering: true, scale: 2 }, // Adjust the scale value
  jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
}).from(invoice).save();
</script>
@endpush

@push('modals')
@endpush
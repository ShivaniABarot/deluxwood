@extends(backendView('layouts.app'))

@section('title', 'Customer List')

@section('content')



<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Customer List</h3>
				<a href="#" onclick="generatePDF(); return false;" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i> Download</a>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3 mb-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					 
					<table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
						<thead>
							<tr>
							
								<th>Customer Id</th>
								<th>Company Name</th>
								<th>Contact Name</th>
								<th>Contact Title</th>
								<th>Phone</th>
								<th>Phone 2</th>
								<th>Email Address</th>
								<th>Mailing Address</th>
								<th>Billing Address</th>
								<th>Notes</th>
							</tr>
						</thead>
						<tbody>
							@foreach($customer_list as $val)
							<tr>
								<td><strong>{{$val->customer_id}}</strong></td>
								<td>{{$val->company_name}}</td>
								<td>{{$val->representative_name}}</td>
								<td></td>
								<td>{{$val->contact_number}}</td>
								<td></td>
								<td>{{$val->email}}</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Customer List Pdf -->

   <div class="row g-3 mb-3" id="invoice" style="display: none;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <!-- <h5 class="text-center"><i class="icofont-notepad fs-5"></i><b>Sales Order Report</b></h5><hr class="text-center" style="width: 35%;margin-left: 307px;"> -->
               <div class="d-flex align-items-center justify-content-between flex-wrap">
                 <h5 class="fw-bold mb-4 dl_cls">
                  Deluxewood Cabinetry<br>
                  <p class="hr_cls">420 Frontage Rd, West Haven, CT 06516, United States<br>deluxewoodcabinetry@gmail.com<br>+1 (475)655-2687<br>+1 (475)655-2693</p>
               </h5>
                  <img src="{{asset('public/logo.png')}}" class="lg_cls">
               </div>
               <table class="tbl">
                  <tr>
                     <!-- <th class="thtd_cls text-center">Customer Id</th> -->
                     <th class="thtd_cls text-center">Customer Name</th>
                     <th class="thtd_cls text-center">Company Name</th>
                     <th class="thtd_cls text-center">Email</th>
                     <th class="thtd_cls text-center">Address</th>
                     <th class="thtd_cls text-center">Contact Number</th>
                  </tr>
                  @foreach($customer_list as $val)
                  <tr class="tr_cls">
                     <!-- <td class="thtd_cls text-center"><strong>{{$val->customer_id}}</strong></td> -->
                     <td class="thtd_cls text-center">{{$val->representative_name}}</td>
                     <td class="thtd_cls text-center">{{$val->company_name}}</td>
                     <td class="thtd_cls text-center">{{$val->email}}</td>
                     <td class="thtd_cls text-center">{{$val->address}}</td>
                     <td class="thtd_cls text-center">{{$val->contact_number}}</td>
                  </tr>
                  @endforeach
               </table>
            </div>
         </div>
      </div>
   </div>


   <!-- Pdf End -->

@endsection

@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
@endpush

@push('custom_styles')
<style type="text/css">
	 .bg-lightblue
    {
    	background-color:#D9D9D9 !important;
    }
    .re_cls
    {
    	padding: 2rem !important;
    	margin-bottom: 3rem !important;
    }
    .hr_cls:hover
    {
    	color:var(--text-color);
    }
   .dl_cls
   {
   color: #eca72f;
   }
      .hr_cls
   {
   font-size: 11px;
   color: #212529;
   font-weight: normal;
   padding-top: 10px;
   }
    .tbl {
   padding-top: 15px;
   font-family: arial, sans-serif;
   border-collapse: collapse;
   width: 100%;
   }
   .thtd_cls {
   border: 1px solid #dddddd;
   text-align: left;
   padding: 8px;
   }
   tr.tr_cls:nth-child(even) {
   background-color: #dddddd;
   }
     .lg_cls
   {
   width: 200px;
   padding-bottom: 53px;
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
<script type="text/javascript">
   function generatePDF() {
    // Get the HTML content of the invoice
    const invoice = document.getElementById("invoice").innerHTML;
   
    html2pdf().set({
      margin: 0,
      filename: 'Customer List.pdf',
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
  filename: 'Sales Order.pdf',
  image: { type: 'jpeg', quality: 0.98 },
  html2canvas: { dpi: 300, letterRendering: true, scale: 2 }, // Adjust the scale value
  jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
}).from(invoice).save();
</script>
@endpush

@push('modals')
@endpush
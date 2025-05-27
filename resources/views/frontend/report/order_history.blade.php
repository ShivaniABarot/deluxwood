@extends(backendView('layouts.app'))
@section('title', 'Payment')
@section('content')




<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Order History</h3>
				<!-- <a href="#" onclick="generatePDF(); return false;" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i> Download</a> -->
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3 mb-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
					<div class="border-0 mb-4">
						<form action="{{url('order-history')}}" method="POST">
							@csrf
						<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
							<div class="col-md-3 custom-search-row">
								<label class="form-label">Order No</label>
								<select class="form-control form-control-lg mb-2 form-select form-select-sm" name="customer_draft_id">
									<option value="">Please Select</option>
									@foreach($order_nu as $val)
									<option value="{{$val->customer_draft_id}}">Order No - {{$val->customer_draft_id}}</option>
									@endforeach
									
                                 </select>
								<span class="text-danger kt-form__help error customer_draft_id"></span>
						</div>
							<div class="col-md-3 custom-search-row">
								<label class="form-label">From</label> 
									<input type="date" class="form-control dt_cls" name="from_date" placeholder="Please enter group title">
								<span class="text-danger kt-form__help error from_date"></span>
						</div>
							<div class="col-md-3 custom-search-row">
								<label class="form-label">To</label>
								<input type="date" class="form-control dt_cls" name="to_date" placeholder="Please enter group title" >
								<span class="text-danger kt-form__help error to_date"></span>
						</div>
							<div class="col-md-2 custom-search-row">
							<button type="submit" class="btn btn-warning mt-4 text-uppercase px-5 sc_cls">Search</button>
						</div>
						</div>
						</form>
					</div>
				</div> 
					<table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
						<thead>
							<tr>
							
								<th>Order Number</th>
								<th>Order Date</th>
								<th>Bill-to name</th>
								<th>Total</th>
								<th>Track & trace number</th>
								<th style="display: none;"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($order_history as $val)
							<tr>
								<td><strong>{{$val->customer_draft_id}}</strong></td>
								<td>{{$val->created_at->format('d-m-Y') }}</td>
								<td>{{$val->customer_name}}</td>
								<td>${{$val->total_price}}</td>
								<td></td>
								
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<a href="{{url('sales-orders')}}/{{$val->customer_draft_id}}" class="vr_cls">View Details</a>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
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
    .vr_cls
    {
    	color: #dca53e;
    }
      .custom-search-row {
        
        align-items: center;
    }
    .custom-search-row label {
        margin-right: 10px; /* Adjust spacing between label and input */
    }
    .sc_cls
    {
/*    	margin-bottom: 30px;*/
    }
    .dt_cls
    {
    	min-width: 78%!important;
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
		}],
         order: [[0, 'desc']]
		});
</script>
<script type="text/javascript">
	  function generatePDF() {
    // Get the HTML content of the invoice
    const invoice = document.getElementById("myDataTable").innerHTML;

    html2pdf().set({
      margin: 1,
      filename: 'Order History.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { dpi: 192, letterRendering: true },
      jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    }).from(myDataTable).save();
 
 
  }
</script>
@endpush
@extends(backendView('layouts.app'))
@section('title', 'Payment')
@section('content')




<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Inventory Levels</h3>
				<a href="{{url('payment/create')}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i> Download</a>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
			
				<div class="card-body">
					<form action="" method="POST" id="paymentForm">
						
						<div class="row g-3 align-items-center pd_cls">
							<div class="col-md-3">
								<h6 class="form-label">Choose Product</h6>
							</div>
							<div class="col-md-4">
								
								<select class="form-control">
									
								   <option value="">Please Select</option>
									 @foreach($product as $val)
                                      <option value="">{{$val->product_name}}</option>
                                     @endforeach
								</select>
								<span class="text-danger kt-form__help error credit_card_number"></span>
						
							</div>
						</div>
						<div class="row g-3 align-items-center pt-20 pd_cls">
							<div class="col-md-3">
								<h6 class="form-label">Current Inventory</h6>
							</div>
							<div class="col-md-4">
								
								<input type="text" class="form-control" name="credit_card_number" readonly placeholder="Please enter group title">
								<span class="text-danger kt-form__help error credit_card_number"></span>
						
							</div>
						</div>
							<div class="row g-3 align-items-center pd_cls">
							<div class="col-md-3">
								<h6 class="form-label">Re-Order Point</h6>
							</div>
							<div class="col-md-4">
								
								<input type="text" class="form-control" name="credit_card_number" readonly placeholder="Please enter group title">
								<span class="text-danger kt-form__help error credit_card_number"></span>
						
							</div>
						</div>	<div class="row g-3 align-items-center pd_cls">
							<div class="col-md-3">
								<h6 class="form-label">Pending Purchase Quantity</h6>
							</div>
							<div class="col-md-4">
								
								<input type="text" class="form-control" name="credit_card_number" readonly placeholder="Please enter group title">
								<span class="text-danger kt-form__help error credit_card_number"></span>
						
							</div>
						</div>	<div class="row g-3 align-items-center pd_cls">
							<div class="col-md-3">
								<h6 class="form-label">Pending Sales Quantity</h6>
							</div>
							<div class="col-md-4">
								
								<input type="text" class="form-control" name="credit_card_number" readonly placeholder="Please enter group title">
								<span class="text-danger kt-form__help error credit_card_number"></span>
						
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!-- Row End -->
  <!-- Button trigger modal -->





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
     .custom-search-row {
        display: -webkit-box;
        align-items: center;
    }
    .custom-search-row h5 {
        margin-right: 10px; /* Adjust spacing between label and input */
    }
    .pd_cls
    {
    	padding-bottom: 15px;
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


@endpush
@extends(backendView('layouts.app'))
@section('title', "RMA's")
@section('content')

<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">RMA's</h3>
				<!-- <a href="{{url('payment/create')}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Add Card</a> -->
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
							
								<th>Image</th>
								<th>SKU</th>
								<th>Product Name</th>
								<th>Style</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($rma_data as $val)
							<tr>
								<td class="text-center">
									@if($val->image != null)
									<img src="{{asset('public/img/door_style/'.$val->image)}}" width="50px" height="50px">
									@else
									<p class="text-center">N/A</p>
									@endif
								</td>

								<td>{{$val->product_item_sku}}</td>
								<td data-bs-toggle="tooltip" data-bs-placement="top" title="{{$val->product_item_name}}">{{ Str::limit($val->product_item_name, 25) }}</td>
								<td>{{$val->name}}</td>
								<td class="text-danger"><b>{{$val->draft_status}}</b></td>
								<td><a href="{{url('replace')}}/{{$val->draft_product_id}}" class="btn btn-outline-warning yl_cls">Replace</a></td>
								
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
    .yl_cls
    {
    	color: #dca53e!important;
    }
   	.yl_cls:hover
   	{
   		color: #FFFFFF!important;
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
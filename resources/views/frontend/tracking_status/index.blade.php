@extends(backendView('layouts.app'))
@section('title', 'Tracking & Status')
@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Tracking & Status</h3>
					<div class="col-3">
                        <div class="mb-2">
                          <select class="form-control form-control-lg mb-2 form-select form-select-sm" name="draft_status" id="draft_status">
						    <option value="">Select Status</option>
						    <option value="Quotation">Quotation</option>
						    <option value="Inprogress"> In Progress</option>
						    <option value="Ready">Ready</option>
							<option value="In Production">In Production</option>
						    <option value="Delivered">Delivered</option>
						    <!-- <option value="Return">Return</option> -->
						  </select>
                            <span class="text-danger kt-form__help error state"></span>
                        </div>
                    </div>
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
								<th>Order Id</th>
								<th>PO Number</th>
								<th>Style</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody class="trackinglist">
							@foreach($tracking_data as $val)
							<tr>
								<td><strong>{{$val->customer_draft_id}}</strong></td>
								<td>{{$val->po_number}}</td>
								   <td>
							            @foreach(explode(',', $val->door_style_names) as $door_style_name)
							                {{ $door_style_name }}<br>
							            @endforeach
							        </td>
								<td>@if($val->draft_status == "Inprogress")
								<strong>{{"In Progress"}}</strong>
									@else	
									<strong>{{$val->draft_status}}</strong>
									@endif</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<a href="{{url('tracking-status\view')}}\{{$val->customer_draft_id}}" class="btn btn-outline-secondary"><i class="icofont-eye text-warning"></i></a>
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
<script>
$('#draft_status').change(function() {
    var draft_status = $(this).val();

    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "{{ url('tracking-status/fetch-style') }}",
        data: {
            "draft_status": draft_status,
            "_token": "{{ csrf_token() }}",
        },
        success: function(response) {
            var obj = JSON.parse(response);
            $('.trackinglist').html(obj.html);
        }
    });
});
</script>
@endpush
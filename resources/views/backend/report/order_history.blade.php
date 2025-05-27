@extends(backendView('layouts.app'))

@section('title', 'Order History')

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
						<form action="{{url('admin/order-history')}}" method="POST">
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
										<a href="{{url('admin/sales-performance')}}/{{$val->customer_draft_id}}" class="vr_cls">View Details</a>
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
<style type="text/css">
	   .vr_cls
    {
    	color: #ffd55d;
    }
</style>
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
@endpush

@push('modals')
@endpush
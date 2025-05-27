@extends(backendView('layouts.app'))

@section('title', 'Report')

@section('content')


<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Process Manage</h3>
				<a href="{{url('payment/create')}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i> Download</a>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3 mb-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<!-- <div class="p-4 active-user bg-lightblue rounded-2 mb-2 re_cls">
						<span class="fw-bold d-flex justify-content-center fs-3"><a class="hr_cls" href="{{url('sales-orders')}}">Sales Orders</a></span>
					</div> -->
					<div class="p-4 active-user bg-lightblue rounded-2 mb-2 re_cls">
						<span class="fw-bold d-flex justify-content-center fs-3"><a class="hr_cls" href="{{url('admin/order-history')}}">Order History</a></span>
					</div>
					<div class="p-4 active-user bg-lightblue rounded-2 mb-2 re_cls">
						<span class="fw-bold d-flex justify-content-center fs-3"><a class="hr_cls" href="{{url('admin/customer-list')}}">Customers List</a></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
  <!-- Button trigger modal -->

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
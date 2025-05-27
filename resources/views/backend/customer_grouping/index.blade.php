@extends(backendView('layouts.app'))

@section('title', 'Customer Group List')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Customer Grouping List</h3>
				<!-- <a href="{{url('admin/customer-group/create')}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Add Customer Group</a> -->
				<!-- <div class="col-4">
				    <p style="float: right;"><b>Sort</b></p>
				</div> -->
				<div class="col-3">
                        <div class="mb-2">
                            
                            <select class="form-control form-control-lg mb-2 form-select form-select-sm"  name="customer_group_id"  id="customer_group" >

                                <option value="">Please Select Group Type</option>
                                 @foreach($customer_group_type as $val)
                                       <option value="{{ $val->group_title}}">{{$val->group_title}}</option>
                                       <!-- <option value="{{ $val->customer_group_id}}">{{$val->group_title}}</option> -->
                                   @endforeach
                            </select>
                           
                            <span class="text-danger kt-form__help error state"></span>
                        </div>
                    </div>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="flash-message-container">
                         @if(session('success'))
                             <div class="flash-message">{{ session('success') }}</div>
                         @endif
                         @if (session('error'))
                         <div class="flash-message-error">{{ session('error') }}</div>
                         @endif
                     </div>
	<div class="row g-3 mb-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
						<thead>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Email</th>
								<th>Contact</th>
								<th>Group Type</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody class="testlist">
							@foreach($customers_data as $val)
						    <tr>
						        <td><strong>{{$val->customer_id}}</strong></td>
						        <td><a target="_blank" href="{{url('admin/customer-view')}}/{{$val->customer_id}}">
						            {{$val->company_name}}
						            </a>
						        </td>
						        <td>{{$val->email}}</td>
						        <td>{{$val->contact_number}}</td>
						        <td><strong>{{$val->group_title}}</strong></td>
						        <td>
						            <div class="btn-group" role="group" aria-label="Basic outlined example">
						                <a href="{{url('admin/customer-grouping/edit')}}/{{$val->customer_id}}" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
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
  <!-- Button trigger modal -->
    

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLive" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Customer Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Record ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-warning" id="yes">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
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
	.flash-message-container {
    position: fixed;
    top: 195px!important;
    right: 40px;
    z-index: 9999;
}

</style>
@endpush

@push('scripts')
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
@endpush

@push('custom_scripts')
<script>
     var table = $('#myDataTable').DataTable({
            responsive: true,
            columnDefs: [{
                targets: [-1, -3],
                className: 'dt-body-right'
            }],
            order: [[0, 'desc']]
        });
        $('#customer_group').on('change', function() {
         var customer_group = $(this).val();
         console.log(customer_group);
         table.column(4).search(customer_group).draw();
         
        });
	// $('#myDataTable')
	// 	.addClass('nowrap')
	// 	.dataTable({
	// 		responsive: true,
	// 		columnDefs: [{
	// 			targets: [-1, -3],
	// 			className: 'dt-body-right'
	// 		}],
	// 		  order: [[0, 'desc']]
	// 	});
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
//   $('#customer_group').change(function(){ 
//             var customer_group = $('#customer_group').find(":selected").val();
//             var customer_group = $('#customer_group').val();
           
//             $.ajax({
//                 type: "POST",
//                 dataType: 'html',
//                 url: "{{ url('admin/customer-grouping/fetch-customers') }}",
//                 data: {
//                     "customer_group":customer_group,
                  
//                     "_token": "{{ csrf_token() }}",
//                 },
                
//                 success: function (response) {
                    
//                  var obj = JSON.parse(response);
//                  $('.testlist').html(obj.html);
//                  // $('#myDataTable').DataTable();
                  
//                 }
//             });

//         });
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
             }
         });
     });
   }
</script>
@endpush

@push('modals')
@endpush
@extends(backendView('layouts.app'))

@section('title', 'Customers')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Customers Information</h3>
				@if( Auth::user()->role_id == 1)
				<div class="col-auto d-flex w-sm-100">
					<a href="{{url('admin/customer-create')}}" class="btn btn-dark btn-set-task w-sm-100" ><i class="icofont-plus-circle me-2 fs-6"></i>Add Customers</a>
				</div>
				@endif
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
   
	<div class="row clearfix g-3">
		<div class="col-sm-12">
			<div class="card mb-3">
				<div class="card-body">
					<table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                    <thead>
							<tr>
								<th>Dealer Number</th>
								<th>Company Name</th>
								<th>Email </th>
								<th>Contact</th>
								@if( Auth::user()->role_id == 1)
								<th>Status</th>
								@endif
								<th>Actions</th>
							
							</tr>
						</thead>
						<tbody>
                            @foreach($customers as $customer)
							<tr> 
							<td>{{$customer->dealer_number}}</td>
								<td><a target="_blank" href="{{url('admin\customer-view')}}\{{$customer->customer_id}}">
                                    {{$customer->company_name}}
                                    </a>
								</td>
								<td>
                                {{$customer->email}}
								</td>
								<td>{{$customer->contact_number}}</td>
								@if( Auth::user()->role_id == 1)
								<td>
                                    @if($customer->status == "Active")
									  <span class="badge bg-success">Active</span>
									@elseif($customer->status == "Pending")
									  <span class="badge bg-warning">Pending</span>
									@else
									  <span class="badge bg-danger">Inactive</span>
									@endif
                                </td>
								@endif
							
								<td>
							
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										@if( Auth::user()->role_id == 1)
											<a type="button" class="btn btn-outline-secondary" href="{{url('admin\customer-view')}}\{{$customer->customer_id}}" ><i class="icofont-eye text-warning"></i></a>
											<a type="button" class="btn btn-outline-secondary" href="{{url('admin\customer-edit')}}\{{$customer->customer_id}}" ><i class="icofont-edit text-success"></i></a>
											<a href="javascript:void(0)" onclick="deleteModal('{{$customer->customer_id}}');" class="btn btn-outline-secondary"><i class="icofont-ui-delete text-danger"></i></a>
										@else
									
											<a class="btn btn-dark btn-set-task w-sm-100" href="{{url('agent/process-manage/')}}\{{$customer->user_id}}" >Orders</a>
										@endif
									</div>
								</td>
							
							</tr>
							@endforeach
						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!-- Row End -->
</div>
@endsection

@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
@endpush

@push('custom_styles')
@endpush

@push('scripts')
<!-- Plugin Js-->
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
@endpush

@push('custom_scripts')
<script>
	// project data table
	$(document).ready(function() {
		$('#myProjectTable')
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
             url: "{{ url('admin/customer/delete') }}"+'/'+id,
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
<!-- Add Customers-->
<!-- <div class="modal fade" id="expadd" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="expaddLabel">Add Customers</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="deadline-form">
                <form>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-12">
                            <label for="item" class="form-label">Customers Name</label>
                            <input type="text" class="form-control" id="item">
                        </div>
                        <div class="col-sm-12">
                            <label for="taxtno" class="form-label">Customers Profile</label>
                            <input type="File" class="form-control" id="taxtno">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="depone" class="form-label">Country</label>
                            <input type="text" class="form-control" id="depone">
                        </div>
                        <div class="col-sm-6">
                            <label for="abc" class="form-label">Customers Register date</label>
                            <input type="date" class="form-control w-100" id="abc">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="abc11" class="form-label">Mail</label>
                            <input type="text" class="form-control" id="abc11">
                        </div>
                        <div class="col-sm-6">
                            <label for="abc111" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="abc111">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-12">
                            <label class="form-label">Total Order</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                </form>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </div>
</div>
</div> -->

<!-- Edit Customers-->

 <!-- Modal -->
 <div class="modal fade" id="exampleModalLive" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this customer ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-primary" id="yes">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
<!-- <div class="modal fade" id="expedit" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title  fw-bold" id="expeditLabel"> Edit Customers</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<div class="deadline-form">
					<form>
                        
						<div class="row g-3 mb-3">
							<div class="col-sm-12">
								<label for="item1" class="form-label">Customers Name</label>
								<input type="text" class="form-control" id="item1" value="Cloth">
							</div>
							<div class="col-sm-12">
								<label for="taxtno1" class="form-label">Customers Profile</label>
								<input type="file" class="form-control" id="taxtno1">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label class="form-label">Country</label>
								<input type="text" class="form-control" value="South Africa">
							</div>
							<div class="col-sm-6">
								<label for="abc1" class="form-label">Customers Register date</label>
								<input type="date" class="form-control w-100" id="abc1" value="2021-03-12">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label for="mailid" class="form-label">Mail</label>
								<input type="text" class="form-control" id="mailid" value="PhilGlover@gmail.com">
							</div>
							<div class="col-sm-6">
								<label for="phoneid" class="form-label">Phone</label>
								<input type="text" class="form-control" id="phoneid" value="843-555-0175">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label class="form-label">Total Order</label>
								<input type="text" class="form-control" value="18">
							</div>
						</div>
					</form>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div> -->
@endpush
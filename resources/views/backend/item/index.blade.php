@extends(backendView('layouts.app'))

@section('title', 'Item List')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Item List</h3>
				<a href="{{url('admin/item-add')}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Add Item</a>
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
							 	<th class="hidden-element">No.</th>
								<th>SKU</th>
								<th >Product Name</th>
								<th>Quantity</th>
                                <th>Category</th>
								<!-- <th>Door Style</th> -->
								<th>Availability</th>
								<th>Basic Price</th>
							    <th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							
						@foreach($product as $data)
							<tr>
								<td >{{$data->product_id}}</td>
								<td>{{$data->product_item_sku}}</td>

								<td data-bs-toggle="tooltip" data-bs-placement="top" title="{{$data->product_name}}">{{ Str::limit($data->product_name, 30) }}</td>
								<td>{{$data->inventory_quantity}}</td>
								
								<td>{{$data->title}}</td>
                              <!--   <td> 
								@php $door_style=  DB::table('product_door_style')->select('product_door_style.*','door_style.name')
                                                  ->leftjoin('door_style','door_style.doorStyle_id','product_door_style.door_style_id')->where('product_id',$data->product_id)->get();
								@endphp
								@foreach($door_style as $door_style)
                                {{$door_style->name}} <br>
								@endforeach
								</td> -->
								<td>{{$data->availability}}</td>
								<td>{{$data->product_item_price}}</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
									<a type="button" class="btn btn-outline-secondary" href="{{url('admin\item-view')}}\{{$data->product_id}}" ><i class="icofont-eye text-warning"></i></a>
									<a href="{{url('admin/item-edit')}}/{{$data->product_id}}" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
									<a href="javascript:void(0)" onclick="deleteModal('{{$data->product_id}}');" class="btn btn-outline-secondary"><i class="icofont-trash text-danger"></i></a>
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
<style>
#myDataTable tbody tr:hover {
            cursor: pointer; /* Change to the desired cursor style */
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
             url: "{{ url('admin/item/delete') }}"+'/'+id,
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
<!-- Modal -->
<div class="modal fade" id="exampleModalLive" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-warning" id="yes">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endpush
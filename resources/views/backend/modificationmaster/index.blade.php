@extends(backendView('layouts.app'))

@section('title', 'Modification')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Modification Information</h3>
				<div class="col-auto d-flex w-sm-100">
					<a href="{{url('admin/modification/create')}}" class="btn btn-primary btn-set-task w-sm-100" ><i class="icofont-plus-circle me-2 fs-6"></i>Add </a>
				</div>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		<div class="col-sm-12">
			<div class="card mb-3">
				<div class="card-body">
					<table id="example1" class="table table-hover align-middle mb-0" style="width:100%">
                    <thead>
							<tr>
								<th>Id</th>
								<th>Finish Side</th>
								<th>Hinge Side</th>
								<th>Depth</th>
								<th>Inch</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($modification as $data)

                            <tr>
                                <td>
                                    {{$data->modification_id}}
                                 </td>
                                 <td>
                                 {{$data->choose_finish }}
                                 </td>
                                 <td>
                                 {{$data->choose_hinge}}
                                 </td>
                                 <td>
                                 {{$data->depth_cabinet}}
                                 </td>
                                 <td>
                                 {{$data->depth_inch1}}
                                 {{$data->modification_id}}
                                 </td>
                                 <td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
									<a  href="javascript:void(0)" onclick="deleteModal('{{$data->modification_id}}')" class="btn btn-outline-secondary"><i class="icofont-ui-delete text-danger"></i></a>
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
<!-- <script>
      function deleteData(dt) {
        if (confirm("Are you sure you want to delete this data?")) {
          $.ajax({
            type: 'DELETE',
            url: $(dt).data("url"),
            data: {
              "_token": "{{ csrf_token() }}"
            },
            success: function (response) {
              if (response.status) {
                location.reload();
              }
            },
            error: function (response) {
              console.log(response);
            }
          });
        }
        return false;
      }
    </script> -->


<script>
	// project data table
	$(document).ready(function() {
		$('#example1')
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
             url: "{{ url('admin/modification/delete') }}"+'/'+id,
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

 <div class="modal fade" id="exampleModalLive" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Modification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Record ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-primary" id="yes">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>


@endpush
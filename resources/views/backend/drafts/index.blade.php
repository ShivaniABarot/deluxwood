@extends(backendView('layouts.app'))

@section('title', 'Drafts')

@section('content')
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div
					class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="fw-bold mb-0">Drafts </h3>
					<div class="col-auto d-flex w-sm-100">
						<!-- <a href="{{url('admin/drafts-add')}}" class="btn btn-dark btn-set-task w-sm-100"><i
								class="icofont-plus-circle me-2 fs-6"></i>Add Draft</a> -->
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

		<div class="row clearfix g-3">
			<div class="col-sm-12">
				<div class="card mb-3">
					<div class="card-body">
						<table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
							<thead>
								<tr>
									<th>Draft</th>
									<th>Customer Name</th>
									<th>PO Number</th>
									<th>Style</th>
									<th>Total</th>
									<th>Date</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($Drafts as $draft)
									<tr>
										<td>{{ $draft->customer_draft_id }}</td>
										<td>{{ $draft->customer_name }}</td>
										<td>{{ $draft->po_number }}</td>
										<td>{{ $draft->door_style }}</td>
										<td>${{ number_format($draft->original_price, 2) }}</td>
										<td>{{ optional($draft->created_at)->format('m-d-Y') ?? 'N/A' }}</td>
										<td>
											<div class="btn-group" role="group" aria-label="Basic outlined example">
											<a type="button" class="btn btn-outline-secondary" href="{{ route('admin.draft.view', $draft->customer_draft_id) }}">
    <i class="icofont-eye text-warning"></i>
</a>


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
		$(document).ready(function () {
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
			$('.deleterow').on('click', function () {
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
		
	</script>
@endpush

@push('modals')
	
	
@endpush
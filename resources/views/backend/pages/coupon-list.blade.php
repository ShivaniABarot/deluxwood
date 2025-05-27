@extends(backendView('layouts.app'))

@section('title', 'Coupons List')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Coupons</h3>
				<div class="col-auto d-flex w-sm-100">
					<a href="{!! backendRoutePut('coupon-add') !!}" class="btn btn-primary btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i>Add Coupons</a>
				</div>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		<div class="col-sm-12">
			<div class="card mb-3">
				<div class="card-body">
					<table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
						<thead>
							<tr>
								<th>Coupons Code</th>
								<th>Type</th>
								<th>Discount</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Status</th>
								<th>Discount Country</th>
								<th>Discount Product</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><span class="fw-bold ms-1">DTZQT-8547</span></td>
								<td>Fixed Amount</td>
								<td>$12.6</td>
								<td>18/08/2021</td>
								<td>06/09/2021</td>
								<td><span class="badge bg-success">Active</span></td>
								<td>South Africa</td>
								<td>Clothes</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<a href="{!! backendRoutePut('coupon-edit') !!}" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="fw-bold ms-1">AXXQT-2547</span></td>
								<td>Percentage</td>
								<td>20%</td>
								<td>08/03/2021</td>
								<td>30/03/2021</td>
								<td><span class="badge bg-danger">In Active</span></td>
								<td>India</td>
								<td>Watches</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<a href="{!! backendRoutePut('coupon-edit') !!}" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="fw-bold ms-1">FiFty-50%</span></td>
								<td>Percentage</td>
								<td>50%</td>
								<td>08/03/2021</td>
								<td>30/03/2021</td>
								<td><span class="badge bg-warning">Future Plann</span></td>
								<td>India</td>
								<td>Toy</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<a href="{!! backendRoutePut('coupon-edit') !!}" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="fw-bold ms-1">BATTT-XA47</span></td>
								<td>Fixed Amount</td>
								<td>$18.00</td>
								<td>06/05/2021</td>
								<td>06/09/2021</td>
								<td><span class="badge bg-success">Active</span></td>
								<td>Oman</td>
								<td>Shoes</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<a href="{!! backendRoutePut('coupon-edit') !!}" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="fw-bold ms-1">FALT-40</span></td>
								<td>Percentage</td>
								<td>18%</td>
								<td>16/04/2021</td>
								<td>06/09/2021</td>
								<td><span class="badge bg-success">Active</span></td>
								<td>Oman</td>
								<td>Shoes</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<a href="{!! backendRoutePut('coupon-edit') !!}" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="fw-bold ms-1">SHIP-ZERO</span></td>
								<td>Free shipping</td>
								<td>$0.0</td>
								<td>12/05/2021</td>
								<td>06/10/2021</td>
								<td><span class="badge bg-success">Active</span></td>
								<td>Denmark</td>
								<td>Cream Tube</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<a href="{!! backendRoutePut('coupon-edit') !!}" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
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
				}]
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
@endpush

@push('modals')
@endpush
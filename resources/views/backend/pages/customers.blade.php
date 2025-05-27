@extends(backendView('layouts.app'))

@section('title', 'Customers')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Customers Information</h3>
				<div class="col-auto d-flex w-sm-100">
					<button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Customers</button>
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
								<th>Id</th>
								<th>Customers</th>
								<th>Register Date</th>
								<th>Mail</th>
								<th>Phone</th>
								<th>Country</th>
								<th>Total Order</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><strong>#CS-00002</strong></td>
								<td>
									<a href="{!! backendRoutePut('customer-detail') !!}">
										<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar1.svg') !!}" alt="">
										<span class="fw-bold ms-1">Joan Dyer</span>
									</a>
								</td>
								<td>
									12/03/2021
								</td>
								<td>JoanDyer@gmail.com</td>
								<td>202-555-0983</td>
								<td>South Africa</td>
								<td>18</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>#CS-00006</strong></td>
								<td>
									<a href="{!! backendRoutePut('customer-detail') !!}">
										<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar2.svg') !!}" alt="">
										<span class="fw-bold ms-1">Ryan Randall</span>
									</a>
								</td>
								<td>
									12/03/2021
								</td>
								<td>RyanRandall@gmail.com</td>
								<td>303-555-0151</td>
								<td>Australia</td>
								<td>4568</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>#CS-00004</strong></td>
								<td>
									<a href="{!! backendRoutePut('customer-detail') !!}">
										<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar3.svg') !!}" alt="">
										<span class="fw-bold ms-1">Phil Glover</span>
									</a>
								</td>
								<td>
									16/03/2021
								</td>
								<td>PhilGlover@gmail.com</td>
								<td>843-555-0175</td>
								<td>Sri Lanka</td>
								<td>05</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>#CS-00008</strong></td>
								<td>
									<a href="{!! backendRoutePut('customer-detail') !!}">
										<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar4.svg') !!}" alt="">
										<span class="fw-bold ms-1">Victor Rampling</span>
									</a>
								</td>
								<td>
									25/02/2021
								</td>
								<td>VictorRampling@gmail.com</td>
								<td>404-555-0100</td>
								<td>Israel</td>
								<td>14</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>#CS-00018</strong></td>
								<td>
									<a href="{!! backendRoutePut('customer-detail') !!}">
										<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar5.svg') !!}" alt="">
										<span class="fw-bold ms-1">Sally Graham</span>
									</a>
								</td>
								<td>
									16/02/2021
								</td>
								<td>SallyGraham@gmail.com</td>
								<td>502-555-0118</td>
								<td>Indonesia</td>
								<td>03</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>#CS-00014</strong></td>
								<td>
									<a href="{!! backendRoutePut('customer-detail') !!}">
										<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar6.svg') !!}" alt="">
										<span class="fw-bold ms-1">Robert Anderson</span>
									</a>
								</td>
								<td>
									18/01/2021
								</td>
								<td>RobertAnderson@gmail.com</td>
								<td>502-555-0133</td>
								<td>Malaysia</td>
								<td>02</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
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
<!-- Add Customers-->
<div class="modal fade" id="expadd" tabindex="-1" aria-hidden="true">
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
</div>

<!-- Edit Customers-->
<div class="modal fade" id="expedit" tabindex="-1" aria-hidden="true">
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
</div>
@endpush
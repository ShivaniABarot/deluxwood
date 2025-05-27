@extends(backendView('layouts.app'))

@section('title', 'Suppliers Information')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Suppliers Information</h3>
				<div class="col-auto d-flex w-sm-100">
					<button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Suppliers</button>
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
								<th>Items</th>
								<th>Suppliers</th>
								<th>Suppliers Regdate</th>
								<th>Mail</th>
								<th>Phone</th>
								<th>Address</th>
								<th>Tax No</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><strong>#SP-00002</strong></td>
								<td>Cloth </td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar1.svg') !!}" alt="">
									<span class="fw-bold ms-1">Joan Dyer</span>
								</td>
								<td>
									12/03/2021
								</td>
								<td>JoanDyer@gmail.com</td>
								<td>202-555-0983</td>
								<td>70 Bowman St. South Windsor, CT 06074</td>
								<td>5869</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>#SP-00006</strong></td>
								<td>Shoes</td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar2.svg') !!}" alt="">
									<span class="fw-bold ms-1">Ryan Randall</span>
								</td>
								<td>
									12/03/2021
								</td>
								<td>RyanRandall@gmail.com</td>
								<td>303-555-0151</td>
								<td>123 6th St. Melbourne, FL 32904</td>
								<td>4568</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>#SP-00004</strong></td>
								<td>Cycle</td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar3.svg') !!}" alt="">
									<span class="fw-bold ms-1">Phil Glover</span>
								</td>
								<td>
									16/03/2021
								</td>
								<td>PhilGlover@gmail.com</td>
								<td>843-555-0175</td>
								<td>4 Shirley Ave. West Chicago, IL 60185</td>
								<td>4659</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>#SP-00011</strong></td>
								<td>Oil</td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar4.svg') !!}" alt="">
									<span class="fw-bold ms-1">Victor Rampling</span>
								</td>
								<td>
									25/02/2021
								</td>
								<td>VictorRampling@gmail.com</td>
								<td>404-555-0100</td>
								<td>123 6th St. Melbourne, FL 32904</td>
								<td>2567</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>#SP-00018</strong></td>
								<td>Watch</td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar5.svg') !!}" alt="">
									<span class="fw-bold ms-1">Sally Graham</span>
								</td>
								<td>
									16/02/2021
								</td>
								<td>SallyGraham@gmail.com</td>
								<td>502-555-0118</td>
								<td>4 Shirley Ave. West Chicago, IL 60185</td>
								<td>7586</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>#SP-00014</strong></td>
								<td>Sunglasses</td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar6.svg') !!}" alt="">
									<span class="fw-bold ms-1">Robert Anderson</span>
								</td>
								<td>
									18/01/2021
								</td>
								<td>RobertAnderson@gmail.com</td>
								<td>502-555-0133</td>
								<td>123 6th St. Melbourne, FL 32904</td>
								<td>6584</td>
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
<!-- Add Expence-->
<div class="modal fade" id="expadd" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title  fw-bold" id="expaddLabel">Add Suppliers</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="deadline-form">
					<form>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label for="item" class="form-label">Item</label>
								<input type="text" class="form-control" id="item">
							</div>
							<div class="col-sm-6">
								<label for="taxtno" class="form-label">Tax No</label>
								<input type="text" class="form-control" id="taxtno">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label for="depone" class="form-label">Suppliers</label>
								<input type="text" class="form-control" id="depone">
							</div>
							<div class="col-sm-6">
								<label for="abc" class="form-label">Suppliers Register date</label>
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
								<label class="form-label">Address</label>
								<textarea class="form-control" rows="3"></textarea>
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

<!-- Edit Expence-->
<div class="modal fade" id="expedit" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title  fw-bold" id="expeditLabel"> Edit Suppliers</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<div class="deadline-form">
					<form>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label for="item1" class="form-label">Item</label>
								<input type="text" class="form-control" id="item1" value="Cloth">
							</div>
							<div class="col-sm-6">
								<label for="taxtno1" class="form-label">Tax No</label>
								<input type="text" class="form-control" id="taxtno1" value="5869">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label class="form-label">Suppliers</label>
								<select class="form-select">
									<option selected>Joan Dyer</option>
									<option value="1">Ryan Randall</option>
									<option value="2">Phil Glover</option>
									<option value="3">Victor Rampling</option>
									<option value="4">Sally Graham</option>
								</select>
							</div>
							<div class="col-sm-6">
								<label for="abc1" class="form-label">Suppliers Register date</label>
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
							<div class="col-sm-12">
								<label class="form-label">Address</label>
								<textarea class="form-control" rows="3">4 Shirley Ave. West Chicago, IL 60185</textarea>
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
@extends(backendView('layouts.app'))

@section('title', 'Company Expense')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">eBazar Expense</h3>
				<div class="col-auto d-flex w-sm-100">
					<button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Expenses</button>
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
								<th>Exp Id</th>
								<th>Exp Item</th>
								<th>Exp Order By</th>
								<th>Date</th>
								<th>From</th>
								<th>Amount</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<strong>#EX-00002</strong>
								</td>
								<td>
									Mortgage Payments
								</td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar1.svg') !!}" alt="">
									<span class="fw-bold ms-1">Joan Dyer</span>
								</td>
								<td>
									12/05/2021
								</td>
								<td>Office Owner</td>
								<td>$50000</td>
								<td><span class="badge bg-warning">In Progress</span></td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<strong>#EX-00006</strong>
								</td>
								<td>
									Business Insurance
								</td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar2.svg') !!}" alt="">
									<span class="fw-bold ms-1">Ryan Randall</span>
								</td>
								<td>
									12/04/2021
								</td>
								<td>Insurance Company</td>
								<td>$20000</td>
								<td><span class="badge bg-warning">In Progress</span></td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<strong>#EX-00004</strong>
								</td>
								<td>
									Taxes
								</td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar3.svg') !!}" alt="">
									<span class="fw-bold ms-1">Phil Glover</span>
								</td>
								<td>
									16/04/2021
								</td>
								<td>Goverment</td>
								<td>$125897</td>
								<td><span class="badge bg-warning">In Progress</span></td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<strong>#EX-00011</strong>
								</td>
								<td>
									Advertising and marketing
								</td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar4.svg') !!}" alt="">
									<span class="fw-bold ms-1">Victor Rampling</span>
								</td>
								<td>
									25/03/2021
								</td>
								<td>Marketing Company</td>
								<td>$6000</td>
								<td><span class="badge bg-success">Completed</span></td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<strong>#EX-00018</strong>
								</td>
								<td>
									Office equipment.
								</td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar5.svg') !!}" alt="">
									<span class="fw-bold ms-1">Sally Graham</span>
								</td>
								<td>
									16/03/2021
								</td>
								<td>Suppliers</td>
								<td>$1500</td>
								<td><span class="badge bg-success">Completed</span></td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
										<button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<strong>#EX-00014</strong>
								</td>
								<td>
									Salary
								</td>
								<td>
									<img class="avatar rounded" src="{!! backendAssets('dist/assets/images/xs/avatar6.svg') !!}" alt="">
									<span class="fw-bold ms-1">Robert Anderson</span>
								</td>
								<td>
									01/05/2021
								</td>
								<td>Company Saff</td>
								<td>$60000</td>
								<td><span class="badge bg-success">Completed</span></td>
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
				<h5 class="modal-title  fw-bold" id="expaddLabel"> Add Expenses</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="deadline-form">
					<form>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label for="item" class="form-label">Exp Item</label>
								<input type="text" class="form-control" id="item">
							</div>
							<div class="col-sm-6">
								<label for="amount" class="form-label">Amount</label>
								<input type="text" class="form-control" id="amount">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label for="depone" class="form-label">Exp Order By</label>
								<input type="text" class="form-control" id="depone">
							</div>
							<div class="col-sm-6">
								<label for="abc" class="form-label">Date</label>
								<input type="date" class="form-control w-100" id="abc">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label for="deptwo" class="form-label">From</label>
								<input type="text" class="form-control" id="deptwo">
							</div>
							<div class="col-sm-6">
								<label class="form-label">Status</label>
								<select class="form-select">
									<option selected>In Progress</option>
									<option value="1">Completed</option>
									<option value="2">Wating</option>
									<option value="3">Decline</option>
								</select>
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
				<h5 class="modal-title  fw-bold" id="expeditLabel"> Edit Expenses</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="deadline-form">
					<form>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label for="item1" class="form-label">Exp Item</label>
								<input type="text" class="form-control" id="item1" value="Mortgage Payments">
							</div>
							<div class="col-sm-6">
								<label for="amount1" class="form-label">Amount</label>
								<input type="text" class="form-control" id="amount1" value="$50000">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label class="form-label">Exp Order By</label>
								<select class="form-select">
									<option selected>Joan Dyer</option>
									<option value="1">Ryan Randall</option>
									<option value="2">Phil Glover</option>
									<option value="3">Victor Rampling</option>
									<option value="4">Sally Graham</option>
								</select>
							</div>
							<div class="col-sm-6">
								<label for="abc1" class="form-label">Date</label>
								<input type="date" class="form-control w-100" id="abc1" value="2021-05-12">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label for="deptwo1" class="form-label">From</label>
								<input type="text" class="form-control" id="deptwo1" value="Office Owner">
							</div>
							<div class="col-sm-6">
								<label class="form-label">Status</label>
								<select class="form-select">
									<option selected>In Progress</option>
									<option value="1">Completed</option>
									<option value="2">Wating</option>
									<option value="3">Decline</option>
								</select>
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
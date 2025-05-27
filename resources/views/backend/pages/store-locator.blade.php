@extends(backendView('layouts.app'))

@section('title', 'Store Locator')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Store Locator</h3>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
		<div class="col">
			<div class="alert-success alert mb-0">
				<div class="d-flex align-items-center">
					<div class="avatar rounded no-thumbnail bg-success text-light"><i class="icofont-cart-alt fs-5"></i></div>
					<div class="flex-fill ms-3 text-truncate">
						<div class="h6 mb-0">Open Store</div>
						<span class="small">1025</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="alert-danger alert mb-0">
				<div class="d-flex align-items-center">
					<div class="avatar rounded no-thumbnail bg-danger text-light"><i class="icofont-star-alt-1 fs-5"></i></div>
					<div class="flex-fill ms-3 text-truncate">
						<div class="h6 mb-0">New Store</div>
						<span class="small">701</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="alert-warning alert mb-0">
				<div class="d-flex align-items-center">
					<div class="avatar rounded no-thumbnail bg-warning text-light"><i class="icofont-spinner-alt-5 fs-5"></i></div>
					<div class="flex-fill ms-3 text-truncate">
						<div class="h6 mb-0">Proceed Store</div>
						<span class="small">142</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="alert-info alert mb-0">
				<div class="d-flex align-items-center">
					<div class="avatar rounded no-thumbnail bg-info text-light"><i class="icofont-verification-check fs-5"></i></div>
					<div class="flex-fill ms-3 text-truncate">
						<div class="h6 mb-0">Completed Enquiry</div>
						<span class="small">2000</span>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3 mb-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div id="googleMap" style="width:100%;height:600px;"></div>
				</div>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3 mb-3 row-deck">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Find Location</h6>
				</div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label">Name</label>
						<input type="text" class="form-control">
					</div>
					<div class="mb-3">
						<label class="form-label">Address</label>
						<input type="text" class="form-control">
					</div>
					<div class="mb-3">
						<label class="form-label">Country</label>
						<select class="form-select" aria-label="Default select example">
							<option selected>Select Country</option>
							<option value="1">India</option>
							<option value="2">Usa</option>
							<option value="3">Italy</option>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">City</label>
						<select class="form-select" aria-label="Default select example">
							<option selected>Select City</option>
							<option value="1"> Albany </option>
							<option value="2"> Allen </option>
							<option value="3"> Burbank </option>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Zipcode</label>
						<input type="text" class="form-control">
					</div>
					<div class="mb-3">
						<label class="form-label">Geocoded</label>
						<input type="text" class="form-control">
					</div>
					<div class="mb-3">
						<button type="button" class="btn btn-primary text-uppercase px-4">Search Loaction</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Add Store</h6>
				</div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label">Name</label>
						<input type="text" class="form-control">
					</div>
					<div class="mb-3">
						<label class="form-label">Geocoded</label>
						<input type="text" class="form-control">
					</div>
					<div class="mb-3">
						<label class="form-label">Address</label>
						<input type="text" class="form-control">
					</div>
					<div class="mb-3">
						<label class="form-label">Phone</label>
						<input type="text" class="form-control">
					</div>
					<div class="mb-3">
						<label class="form-label">Email</label>
						<input type="email" class="form-control">
					</div>
					<div class="mb-3">
						<label class="form-label">URL</label>
						<div class="input-group mb-3">
							<span class="input-group-text">https://eBazar.com/location/</span>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="mb-3">
						<button type="button" class="btn btn-primary text-uppercase px-5">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3 mb-3">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Stores Data</h6>
					<button type="button" class="btn btn-primary">Import Stores (CSV)</button>
				</div>
				<div class="card-body">
					<table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
						<thead>
							<tr>
								<th>Name</th>
								<th>Geocoded</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Url</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>ZBuy</td>
								<td>72.585022</td>
								<td>123 6th St. Melbourne, FL 32904</td>
								<td>9856547521</td>
								<td>ZBuy@gmail.com</td>
								<td>https://eBazar.com/location/2LH9OC</td>
							</tr>
							<tr>
								<td>ShopyZip</td>
								<td>12.585022</td>
								<td>4 Shirley Ave. West Chicago, IL 60185</td>
								<td>6856547521</td>
								<td>ShopyZip@gmail.com</td>
								<td>https://eBazar.com/location/1LH9OC</td>
							</tr>
							<tr>
								<td>Viaanmarket</td>
								<td>24.585022</td>
								<td>123 6th St. Melbourne, FL 32904</td>
								<td>5856547521</td>
								<td>Viaanmarket@gmail.com</td>
								<td>https://eBazar.com/location/2LH9OC</td>
							</tr>
							<tr>
								<td>Generanshop</td>
								<td>78.585022</td>
								<td>4 Shirley Ave. West Chicago, IL 60185</td>
								<td>4856547521</td>
								<td>Generanshop@gmail.com</td>
								<td>https://eBazar.com/location/11H9OC</td>
							</tr>
							<tr>
								<td>Bitstore</td>
								<td>22.585022</td>
								<td>70 Bowman St. South Windsor, CT 06074</td>
								<td>8856547521</td>
								<td>Bitstore@gmail.com</td>
								<td>https://eBazar.com/location/14H9OC</td>
							</tr>
							<tr>
								<td>Zcross</td>
								<td>32.585022</td>
								<td>170 Wowman St. South Windsor, CT 06074</td>
								<td>2256547521</td>
								<td>Zcross@gmail.com</td>
								<td>https://eBazar.com/location/15L9OC</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div> <!-- Row end  -->
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
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/js/page/google.js') !!}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&callback=myMap"></script>
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
				}]
			});
	</script>
@endpush

@push('modals')
@endpush
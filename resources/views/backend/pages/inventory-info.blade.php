@extends(backendView('layouts.app'))

@section('title', 'Stock Inventory List')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Stock Inventory List</h3>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3 mb-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
						<thead>
							<tr>
								<th>Id</th>
								<th>Products</th>
								<th>Category</th>
								<th>Date Added</th>
								<th>Stock</th>
								<th>In Stock</th>
								<th>Color</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><strong>#SKUN111</strong></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-1.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span> Oculus VR </span></td>
								<td>Game accessories</td>
								<td>June 13, 2021</td>
								<td>1455</td>
								<td>
									451
								</td>
								<td>Yellow</td>
								<td><span class="badge bg-warning">Offer process</span></td>
							</tr>
							<tr>
								<td><strong>#SKUN112</strong></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-2.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Wall Clock</span></td>
								<td>Clock</td>
								<td>June 22, 2021</td>
								<td>5555</td>
								<td>
									1451
								</td>
								<td>Gold</td>
								<td><span class="badge bg-success">Sell</span></td>
							</tr>
							<tr>
								<td><strong>#SKUN113</strong></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-3.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Flower Port</span></td>
								<td>accessories</td>
								<td>June 16, 2021</td>
								<td>555</td>
								<td>
									11
								</td>
								<td>Silver</td>
								<td><span class="badge bg-success">Sell</span></td>
							</tr>
							<tr>
								<td><strong>#SKUN114</strong></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-4.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Flower Port</span></td>
								<td>Port Box</td>
								<td>June 23, 2021</td>
								<td>7581</td>
								<td>
									2468
								</td>
								<td>Brown</td>
								<td><span class="badge bg-warning">Offer process</span></td>
							</tr>
							<tr>
								<td><strong>#SKUN115</strong></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-5.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>School Bag</span></td>
								<td>Bags</td>
								<td>June 18, 2021</td>
								<td>1581</td>
								<td>
									1581
								</td>
								<td>Chocolate</td>
								<td><span class="badge bg-danger">Out of Stock</span></td>
							</tr>
							<tr>
								<td><strong>#SKUN116</strong></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-6.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Rado Watch</span></td>
								<td>Watch</td>
								<td>June 13, 2021</td>
								<td>4581</td>
								<td>
									3468
								</td>
								<td>Silver</td>
								<td><span class="badge bg-success">Sell</span></td>
							</tr>
							<tr>
								<td><strong>#SKUN117</strong></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-7.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Wildcraft</span></td>
								<td>Traveling Bag</td>
								<td>June 17, 2021</td>
								<td>2581</td>
								<td>
									2468
								</td>
								<td>Silver</td>
								<td><span class="badge bg-success">Sell</span></td>
							</tr>
							<tr>
								<td><strong>#SKUN118</strong></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-8.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Chair</span></td>
								<td>Furniture</td>
								<td>June 17, 2021</td>
								<td>581</td>
								<td>
									468
								</td>
								<td>Browen</td>
								<td><span class="badge bg-success">Sell</span></td>
							</tr>
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
@endpush

@push('custom_styles')
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
			}]
		});
</script>
@endpush

@push('modals')
@endpush
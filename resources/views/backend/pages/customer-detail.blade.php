@extends(backendView('layouts.app'))

@section('title', 'Customer Detail')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Customer Detail</h3>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3 mb-xl-3">
		<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
			<div class="row g-3 mb-3 row-cols-1 row-cols-md-1 row-cols-lg-2 row-deck">
				<div class="col">
					<div class="card auth-detailblock">
						<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
							<h6 class="mb-0 fw-bold ">Delivery Address</h6>
						</div>
						<div class="card-body">
							<div class="row g-3">
								<div class="col-12">
									<label class="form-label col-6 col-sm-5">Block Number:</label>
									<span><strong>A-510</strong></span>
								</div>
								<div class="col-12">
									<label class="form-label col-6 col-sm-5">Address:</label>
									<span><strong>81 Fulton London</strong></span>
								</div>
								<div class="col-12">
									<label class="form-label col-6 col-sm-5">Pincode:</label>
									<span><strong>385467</strong></span>
								</div>
								<div class="col-12">
									<label class="form-label col-6 col-sm-5">Phone:</label>
									<span><strong>202-458-4568</strong></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card">
						<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
							<h6 class="mb-0 fw-bold ">Billing Address</h6>
						</div>
						<div class="card-body">
							<div class="row g-3">
								<div class="col-12">
									<label class="form-label col-6 col-sm-5">Block Number:</label>
									<span><strong>A-510</strong></span>
								</div>
								<div class="col-12">
									<label class="form-label col-6 col-sm-5">Address:</label>
									<span><strong>81 Fulton London</strong></span>
								</div>
								<div class="col-12">
									<label class="form-label col-6 col-sm-5">Pincode:</label>
									<span><strong>385467</strong></span>
								</div>
								<div class="col-12">
									<label class="form-label col-6 col-sm-5">Phone:</label>
									<span><strong>202-458-4568</strong></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
					<h6 class="mb-0 fw-bold ">Customer Order</h6>
				</div>
				<div class="card-body">
					<table id="myProjectTable" class="table table-hover align-middle mb-0" style="width: 100%;">
						<thead>
							<tr>
								<th>Id</th>
								<th>Item</th>
								<th>Payment Info</th>
								<th>Order Date</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><a href="{!! backendRoutePut('order-details') !!}"><strong>#Order-78414</strong></a></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-1.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span> Oculus VR </span></td>
								<td>Credit Card</td>
								<td>June 16, 2021</td>
								<td>
									$420
								</td>
							</tr>
							<tr>
								<td><a href="{!! backendRoutePut('order-details') !!}"><strong>#Order-58414</strong></a></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-2.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Wall Clock</span></td>
								<td>Debit Card</td>
								<td>June 16, 2021</td>
								<td>
									$220
								</td>
							</tr>
							<tr>
								<td><a href="{!! backendRoutePut('order-details') !!}"><strong>#Order-48414</strong></a></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-3.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Note Diaries</span></td>
								<td>Debit Card</td>
								<td>June 16, 2021</td>
								<td>
									$250
								</td>
							</tr>
							<tr>
								<td><a href="{!! backendRoutePut('order-details') !!}"><strong>#Order-38414</strong></a></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-4.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Flower Port</span></td>
								<td>Credit Card</td>
								<td>June 16, 2021</td>
								<td>
									$320
								</td>
							</tr>
							<tr>
								<td><a href="{!! backendRoutePut('order-details') !!}"><strong>#Order-28414</strong></a></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-1.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Oculus VR</span></td>
								<td>Debit Card</td>
								<td>June 17, 2021</td>
								<td>
									$20
								</td>
							</tr>
							<tr>
								<td><a href="{!! backendRoutePut('order-details') !!}"><strong>#Order-18414</strong></a></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-2.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Wall Clock</span></td>
								<td>Debit Card</td>
								<td>June 18, 2021</td>
								<td>
									$820
								</td>
							</tr>
							<tr>
								<td><a href="{!! backendRoutePut('order-details') !!}"><strong>#Order-11414</strong></a></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-3.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Note Diaries</span></td>
								<td>Bank Emi</td>
								<td>March 16, 2021</td>
								<td>
									$620
								</td>
							</tr>
							<tr>
								<td><a href="{!! backendRoutePut('order-details') !!}"><strong>#Order-27414</strong></a></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-5.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Bag</span></td>
								<td>Debit Card</td>
								<td>June 18, 2021</td>
								<td>
									$820
								</td>
							</tr>
							<tr>
								<td><a href="{!! backendRoutePut('order-details') !!}"><strong>#Order-78514</strong></a></td>
								<td><img src="{!! backendAssets('dist/assets/images/product/product-6.jpg') !!}" class="avatar lg rounded me-2" alt="profile-image"><span>Rado Watch</span></td>
								<td>Bank Emi</td>
								<td>March 16, 2021</td>
								<td>
									$620
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
			<div class="row row-deck g-3">
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
							<h6 class="mb-0 fw-bold ">Expence Count</h6>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-end text-center">
								<div class="p-2">
									<h6 class="mb-0 fw-bold">$1790</h6>
									<span class="text-muted">Total</span>
								</div>
								<div class="p-2 ms-4">
									<h6 class="mb-0 fw-bold">$149.16</h6>
									<span class="text-muted">Avg Month</span>
								</div>
							</div>
							<div id="apex-circle-gradient"></div>
							<div class="row">
								<div class="col">
									<span class="mb-3 d-block">Food</span>
									<div class="progress-bar  bg-secondary" role="progressbar" style="width: 55%; height: 5px;"></div>
									<span class="mt-2 d-block text-secondary">$597 spend</span>
								</div>
								<div class="col">
									<span class="mb-3 d-block">Cloth</span>
									<div class="progress-bar  bg-primary" role="progressbar" style="width: 60%; height: 5px;"></div>
									<span class="mt-2 d-block text-primary">$845 spend</span>
								</div>
								<div class="col">
									<span class="mb-3 d-block">Other</span>
									<div class="progress-bar  bg-lavender-purple" role="progressbar" style="width: 70%; height: 5px;"></div>
									<span class="mt-2 d-block color-lavender-purple">$348 spend</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
							<h6 class="mb-0 fw-bold ">Status Report</h6>
						</div>
						<div class="card-body">
							<ul class="list-unstyled mb-0">
								<li class="mb-4">
									<div class="d-flex justify-content-between align-items-center mb-2">
										<h6 class="mb-0">54</h6>
										<span class="small text-muted">Product Visit</span>
									</div>
									<div class="progress" style="height: 2px;">
										<div class="progress-bar bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="87" data-transitiongoal="87" style="width: 87%;"></div>
									</div>
								</li>
								<li class="mb-4">
									<div class="d-flex justify-content-between align-items-center mb-2">
										<h6 class="mb-0">27</h6>
										<span class="small text-muted">Product Buy</span>
									</div>
									<div class="progress" style="height: 2px;">
										<div class="progress-bar bg-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="34" data-transitiongoal="34" style="width: 34%;"></div>
									</div>
								</li>
								<li class="mb-4">
									<div class="d-flex justify-content-between align-items-center mb-2">
										<h6 class="mb-0">102</h6>
										<span class="small text-muted">Comment on Product</span>
									</div>
									<div class="progress" style="height: 2px;">
										<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="14" data-transitiongoal="14" style="width: 14%;"></div>
									</div>
								</li>
								<li class="mb-4">
									<div class="d-flex justify-content-between align-items-center mb-2">
										<h6 class="mb-0">1024 Hours</h6>
										<span class="small text-muted">Total spent time</span>
									</div>
									<div class="progress" style="height: 2px;">
										<div class="progress-bar bg-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="67" data-transitiongoal="67" style="width: 67%;"></div>
									</div>
								</li>
								<li class="mb-4">
									<div class="d-flex justify-content-between align-items-center mb-2">
										<h6 class="mb-0">1102</h6>
										<span class="small text-muted">Product Review</span>
									</div>
									<div class="progress" style="height: 2px;">
										<div class="progress-bar bg-dark" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="68" data-transitiongoal="14" style="width: 64%;"></div>
									</div>
								</li>
								<li class="mb-4">
									<div class="d-flex justify-content-between align-items-center mb-2">
										<h6 class="mb-0">108</h6>
										<span class="small text-muted">Return Product</span>
									</div>
									<div class="progress" style="height: 2px;">
										<div class="progress-bar bg-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="78" data-transitiongoal="14" style="width: 74%;"></div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- Row end  -->
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
<script src="{!! backendAssets('dist/assets/bundles/apexcharts.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/js/page/profile.js') !!}"></script>
@endpush

@push('custom_scripts')
<script>
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
	});
</script>
@endpush

@push('modals')
@endpush
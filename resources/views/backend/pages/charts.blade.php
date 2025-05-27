@extends(backendView('layouts.app'))

@section('title', 'Charts')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom">
				<h3 class="fw-bold mb-0">Charts</h3>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix mb-3">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="row gx-3 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
				<div class="col">
					<div class="card mb-3">
						<div class="card-body">
							<div id="apexspark-chart1"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-body">
							<div id="apexspark-chart2"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-body">
							<div id="apexspark-chart3"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-body">
							<div id="apexspark-chart4"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="row gx-3 row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3">
				<div class="col">
					<div class="card mb-3">
						<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
							<h6 class="m-0 fw-bold">Circle Chart</h6>
						</div>
						<div class="card-body">
							<div id="apex-circle-chart"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
							<h6 class="m-0 fw-bold">Circle Chart Multiple</h6>
						</div>
						<div class="card-body">
							<div id="apex-circle-chart-multiple"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
							<h6 class="m-0 fw-bold">Circle Gradient</h6>
						</div>
						<div class="card-body">
							<div id="apex-circle-gradient"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Basic Line Column</h6>
				</div>
				<div class="card-body">
					<div id="apex-chart-line-column"></div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Simple Bubble</h6>
				</div>
				<div class="card-body">
					<div id="apex-simple-bubble"></div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Area Datetime</h6>
				</div>
				<div class="card-body">
					<div class="btn-group" role="group" aria-label="Basic example">
						<button type="button" class="btn btn-outline-secondary" id="one_month">1M</button>
						<button type="button" class="btn btn-outline-secondary" id="six_months">6M</button>
						<button type="button" class="btn btn-outline-secondary active" id="one_year">1Y</button>
						<button type="button" class="btn btn-outline-secondary" id="ytd">YTD</button>
						<button type="button" class="btn btn-outline-secondary" id="all">ALL</button>
					</div>
					<div id="apex-timeline-chart"></div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Stacked Area</h6>
				</div>
				<div class="card-body">
					<div id="apex-stacked-area"></div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Basic Column</h6>
				</div>
				<div class="card-body">
					<div id="apex-basic-column"></div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Basic Heatmap Chart</h6>
				</div>
				<div class="card-body">
					<div id="apex-basic-heatmap"></div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Basic Scatter Chart</h6>
				</div>
				<div class="card-body">
					<div id="apex-basic-scatter"></div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Timeline</h6>
				</div>
				<div class="card-body">
					<div id="apex-timeline"></div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Basic Bar</h6>
				</div>
				<div class="card-body">
					<div id="apex-basic-bar"></div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Basic CandleStick</h6>
				</div>
				<div class="card-body">
					<div id="apex-CandleStick"></div>
				</div>
			</div>
		</div>
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="row gx-3 row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-3">
				<div class="col">
					<div class="card mb-3">
						<div class="card-body">
							<div id="apexspark1"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-body">
							<div id="apexspark2"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-body">
							<div id="apexspark3"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
							<h6 class="m-0 fw-bold">Basic Radar</h6>
						</div>
						<div class="card-body">
							<div id="apex-basic-radar"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
							<h6 class="m-0 fw-bold">Radar Multiple Series</h6>
						</div>
						<div class="card-body">
							<div id="apex-radar-multiple-series"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
							<h6 class="m-0 fw-bold">Radar with Polygon Fill</h6>
						</div>
						<div class="card-body">
							<div id="apex-radar-polygon-fill"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
							<h6 class="m-0 fw-bold">Simple Donut</h6>
						</div>
						<div class="card-body">
							<div id="apex-simple-donut"></div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card mb-3">
						<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
							<h6 class="m-0 fw-bold">Stroked Gauge</h6>
						</div>
						<div class="card-body">
							<div id="apex-stroked-gauge"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- Row end  -->
</div>
@endsection

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/apexcharts.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/js/page/chart-apex.js') !!}"></script>
@endpush

@push('custom_scripts')
@endpush

@push('modals')
@endpush
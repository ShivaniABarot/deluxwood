@extends(backendView('layouts.app'))

@section('title', 'Changelog')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center mb-4">
		<div class="col">
			<!-- Pretitle -->
			<h1 class="h4 mt-1">Changelog</h1>
		</div>
		<div class="col-auto">
			<a href="https://www.pixelwibes.com/"  title="" class="btn btn-white border lift">Get Support</a>
			<a href="https://themeforest.net/user/pixelwibes/portfolio" title="" class="btn btn-primary border lift">Our Portfolio</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body text-center p-5">
					<img src="{!! backendAssets('dist/assets/images/change-log.svg') !!}" class="img-fluid mx-size" alt="No Data">
				</div>
			</div>
		</div>
		<div class="col-12 col-md-12 mt-5">
			<div class="card">
				<div class="card-body">
					<div class="pt-2">
						<h6 class="d-inline-block"><span class="badge bg-warning font-weight-light">v1.0.0</span></h6>
						<span class="text-muted">&nbsp;&nbsp;&nbsp;–- May 01, 2022</span>
						<ul class="ms-5">
							<li>Initial release ofeBazar! Lots more coming soon though 😁</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
@endpush

@push('custom_scripts')
@endpush

@push('modals')
@endpush
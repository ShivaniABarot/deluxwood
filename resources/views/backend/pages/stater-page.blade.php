@extends(backendView('layouts.app'))

@section('title', 'Ui Index')

@section('content')
<div class="container-xxl">
	<div class="col-12">
		<div class="card mb-3">
			<div class="card-body text-center p-5">
				<img src="{!! backendAssets('dist/assets/images/no-data.svg') !!}" class="img-fluid mx-size" alt="No Data">
				<div class="mt-4 mb-2">
					<span class="text-muted">No data to show</span>
				</div>
				<button type="button" class="btn btn-white border lift mt-1">Get Started</button>
				<button type="button" class="btn btn-primary border lift mt-1">Back to Home</button>
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
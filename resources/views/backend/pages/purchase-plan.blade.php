@extends(backendView('layouts.app'))

@section('title', 'Purchase Plan')

@section('content')
<div class="container-xxl">
	<div class="row mb-5 mt-4">
		<div class="col-12 text-center">
			<h2 class="fw-bold">Choose Your Plan</h2>
			<p class="text-muted mt-4 mx-auto">Choose one of the plans that suits you. You will get a better service with the upgraded package.</p>
		</div>
		<div class="d-inline-flex justify-content-center mx-auto">
			<ul class="nav nav-tabs tab-body-header rounded invoice-set" role="tablist">
				<li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#" role="tab">Month Plan</a></li>
				<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#" role="tab">Yearly Plan</a></li>
			</ul>
		</div>
	</div> <!-- Row end  -->

	<div class="row g-2 justify-content-center align-items-center">
		<div class="col-xxl-3 col-xl-4 col-lg-4 col-sm-12">
			<div class="card">
				<div class="card-body py-4 text-center">
					<h6 class="text-uppercase">Deluxe</h6>
					<div><span class="display-5 text-primary">$9</span> <span class="text-muted">/Month</span></div>
				</div>
				<div class="border-top-0 px-5 card-footer">
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Voice chat:</span> <span>10Hr</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Chat without limit:</span> <span>500MB</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Support:</span> <span>No</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Domain:</span> <span>1</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Hidden Fees:</span> <span>No</span></p>
				</div>
				<div class="card-body text-center">
					<a href="#" class="btn btn-white border lift">Get Started</a>
				</div>
			</div>
		</div>
		<div class="col-xxl-3 col-xl-4 col-lg-4 col-sm-12">
			<div class="card py-0 py-md-4 shadow">
				<div class="card-body py-4 text-center">
					<h6 class="text-uppercase">Economy</h6>
					<div><span class="display-5 text-primary">$29</span> <span class="text-muted">/Month</span></div>
				</div>
				<div class="border-top-0 px-5 card-footer">
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Voice chat:</span> <span>100hr</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Videochat:</span> <span>50GB</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Support:</span> <span>Yes</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Domain:</span> <span>2</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Hidden Fees:</span> <span>No</span></p>
				</div>
				<div class="card-body text-center">
					<a href="#" class="btn btn-primary border lift">Get Started</a>
				</div>
			</div>
		</div>
		<div class="col-xxl-3 col-xl-4 col-lg-4 col-sm-12">
			<div class="card">
				<div class="card-body py-4 text-center">
					<h6 class="text-uppercase">Ultimate</h6>
					<div><span class="display-5 text-primary">$39</span> <span class="text-muted">/Month</span></div>
				</div>
				<div class="border-top-0 px-5 card-footer">
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Voice chat:</span> <span>Unlimited</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Videochat:</span> <span>Unlimited</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Support:</span> <span>Yes</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Domain:</span> <span>Unlimited</span></p>
					<p class="d-flex justify-content-between py-1"><span><i class="fa fa-check-circle"></i> Hidden Fees:</span> <span>No</span></p>
				</div>
				<div class="card-body text-center">
					<a href="#" class="btn btn-white border lift">Get Started</a>
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
@endpush

@push('custom_scripts')
@endpush

@push('modals')
@endpush
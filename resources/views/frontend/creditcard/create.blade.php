@extends(backendView('layouts.app'))

@section('title', 'Customer Group Add')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Add Card Details</h3>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
				<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Credit Card Authorization <span class="text-danger">*</span></h6>
				</div>
				<div class="card-body">
					<form action="{{url('payment/store')}}" method="POST" id="paymentForm">
						@csrf
						<div class="row g-3 align-items-center">
							<div class="col-md-6">
								<label class="form-label">Credit Card Number</label>
								<input type="text" class="form-control" name="credit_card_number" placeholder="Please enter credit card number">
								<span class="text-danger kt-form__help error credit_card_number"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Credit Card Type we accept</label>
								<div class="row">
									<div class="col-md-6">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="credit_card_type" id="exampleRadios11" value="Visa" checked="">
											<label class="form-check-label" for="exampleRadios11">
												Visa
											</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="credit_card_type" id="exampleRadios22" value="Mastercard">
											<label class="form-check-label" for="exampleRadios22">
												Mastercard
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">Card Member Name</label>
								<input type="text" class="form-control" name="card_member_name" placeholder="Please enter card member name">
								<span class="text-danger kt-form__help error card_member_name"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Expiration Date</label>
								<input type="date" min="{{ now()->format('Y-m-d') }}" class="form-control" name="expiration_date" placeholder="Please enter group title">
								<span class="text-danger kt-form__help error expiration_date"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Billing Address</label>
								<textarea class="form-control" rows="3" name="billing_address" placeholder="Please enter billing address" style="resize: none;"></textarea>
								<span class="text-danger kt-form__help error billing_address"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Phone No</label>
								<input type="text" class="form-control" name="phone" placeholder="Please enter phone no">
								<span class="text-danger kt-form__help error phone"></span>
							</div>
						</div>
						<button type="submit" class="btn btn-warning mt-4 text-uppercase px-5">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div><!-- Row End -->
</div>
@endsection

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
@endpush

@push('custom_scripts')
<script type="text/javascript" src="{{asset('public/validation/CreditCardValidation.js')}}"></script> 
@endpush

@push('modals')
@endpush